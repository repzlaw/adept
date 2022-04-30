<?php

namespace App\Http\Controllers;

use App\Mail\approveApplication;
use App\Mail\disapproveApplication;
use App\Models\LeasingApplication;
use App\Models\PaymentTransaction;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;


class LeasingApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_type == 'admin')
            $data = LeasingApplication::with('user', 'supplier')->get();
        else
            $data = LeasingApplication::with('user', 'supplier')->Where('user_id', Auth::user()->id)->get();

        foreach ($data as  $value) {
            if ($value['supplier'] == null) {
                $value['supplier'] = [];
            }
        }

        return Inertia::render('Authenticated/Application/MyApplication', ['data' => $data]);
    }

    public function editApplication(Request $request)
    {
        $validated = $request->validate([
            'business_name' => 'required',
            'business_email' => 'required',
            'business_nature' => 'required',
            'last_year_net_income' => 'required',
            'current_year_income' => 'required',
            'evidence_of_residence' => 'required',
            'incorporation_business_name' => 'required',
            'details_of_asset' => 'required',
            'date_of_birth' => 'required',
            'id_number' => 'required',
            'financial_obligation' => 'required',
            'goods_description' => 'required',
            'application_type' => 'required',
        ]);



        $leasingApp = LeasingApplication::where('id', $request->id);
        $leasingApp->update([
            'user_id' => auth()->user()->id,
            'business_name' => $request->business_name,
            'business_email' => $request->business_email,
            'business_nature' => $request->business_nature,
            'last_year_net_income' => $request->last_year_net_income,
            'current_year_income' => $request->current_year_income,
            'evidence_of_residence' => $request->evidence_of_residence,
            'incorporation_business_name' => $request->incorporation_business_name,
            'details_of_asset' => $request->details_of_asset,
            'date_of_birth' => $request->date_of_birth,
            'id_number' => $request->id_number,
            'financial_obligation' => $request->financial_obligation,
            'goods_description' => $request->goods_description,
            'application_type' => $request->application_type,
        ]);

        return response()->json(['message' => 'Operation Successful']);
    }

    //show create application index page
    public function createApplicationIndex()
    {
        return Inertia::render('Authenticated/Application/Create-Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Authenticated/Application/Create-Application');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'business_name' => 'required',
            'business_email' => 'required',
            'business_nature' => 'required',
            'last_year_net_income' => 'required',
            'current_year_income' => 'required',
            'evidence_of_residence' => 'required',
            'incorporation_business_name' => 'required',
            'details_of_asset' => 'required',
            'date_of_birth' => 'required',
            'id_number' => 'required',
            'financial_obligation' => 'required',
            'goods_description' => 'required',
            'application_type' => 'required',
        ]);



        $name = "material/" . auth()->user()->id . time() . '.pdf';
        $store =  LeasingApplication::firstOrCreate([
            'user_id' => auth()->user()->id,
            'business_name' => $request->business_name,
            'business_email' => $request->business_email,
            'business_nature' => $request->business_nature,
            'last_year_net_income' => $request->last_year_net_income,
            'current_year_income' => $request->current_year_income,
            'evidence_of_residence' => $request->evidence_of_residence,
            'incorporation_business_name' => $request->incorporation_business_name,
            'details_of_asset' => $request->details_of_asset,
            'date_of_birth' => $request->date_of_birth,
            'id_number' => $request->id_number,
            'financial_obligation' => $request->financial_obligation,
            'goods_description' => $request->goods_description,
            'application_type' => $request->application_type,
        ]);
        return $store;

        return response()->json(['message', 'Operation Successful']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeasingApplication  $leasingApplication
     * @return \Illuminate\Http\Response
     */
    // public function updateGuarantor(Request $request)
    // {

    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeasingApplication  $leasingApplication
     * @return \Illuminate\Http\Response
     */
    public function activateDeactivate(Request $request)
    {
        $leasingApp = LeasingApplication::where('id', $request->rec['id'])->first();
        // dd($leasingApp);
        if ($request->id == 1) {
            $leasingApp->update([
                'status' => 'Approved'
            ]);
            $name = $request->rec['user']['name'];
            $amount = $request->rec['supplier']['amount'];
            $goods = $request->rec['supplier']['item'];
            // Mail::to($leasingApp->business_email)->send(new approveApplication($name, $amount, $goods));
            // new activateApplication
        } else {
            $leasingApp->update([
                'status' => 'declined'
            ]);
            $name = $request->rec['user']['name'];
            $amount = $request->rec['supplier']['amount'];
            $goods = $request->rec['supplier']['item'];
            // Mail::to($leasingApp->business_email)->send(new disapproveApplication($name, $amount, $goods));
        }
        return response()->json(['message', 'Operation Successful']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeasingApplication  $leasingApplication
     * @return \Illuminate\Http\Response
     */
    public function updateGuarantor(Request $request, LeasingApplication $leasingApplication)
    {

        $validated = $request->validate([
            'g_1_name' => 'required',
            'g_1_email' => 'required',
            'g_1_phone' => 'required',
            'g_1_company' => 'required',
            'g_2_name' => 'required',
            'g_2_email' => 'required',
            'g_2_phone' => 'required',
            'g_2_company' => 'required',
            'g_3_name' => 'required',
            'g_3_email' => 'required',
            'g_3_phone' => 'required',
            'g_3_company' => 'required',
        ]);

        $data = [];
        $data['guarantor_1'] = [
            'g_1_name' => $request->g_1_name,
            'g_1_email' => $request->g_1_email,
            'g_1_phone' => $request->g_1_phone,
            'g_1_company' => $request->g_1_company,
        ];
        $data['guarantor_2'] = [
            'g_2_name' => $request->g_2_name,
            'g_2_email' => $request->g_2_email,
            'g_2_phone' => $request->g_2_phone,
            'g_2_company' => $request->g_2_company,
        ];
        $data['guarantor_3'] = [
            'g_3_name' => $request->g_3_name,
            'g_3_email' => $request->g_3_email,
            'g_3_phone' => $request->g_3_phone,
            'g_3_company' => $request->g_3_company,
        ];
        $leasingRecord = LeasingApplication::where('id', $request->id)->first();

        $leasingRecord->update([
            'guarantor_1' => json_encode($data['guarantor_1']),
            'guarantor_2' => json_encode($data['guarantor_2']),
            'guarantor_3' => json_encode($data['guarantor_3']),
        ]);

        return response()->json(['message' => 'Guarantor\'s  Information Updated Successful']);
    }

    public function getClient($user)
    {

        $new = User::join('leasing_applications', 'leasing_applications.user_id', '=', 'users.id')
            ->join('suppliers', 'suppliers.leasing_application_id', '=', 'leasing_applications.id')
            // ->join('payment_transactions', 'suppliers.leasing_application_id' , '=', 'payment_transactions.leasing_application_id' )
            ->Where('leasing_applications.status', '=', 'Approved')
            ->Where('suppliers.status', '=', 'Pending')
            ->whereNested(function ($query) use ($user) {
                $query->Where('users.email', 'like', '%' . $user . '%')
                    ->orWhere('users.surname', 'like', '%' . $user . '%')
                    ->orWhere('users.name', 'like', '%' . $user . '%')
                    ->orWhere('users.othername', 'like', '%' . $user . '%');
            })
            ->get();

        $final_details = [];
        foreach ($new as $details) {
            $name = $details->surname . " " . $details->name . " " . $details->othername . '' . $details->email;
            if (isset($final_details[$name])) {
                $paid = PaymentTransaction::where(['leasing_application_id' => $details['id'], 'status' => 'APPROVED'])->sum('amount_paid');
                $details['total'] =  $paid;
                $final_details[$name][] = $details;
            } else {
                $paid = PaymentTransaction::where(['leasing_application_id' => $details['id'], 'status' => 'APPROVED'])->sum('amount_paid');
                $details['total'] =  $paid;
                $final_details[$name][] = $details;
            }
        }

        return response()->json($final_details);
    }

    public function delete(Request $request)
    {
        $app = LeasingApplication::findOrfail($request->id)->delete();
        
        return true;
    }
}
