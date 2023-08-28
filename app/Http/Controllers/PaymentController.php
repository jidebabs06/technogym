<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Paystack;
use App\Models\Payment;
use App\Models\Plan;

class PaymentController extends Controller
{

    /**
    * Redirect the User to Paystack Payment Page
    * @return Url
    */
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
    * Obtain Paystack payment information
    * @return void
    */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        // Check if payment was successful
        // dd($paymentDetails);
        if ($paymentDetails['data']['status'] === 'success') {

            // return response()->json(['Status' => 'Your payment was successful and confirmed by Paystack'], 200)->header('Content-Type', 'application/json');
            return redirect('/dashboard');

            $transactionReference = $paymentDetails['data']['reference'];
            $amount = $paymentDetails['data']['amount'];
            // $userId = $paymentDetails['data']['metadata']['Auth::user()->id'];
            // $planId = $paymentDetails['data']['metadata']['plan_id'];
            // Get the authenticated user
            $user = Auth::user();
            // $plandetails=Plan::where('id',$paymentDetails['data']['metadata']['plan_id'] )->first();
            $planId = $user->plans->first()->id;
            // dd($planId);

            // Save the Paystack details to the database
            Payment::create([
                'user_id' => $user->id,
                'plan_id'=> $planId,
                'transaction_reference' => $transactionReference,
                'amount' => $amount,
            ]);

            return response()->json(['status' => 'success']);
        }

        // If payment was not successful, handle accordingly
        return response()->json(['status' => 'error']);
        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
