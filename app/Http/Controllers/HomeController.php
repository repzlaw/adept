<?php

namespace App\Http\Controllers;

use App\Models\LeasingApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentTransaction;
use App\Models\User;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $data = PaymentTransaction::join('leasing_applications as la', 'la.id', 'payment_transactions.leasing_application_id')
                ->join('suppliers as sup', 'sup.leasing_application_id', 'la.id')
                ->where('la.user_id', $user_id)
                ->select('payment_transactions.*','la.business_name', 'item')
                ->orderBy('payment_transactions.created_at','desc')->get();
        return Inertia::render('Dashboard',['data'=>$data]);
    }

    //get dashboard stats
    public function stats()
    {
        $user = Auth::user();
        if ($user->user_type === 'admin') {
            $total_applications = LeasingApplication::count();
            $approved_applications = LeasingApplication::where('status','Approved')->count();
            $declined_applications = LeasingApplication::where('status','declined')->count();
            $pending_applications = LeasingApplication::where('status','pending')->count();
            
        }
        else{
            $total_applications = LeasingApplication::where('id', $user->id)->count();
            $approved_applications = LeasingApplication::where(['id'=> $user->id, 'status'=>'Approved' ])->count();
            $declined_applications = LeasingApplication::where(['id'=> $user->id, 'status'=>'declined' ])->count();
            $pending_applications = LeasingApplication::where(['id'=> $user->id, 'status'=>'pending' ])->count();
        }
        return response()->json(['total_applications'=> $total_applications, 'approved_applications'=> $approved_applications,'declined_applications'=> $declined_applications,
                            'pending_applications'=> $pending_applications ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
