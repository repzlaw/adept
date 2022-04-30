<?php

namespace App\Http\Controllers;

use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaymentPlan::all();
        return Inertia::render('Authenticated/plan/PaymentPlan', ['data'=> $data ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
            'name' => 'required',
            'payment_duration' => 'required',
            // 'equity_contribution' => 'required',
            'interest_charge' => 'required',
            'processing_fee' => 'required',
            'legal_fee' => 'required',
            'vat_fee' => 'required',
            'credit_check_fee' => 'required',
            'insurance_fee' => 'required',
            'purchase_option_fee' => 'required',
            'licensing_registration' => 'required',
            'plan_type' => 'required',
        ]);

        $percentage = new PaymentPlan();
        $percentage->name =  $request->input('name');
        $percentage->payment_duration =  $request->input('payment_duration');
        $percentage->interest_charge =  $request->input('interest_charge');
        $percentage->processing_fee =  $request->input('processing_fee');
        $percentage->legal_fee =  $request->input('legal_fee');
        $percentage->vat_fee =  $request->input('vat_fee');
        $percentage->credit_check_fee =  $request->input('credit_check_fee');
        $percentage->insurance_fee =  $request->input('insurance_fee');
        $percentage->equity_contribution =  $request->input('equity_contribution');
        $percentage->purchase_option_fee =  $request->input('purchase_option_fee');
        $percentage->licensing_registration =  $request->input('licensing_registration');
        $percentage->plan_type =  $request->input('plan_type');
        $percentage->save();
        return response()->json(['message' => 'Record set successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentPlan  $paymentPlan
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentPlan $paymentPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentPlan  $paymentPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'payment_duration' => 'required',
            'interest_charge' => 'required',
            'processing_fee' => 'required',
            'legal_fee' => 'required',
            'vat_fee' => 'required',
            'credit_check_fee' => 'required',
            'purchase_option_fee' => 'required',
            // 'equity_contribution' => 'required',
            'licensing_registration' => 'required',
            'plan_type' => 'required',
        ]);


        $percentage = PaymentPlan::where('id', $request->id)->first();
        $percentage->name =  $request->input('name');
        $percentage->payment_duration =  $request->input('payment_duration');
        $percentage->interest_charge =  $request->input('interest_charge');
        $percentage->processing_fee =  $request->input('processing_fee');
        $percentage->legal_fee =  $request->input('legal_fee');
        $percentage->vat_fee =  $request->input('vat_fee');
        $percentage->credit_check_fee =  $request->input('credit_check_fee');
        $percentage->insurance_fee =  $request->input('insurance_fee');
        $percentage->equity_contribution =  $request->input('equity_contribution');
        $percentage->purchase_option_fee =  $request->input('purchase_option_fee');
        $percentage->licensing_registration =  $request->input('licensing_registration');
        $percentage->plan_type =  $request->input('plan_type');
        $percentage->save();
        return response()->json(['message' => 'Record Updated successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentPlan  $paymentPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentPlan $paymentPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentPlan  $paymentPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $percentage = PaymentPlan::find($request->input('id'));
        $percentage->delete();
    }
}
