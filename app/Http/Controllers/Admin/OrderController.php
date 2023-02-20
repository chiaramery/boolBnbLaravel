<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Promotion;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);
        $amount = "";
        if ($request->price == 1) {
            $amount = 2.99;
        }
        if ($request->price == 2) {
            $amount = 5.99;
        }
        if ($request->price == 3) {
            $amount = 9.99;
        }
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Gino',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $end_date = "";

            if ($request->price == 1) {
                $end_date = Carbon::now()->add(1, 'days');
            }
            if ($request->price == 2) {
                $end_date = Carbon::now()->add(3, 'days');
            }
            if ($request->price == 3) {
                $end_date = Carbon::now()->add(6, 'days');
            }
            $apartment = Apartment::where('id', $request->appartamento)->first();
            $apartment->promotions()->attach(
                $request->price,
                [
                    'start_date' => Carbon::now(),
                    'end_date' => $end_date,
                    'is_active' =>  1,
                ]
            );
            return redirect()->route('admin.apartments.index')->with('message', 'Appartamento sponsorizzato correttamente');
        } else {
            return 'notok';
        }
    }
}
