<?php

namespace App\Http\Controllers;

use App\Models\LeasingApplication;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;

class ApplicationStageController extends Controller
{
    public function getApplication(Request $request)
    {
        // dd($request->input('app_id'));
        $app = LeasingApplication::where('id',$request->input('app_id'))->first();

        return $app;
    }

    //get payment plan
    public function getPaymentPlan()
    {
        $payPlan = PaymentPlan::all();
        
        return $payPlan;
    }
}
