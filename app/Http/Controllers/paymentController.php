<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\units\Payments\IPayments;
use App\Http\Requests\StorePaymentRequest;
use App\units\Transactions\ITransaction;
class paymentController extends Controller
{
    
private $IPayments , $ITransaction;

    function __construct(IPayments $IPayments  , ITransaction $ITransaction){
      
        $this->IPayments = $IPayments;
        $this->ITransaction = $ITransaction;
   
    }


    public function store(StorePaymentRequest $request){

   $transaction_status = $this->ITransaction->change_status_transaction($request);

   
  if($transaction_status['success'] == true){

 $payment =  $this->IPayments->create_payment($request);


  }else{


    return response()->json($transaction_status,243);

  }



return response()->json([

    'success'   => true,

    'message'   => 'payment was made',

    'data'      => $payment

], 200);

 
    }




}
