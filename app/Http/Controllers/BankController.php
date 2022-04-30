<?php

namespace App\Http\Controllers;

use App\Models\LeasingApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * connecting to paystack API to get all banks
     */
    public function banks()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_test_3ea40300eee280c991f7ef050973c11613b001fc',
            'Cache-Control' => 'no-cache'
        ])->get("https://api.paystack.co/bank");

        return $response;
    }

    //////controller function to resolve account
    public function resolve_account(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=" . $request->account_number . "&bank_code=" . $request->bank_code,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_9fe34898bc7064f9c1738ce7ffd94b317a137d0b",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return response()->json(['data' => json_decode($response)], 200);
        }
    }

    //////controller function to resolve account
    public function resolve_bvn(Request $request)
    {
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.paystack.co/bank/resolve_bvn/".$request->bvn_number,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //     "Authorization: Bearer sk_test_9fe34898bc7064f9c1738ce7ffd94b317a137d0b",
        //     "Cache-Control: no-cache",
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);

        // if ($err) {
        //     return "cURL Error #:" . $err;
        // } else {
        //     return response()->json(['data'=>json_decode($response)], 200);
        // }
    }
    //////controller function to save account details to database
    public function save_account(Request $request)
    {


        ///fing agent
        $user = User::where('id', $request->id)->first();
        //////update the agent database with agent bank details
        $user->update([
            'bank_code' => $request->bank_code,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'bvn_number' => $request->bvn_number,
        ]);

        /////return page
        return response()->json(['success' => 'Account Details Updated Successfully '], 200);
    }

    //////controller function to save account details to database
    public function save_bvn(Request $request)
    {

        ///fing agent
        $user = User::where('id', Auth::user()->id)->first();
        //////update the agent database with agent bank details
        $user->update([
            'bvn_number' => $request->bvn_number,
        ]);

        /////return page
        return response()->json(['success' => 'Account Details Updated Successfully '], 200);
    }

    // Controller Function TO Save NIN details

    public function save_nin(Request $request)
    {

        ///fing agent
        $user = User::where('id', Auth::user()->id)->first();
        $user->update([
            'nin_number' => $request->nin_number,
        ]);

        /////return page
        return response()->json(['success' => 'Account Details Updated Successfully '], 200);
    }
}
