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
        Openpay::setProductionMode(false);

        // mdrhnprmsmxkgxtegzhk
        // sk_c71babd865fd420b94bc588a8585c122
        // atw8detr4lb9ifyb32af

        $feeDataRequest = array(
            'customer_id' => $request->customer_id,
            'amount' => $request->Monto,
            'description' => 'Cobro de Comision ' . $request->customer_id);
        try {
        $fee = $openpay->fees->create($feeDataRequest);
        } catch (Exception $e) {
        $errorMsg = $e->getMessage();
        $errorCode =  $e->getCode();
        }

        return json_encode($fee);

        // return response()->json(['fee' => $fee], 201);

    }
}
