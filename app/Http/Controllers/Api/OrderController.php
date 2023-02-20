<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Promotion;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(OrderRequest $request, Gateway $gateway)
    {
        $token = $gateway->clientToken()->generate();

        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayement(OrderRequest $request, Gateway $gateway)
    {
        $promotion = Promotion::find($request->promotion);
        $result = $gateway->transaction()->sale([
            'amount' => $promotion->price,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        dd($result);
        if ($result->success) {
            $data = [
                'success' => true,
                'message' => "transazione esguita con successo!"
            ];
            return response()->json($data, 200);
        } else {
            $data = [
                'success' => false,
                'message' => "transazione fallita"
            ];
            return response()->json($data, 401);
        }
    }
}
