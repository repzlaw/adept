<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LeasingApplication;
use App\Models\PaymentPlan;
use App\Models\PaymentTransaction;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Percentage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JsonRequest;
use App\Mail\applicationCreation;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;

class SupplierController extends Controller
{
    //
    public function index()
    {

        $supplier = Supplier::join('leasing_applications as la', 'la.id', 'suppliers.leasing_application_id')
            ->join('payment_plans as pp', 'pp.id', 'suppliers.payment_plan_id')
            ->join('users as u', 'u.id', 'la.user_id')
            ->where('la.user_id', Auth::user()->id)
            ->select('la.business_name', 'pp.*', 'pp.name as planName', 'u.*', "suppliers.*")
            ->get();

        return Inertia::render('Authenticated/Supplier/Index', ['data' => $supplier]);
    }

    //
    public function getNextPay(Request $request)
    {
        // dd($request->payment_plan_id);
        // this is to calculate amount to pay for the first payment
        $paymentBreakdown = [];
        $supp = Supplier::where('leasing_application_id', $request->leasing_application_id)->first();
        //    dd($supp);
        $paymentBreakdown['amount'] = $supp->amount_per_month;

        $checkPay = PaymentTransaction::where(['leasing_application_id' => $request->leasing_application_id, 'status' => 'APPROVED'])->count();

        if (!$checkPay) {
            $paymentBreakdown['breakdown'] = $this->calculateFirstPayment($request->leasing_application_id);
        } else {
            $payCal = PaymentTransaction::where(['leasing_application_id' => $request->leasing_application_id, 'status' => 'APPROVED'])->sum('amount_paid');
            $payplan = PaymentPlan::where('id', $request->payment_plan_id)->first();
            // dd($payplan->purchase_option_fee);
            if ($payCal <= $supp->amount_to_pay) {
                $paymentBreakdown['amount'] = $supp->amount_per_month + $this->calculatePercentage($supp->amount_per_month, $payplan->purchase_option_fee);
            }
        }


        return $paymentBreakdown;
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required | min:11',
            'item' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'address' => 'required',
            'goods_type' => 'required',
            'advance_rentals' => 'required',
            // 'payment_plan' => 'required | integer',
        ]);

        // dd($request->all());

        // $percentage = PaymentPlan::where('id', $request->payment_plan)->first();
        // // calculate amount_to_refund
        // $amount_to_refund = $this->calculatePercentage($request->input('amount'),$percentage->interest_charge)+$request->input('amount');
        // // dd($amount_to_refund);
        $supplier =  Supplier::where('leasing_application_id', $request->appId)->first();
        // dd($supplier);

        if ($supplier) {
            $supplier->update([
                'name' => $request->input('name'),
                'address' => $request->input('phone'),
                'phone' => $request->input('address'),
                // 'payment_plan_id' => $request->input('payment_plan'),
                'item' => $request->input('item'),
                'amount' => $request->input('amount'),
                'advance_rentals' => $request->input('advance_rentals'),
                'payment_spread' => $request->input('payment_spread'),
                // 'amount_to_refund' => $amount_to_refund,
                // 'amount_per_month' => round($amount_to_refund/$percentage->payment_duration),
                'description' => $request->input('description'),
                'leasing_application_id' => $request->input('appId'),
                'goods_type' => $request->input('goods_type'),
            ]);
            $name = Auth::user()->name;
            // Mail::to(Auth::user()->email)->send(new applicationCreation($name));
        } else {
            // dd(435);
            $supplier = new Supplier();

            $supplier->name = $request->input('name');
            $supplier->address = $request->input('phone');
            $supplier->phone = $request->input('address');
            // $supplier->payment_plan_id = $request->payment_plan;
            $supplier->item = $request->input('item');
            $supplier->amount = $request->input('amount');
            $supplier->advance_rentals = $request->input('advance_rentals');
            $supplier->payment_spread = $request->input('payment_spread');
            // $supplier->amount_to_refund = $amount_to_refund;
            // $supplier->amount_per_month = round($amount_to_refund/$percentage->payment_duration);
            $supplier->description = $request->input('description');
            $supplier->leasing_application_id = $request->input('appId');
            $supplier->goods_type = $request->input('goods_type');
            // dd($request->all());
            $supplier->save();
            $name = Auth::user()->name;
            // Mail::to(Auth::user()->email)->send(new applicationCreation($name));
        }

        return response()->json(['message' => 'Supplier Detail Added successfully'], 200);
    }

    public function attachPlan(Request $request)
    {
        $this->validate($request, [
            'payment_plan' => 'required | integer',
        ]);
        $percentage = PaymentPlan::where('id', $request->input('payment_plan'))->first();
        $amount_to_refund = $this->calculatePercentage($request->supplier['amount'], $percentage->interest_charge) + $request->supplier['amount'];

        $supplier =  Supplier::where('leasing_application_id', $request->id)->first();
        $supplier->update([
            'amount_to_refund' => $amount_to_refund,
            'amount_per_month' => round($amount_to_refund / $percentage->payment_duration),
            'payment_plan_id' => $request->input('payment_plan'),
        ]);
        return response()->json(['message' => 'Payment Plan Attached successfully'], 200);
    }

    public function update(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required | min:11',
            'item' => 'required',
            'description' => 'required',
            'amount' => 'required',
            'address' => 'required',
            'application_id' => 'required',
            // 'percentage_id' => 'required | integer',
        ]);

        // calculate amount_to_refund
        $percentage = Percentage::where('id', $request->input('percentage_id'))->first();

        $amount_to_refund = round(($request->input('amount') / $percentage->interest) * 100);
        $supplier = Supplier::where('leasing_application_id', $request->input('leasing_application_id'))->first();
        $supplier->update([
            'name' => $request->input('name'),
            'address' => $request->input('phone'),
            'phone' => $request->input('address'),
            // 'percentage_id' => $request->input('percentage_id'),
            'item' => $request->input('item'),
            'amount' => $request->input('amount'),
            'amount_to_refund' => $amount_to_refund,
            'amount_per_month' => round($amount_to_refund / $percentage->month),
            'description' => $request->input('description'),
            'leasing_application_id' => $request->input('appId'),
            'goods_type' => $request->input('goods_type')
        ]);

        return response()->json(['message' => 'Supplier Detail Updated successfully'], 200);
    }

    public function UploadCertificate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'file' => 'image|max:3999',
        ]);
        // dd($request->all());
        // dd($request->file('certificates'));
        // dd($request->input('file'));

        $application_id = LeasingApplication::where('id', $request->input('application'))->first();
        // dd($application_id);

        if ($application_id->application_type == 'individual')
            $expected_uploads = 6;
        else
            $expected_uploads = 13;

        if (count($request->file()) < $expected_uploads) {
            return response()->json(['message' => 'Certificates not completed !!! Upload Fail'], 404);
        }
        $application = [];

        // this is to check the file type
        $file_type = ['jpg', 'png', 'jpeg', 'pdf', 'gif', 'jfif'];
        foreach ($request->file() as $key => $value) {
            $cac = time() . '_cert_' . $request->file($key)->getClientOriginalName();
            $exploded = explode('.', $cac);
            if (!in_array(strtolower(end($exploded)), $file_type)) {
                return response()->json(['message' => 'File type not Allowed !!! Upload Fail'], 404);
            }
        }

        foreach ($request->file() as $key => $value) {
            $cac = time() . '_cert_' . $request->file($key)->getClientOriginalName();
            $img = str_replace(" ", "_", $cac);
            $path = $request->file($key)->storeAs('public/images', $img);
            $path = url('/') . '/storage/images/' . $img;
            $application[] = $path;
        }

        $application_id->certificate = json_encode($application);
        $application_id->save();
        return response()->json(['message' => 'Certificate Added successfully'], 200);
    }

    public function DownloadCertificate(Request $request)
    {
        // dd(json_decode($request->certificate, true));
        $application_id = LeasingApplication::find($request->input('application'))->first();

        // dd(json_decode($application_id->certificate, true));

        $file_type = ['jpg', 'png', 'jpeg', 'pdf', 'gif', 'jfif'];
        foreach ($request->file() as $key => $value) {
            if (!in_array(end($exploded), $file_type)) {
                return response()->json(['message' => 'File type not Allowed !!! Upload Fail'], 404);
            }
        }

        foreach ($request->file() as $key => $value) {
            $cac = time() . '_cert_' . $request->file($key)->getClientOriginalName();
            $exploded = explode('.', $cac);

            $cac = str_replace(" ", "_", $cac);
            $path = $request->file($key)->storeAs('public/images', $cac);
            $application[] = $path;
        }

        $application_id->certificate = json_encode($application);
        $application_id->save();
        return response()->json(['message' => 'Certificate Added successfully'], 200);
    }

    public function paySettings()
    {
        $percentage = PaymentPlan::all();
        return response()->json(['paymentPlan' => $percentage]);
    }

    public function cash()
    {
        return Inertia::render('Authenticated/Payment/cash');
    }
    public function history()
    {
        $user_id = Auth::user()->id;
        $data = PaymentTransaction::join('leasing_applications as la', 'la.id', 'payment_transactions.leasing_application_id')
            ->join('suppliers as sup', 'sup.leasing_application_id', 'la.id')
            ->where('la.user_id', $user_id)
            ->select('payment_transactions.*', 'la.business_name', 'item')
            ->orderBy('payment_transactions.created_at', 'desc')->get();

        return Inertia::render('Authenticated/Payment/History', ['data' => $data]);
    }

    public function checkStatus(Request $request)
    {
        $app_id = PaymentTransaction::where('orderid', $request->transref)->first()->leasing_application_id;
        // dd($request->all());
        $payCtrl = new PaymentController;
        $private_key = 'PRI_LIVE_AC6009301D50C15';
        $this->get_payment_status($request->get('transref'), $private_key);

        $payCtrl->checkBalance($app_id);
        return response()->json(['data' => 'Payment successful']);
    }

    private function get_payment_status($transref, $private_key)
    {
        // dd($transref);
        $curl = curl_init();
        $auto_credit_url = env('AUTO_CREDIT_URL2', 'https://live.autocredit.cc');
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$auto_credit_url/payments/$transref?token=$private_key",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);
        // $transid = $result['data']['transid'];
        $status = $result['status'];
        if ($status == 'success') {

            return PaymentTransaction::where('orderid', $transref)
                ->update([
                    'status' => 'APPROVED', 'raw_response' => $response
                ]);
        } else {

            return PaymentTransaction::where('orderid', $transref)
                ->update([
                    'status' => 'DECLINED', 'raw_response' => $response
                ]);
        }
        curl_close($curl);

        return true;
    }

    // this update a particular payment
    public function updatePayment($application_id)
    {
        $payment = PaymentTransaction::join('leasing_applications as la', 'la.id', 'payment_transactions.leasing_application_id')
            ->join('suppliers as sup', 'sup.leasing_application_id', 'la.id')
            ->where('leasing_application_id', $application_id)->first();
    }

    // this checks if a particlar item u are trying to pay for is completed or not
    public function checkPayment()
    {
    }

    public function calculatePercentage($amount,  $percentage)
    {
        return ($amount * $percentage) / 100;
    }

    public function calculateFirstPayment($appId)
    {

        $getSupplierInfo = Supplier::join('leasing_applications as la', 'la.id', 'suppliers.leasing_application_id')
            ->join('payment_plans as pp', 'pp.id', 'suppliers.payment_plan_id')
            ->where('suppliers.leasing_application_id', $appId)
            ->select("suppliers.*", 'la.business_name', 'pp.*')
            ->first();
        // dd($getSupplierInfo);
        // this is to calculate amount to pay for the first payment
        $checkPay = PaymentTransaction::where(['leasing_application_id' => $appId, 'status' => 'APPROVED'])->count();

        $breakDown = [];
        if ($checkPay == 0) {

            // start to calculate all initial payments
            $processingFee = $this->calculatePercentage($getSupplierInfo->amount, $getSupplierInfo->processing_fee);
            $legalFee = $this->calculatePercentage($getSupplierInfo->amount, $getSupplierInfo->legal_fee);
            $vatFee = $this->calculatePercentage(($legalFee + $processingFee), $getSupplierInfo->vat_fee);
            $insurance = $this->calculatePercentage($getSupplierInfo->amount, $getSupplierInfo->insurance_fee);
            $creditCheck = $getSupplierInfo->credit_check_fee;

            $breakDown['processingFee'] = $processingFee;
            $breakDown['legalFee'] = $legalFee;
            $breakDown['vatFee'] = $vatFee;
            $breakDown['insurance'] = $insurance;
            $breakDown['creditCheck'] = $creditCheck;
            $breakDown['total'] = $processingFee + $legalFee + $vatFee + $insurance + $creditCheck;
        }
        return $breakDown;
    }
}
