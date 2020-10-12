<?php

namespace App\Http\Controllers;
use Openpay;

require_once '../vendor/autoload.php';


use Illuminate\Http\Request;

class ComisionesController extends Controller
{
    //
    public function store(Request $request){


        $openpay = Openpay::getInstance('mdrhnprmsmxkgxtegzhk', 'sk_c71babd865fd420b94bc588a8585c122');

        $feeDataRequest = array(
            'customer_id' => 'a9ualumwnrcxkl42l6mh',
            'amount' => 12.50,
            'description' => 'Cobro de Comisión',
            'order_id' => 'ORDEN-00063');
        
        $fee = $openpay->fees->create($feeDataRequest);

            return $fee->toJson();

    }
}
