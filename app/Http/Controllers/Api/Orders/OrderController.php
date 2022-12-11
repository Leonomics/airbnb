<?php

namespace App\Http\Controllers\Api\Orders;


use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Apartment;
use App\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'token' => $token
        ];

        return response()->json($data, 200);
    }

    public function makePayment(Request $request, Gateway $gateway){

        $sponsor = Sponsor::find($request->sponsor);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            //token inviato dal frontend, diverso dall'altro
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){

            // sync apartment sponsor params
            $apartment = Apartment::where('id', $request->apartment['id'])->first();
            // se c'è già una sponsorizzazione aggiungo la nuova durata alla data esistente
            if($apartment->sponsors){
                $actual_date = $apartment->sponsors()->pluck('expire_date')->sortDesc()->first();
                $expire_date = Carbon::parse($actual_date)->addHours($sponsor->duration);
            } else {
                $actual_date = Carbon::now();
                $expire_date = Carbon::parse($actual_date)->addHours($sponsor->duration);
            }
            
            $apartment->sponsors()->attach($sponsor->id, 
            [
                'transaction_id' => $result->transaction->id,
                'expire_date' => $expire_date
            ]);
            $sponsors = $apartment->sponsors()->pluck('id')->toArray();
            array_push($sponsors, $sponsor->id);
            $apartment->sponsors()->sync($sponsors);
    
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con successo',
                'id' => $result
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'success' => false,
                'message' => 'Transazione fallita'
            ];
            return response()->json($data, 401);
        }
    }
}
