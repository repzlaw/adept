<?php

namespace App\Http\Controllers;

use App\Models\Percentage;
use App\Http\Controllers\Controller;
use App\Models\LeasingApplication;
use App\Models\PaymentTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Str;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Percentage::all();
        return Inertia::render('Authenticated/plan/Index', ['data'=> $data ]);
    }

    public function store( Request $request ){

        $this->validate($request,[
            'duration_name' => 'required',
            'duration_month' => 'required',
            'interest_percentage' => 'required',
        ]);

        $percentage = new Percentage();
        $percentage->name =  $request->input('duration_name');
        $percentage->month =  $request->input('duration_month');
        $percentage->interest_percentage =  $request->input('interest_percentage');
        $percentage->save();
        return response()->json(['message' => 'Record set successfully'], 200);
    }


    public function saveEdit( Request $request ){
        $this->validate($request,[
            'name' => 'required',
            'month' => 'required',
            'interest_percentage' => 'required',
        ]);

       $percen = Percentage::find($request->input('id'));
        $percen->name =  $request->input('name');
        $percen->month =  $request->input('month');
        $percen->interest_percentage =  $request->input('interest_percentage');
        $percen->save();
        return response()->json(['message' => 'Record updated successfully'], 200);
    }
    public function del( Request $request ){
        $percentage = Percentage::find($request->input('id'));
        $percentage->delete();
    }

    public function pay(){
        $userId = Auth::user()->id;
        $data = LeasingApplication::with('user','supplier')
                ->join('suppliers', 'suppliers.leasing_application_id', '=', 'leasing_applications.id')
                ->join('payment_plans as pp', 'pp.id', '=', 'suppliers.payment_plan_id')
                ->select('pp.name as plan_name','pp.*', 'suppliers.*', 'leasing_applications.*')
                ->where(['leasing_applications.status'=> 'Approved', 'leasing_applications.user_id'=>$userId, 
                'suppliers.status' =>'Pending'])->get();
        // dd($data);
        $final_details = [];  
        foreach ($data as $details){
                
            $name = $details->surname ." ". $details->name . " ".$details->othername.''.$details->email;
            // dd($final_details);
            if (isset($final_details[$name])){
                $paid = PaymentTransaction::where(['leasing_application_id'=> $details['id'], 'status' => 'APPROVED'])->sum('amount_paid');
                $paymentBreakdown = [];
                $supp = Supplier::where('leasing_application_id', $details->leasing_application_id)->first();
               
                $paymentBreakdown['amount'] = $supp->amount_per_month;
               
                $checkPay = PaymentTransaction::where(['leasing_application_id' => $details->leasing_application_id, 'status'=> 'APPROVED'])->count();
                if(!$checkPay){
                $paymentBreakdown['breakdown'] = $this->calculateFirstPayment($details->leasing_application_id);
               }
                $details->breakdown =  $paid;
                
                $details->total =  $paymentBreakdown['breakdown']['total']+$details->amount_per_month;
                // dd($details);
            }else{
                $paid = PaymentTransaction::where(['leasing_application_id'=> $details['id'], 'status' => 'APPROVED'])->sum('amount_paid');
                
                $paymentBreakdown = [];
                $supp = Supplier::where('leasing_application_id', $details->leasing_application_id)->first();
               
                $paymentBreakdown['breakdown']['total'] = 0;
               
                $checkPay = PaymentTransaction::where(['leasing_application_id' => $details->leasing_application_id, 'status'=> 'APPROVED'])->count();
                if(!$checkPay){
                $paymentBreakdown['breakdown'] = $this->calculateFirstPayment($details->leasing_application_id);
            }
                $details->totalToPay =  $paymentBreakdown['breakdown']['total']+$details->amount_per_month;
                $details->total =  $paid;


            }
        }
       
        
        return Inertia::render('Authenticated/Payment/Card', ['data' => $data]);

    }
    public function payCreate(Request $request){
// dd($request->    all());
        //function to get random string
        $random = Str::random(11);

        $new_transaction = PaymentTransaction::create([
            'orderid' => $random,
            'user_id' => Auth::user()->id,
            'leasing_application_id' => $request->id,
            'payment_plan_id' => $request->payment_plan_id,
            'amount_paid' => $request->totalToPay,
            'trans_date' => now(),
            'gateway' => 'Autocredit',
            'payment_type' => 'Card',
            'description' => $request->description,
            'reference' => $request->name,
        ]);
        
        return response()->json(['data'=>$new_transaction], 200);
    }
        private function get_payment_status($transref, $public_key)
    {
// dd($public_key);
        $curl = curl_init();
        $auto_credit_url = env('AUTO_CREDIT_URL2', 'https://live.autocredit.cc');
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$auto_credit_url/payments/$transref?token=$public_key",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);

        $transid = $result['data']['transid'];
        $status = $result['status'];
        if ($status == 'success') {
            $subscription_trans = PaymentTransaction::where('orderid', $transref)->first();
           return $subscription_trans->update([
                'status' => 'APPROVED'
            ]);
        } else {
            $subscription_trans = PaymentTransaction::where('orderid', $transref)->first();
            return $subscription_trans->update([
                'status' => 'PENDING'
            ]);
        }
        curl_close($curl);
        
        return true;
    }
    public function transaction_response(Request $request)
    {
        $pub_key = env('AUTO_CREDIT_PUB_KEY', 'PUB_DEMO_AC5F192BBDEDBDC');
        return $this->get_payment_status($request->get('transref'), $pub_key);
    }

    public function savePaid(Request $request){
        $payment = new PaymentTransaction();
        $payment->user_id = $request->input('user_id');
        $payment->orderid = Str::random(11);
        $payment->reference = '';
        $payment->gateway = '';
        $payment->leasing_application_id = $request->input('leasing_application_id');
        $payment->payment_plan_id = $request->input('payment_plan_id');
        $payment->amount_paid = $request->input('amount_paid');
        $payment->description = $request->input('description');
        $payment->trans_date = \Carbon\Carbon::now();
        $payment->status = 'APPROVED';
        $payment->payment_type = 'CASH';
        $payment->save();

       $this->checkBalance($request->input('leasing_application_id'));

        return response()->json('Payment remit successfully', 200);
    }

    public function checkBalance($appid){
        $supplier = Supplier::where('leasing_application_id', $appid)->first();
        
        $paid = PaymentTransaction::where(['leasing_application_id'=> $appid, 'status' => 'APPROVED'])->sum('amount_paid');

        if($paid >= $supplier->amount_to_refund){
            $supplier->update([
                'status' => "Completed"
            ]);
        }
    }

    public function calculatePercentage($amount,  $percentage){
        return ($amount*$percentage)/100;
    }

    public function calculateFirstPayment($appId){

        $getSupplierInfo = Supplier::join('leasing_applications as la', 'la.id', 'suppliers.leasing_application_id')
                                    ->join('payment_plans as pp', 'pp.id', 'suppliers.payment_plan_id')
                                    ->where('suppliers.leasing_application_id', $appId)
                                    ->select("suppliers.*", 'la.business_name','pp.*' )
                                    ->first();
        // dd($getSupplierInfo);
        // this is to calculate amount to pay for the first payment
        $checkPay = PaymentTransaction::where(['leasing_application_id' => $appId, 'status'=> 'APPROVED'])->count();

        $breakDown = [];
        if($checkPay == 0){

            // start to calculate all initial payments
            $processingFee = $this->calculatePercentage($getSupplierInfo->amount, $getSupplierInfo->processing_fee);
            $legalFee = $this->calculatePercentage($getSupplierInfo->amount,$getSupplierInfo->legal_fee);
            $vatFee = $this->calculatePercentage(($legalFee+$processingFee),$getSupplierInfo->vat_fee);
            $insurance = $this->calculatePercentage($getSupplierInfo->amount,$getSupplierInfo->insurance_fee);
            $creditCheck = $getSupplierInfo->credit_check_fee;

            $breakDown['processingFee'] = $processingFee;
            $breakDown['legalFee'] = $legalFee;
            $breakDown['vatFee'] = $vatFee;
            $breakDown['insurance'] = $insurance;
            $breakDown['creditCheck'] = $creditCheck;
            $breakDown['total'] = $processingFee+$legalFee+$vatFee+$insurance+$creditCheck;
            
        }
        return $breakDown;
    }

}
