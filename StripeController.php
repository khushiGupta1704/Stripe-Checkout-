<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StripeApi;

class StripeController extends Controller
{
	public function paymentPage(){
		return view('payment');
	}
	public function PaymentGatewayRedirection(){
		$stripeApi=new StripeApi();
		$skey='your secret key';
		$pkey='your publish key';
		//creating session for payment in stripe
		$stripe_response=$stripeApi->StripePayment($skey,$pkey);
		if(!empty($stripe_response) && isset($stripe_response->id)){
			$response=[];
			$response['session_id']=$stripe_response->id;
			$response['stripe_key']=$pkey;
			//returning to view for stripe payment 
			return view('stripe')->with(['response'=>$response]);
		}
	}
    public function SavePayment(Request $request){
		$stripeSessionId=$request->session_id;
		$skey='secret key';
		//Retrieving data from stripe using session_id
		$stripeApi=new StripeApi;
		$res=$stripeApi->getStripeSession($stripeSessionId,$skey);
		//Here You can save data in your database.
	}
}
