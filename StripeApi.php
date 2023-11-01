<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripeApi extends Model
{
    use HasFactory;
	public function StripePayment($s_key){
		
		$stripe = new \Stripe\StripeClient($s_key);
		$response=$stripe->checkout->sessions->create([
		  'success_url' => route('save.payment')."?session_id={CHECKOUT_SESSION_ID}&",
		  'cancel_url' => route('home.page'),
		  'line_items' => [
			[
			  'price_data' => [
					'currency'=>'USD',
					'product_data'=>[
					'name'=>'Primary Plan',
					],
					'unit_amount'=>1,
			  ],
			  'quantity' => 1*100,
			],
		  ],
		  'mode' => 'payment',
		]);
		return $response;
		
	}
	//function for retrieving session using session id
	public function getStripeSession($session_id,$skey){
		$stripe = new \Stripe\StripeClient($skey);
		$response=$stripe->checkout->sessions->retrieve($session_id,[]);
		return $response;
	}
}
