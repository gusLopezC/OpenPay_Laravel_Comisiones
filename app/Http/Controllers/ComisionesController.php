<?php

namespace App\Http\Controllers;
use Openpay;

require_once '../vendor/autoload.php';


use Illuminate\Http\Request;

class ComisionesController extends Controller
{
    //
    public function store(Request $request){

        $openpay = Openpay::getInstance($request->Merchand_id, $request->secret_key);

        if ($request->ModoAmbiente == "false") {
            Openpay::setProductionMode(false);
        } else {
            Openpay::setProductionMode(true);
        }
        



        $feeDataRequest = array(
            'customer_id' => $request->customer_id,
            'amount' => $request->Monto,
            'description' => 'Cobro de Comision ' . $request->customer_id);


        try {
        $fee = $openpay->fees->create($feeDataRequest);
        
        $status = array("status" => true, "charge" => $fee->status);
        } catch (Exception $e) {
            $status = array("status" => false, "error" => "fallo");
        }

        return json_encode($status);

        // return response()->json(['fee' => $fee], 201);

    }
}
