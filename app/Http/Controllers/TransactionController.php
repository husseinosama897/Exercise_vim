<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\units\Transactions\ITransaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\transaction;
use DB;
class TransactionController extends Controller
{
    
    function __construct(ITransaction $ITransaction){
      
        $this->ITransaction = $ITransaction;
   
    }

  
public function store(StoreTransactionRequest $request){


 $transaction =  $this->ITransaction->create_transaction($request);


return response()->json([

    'success'   => true,

    'message'   => 'transaction accomplished',

    'data'      => $transaction

], 200);

}


public function list(){
    $conditions = [];
    $conditions['is_user'] = \Auth::user()->is_customer();
    $conditions['Payer'] = \Auth::user()->id;

$transactions =  $this->ITransaction
->transactions_list($conditions)
->select(['Amount','Due_on','VAT','Vat_inclusive', 'status' , 'Payer'])
->get();
    
return response()->json([

    'success'   => true,

    'message'   => 'transactions collected',

    'data'      => $transactions

], 200);

}

public function report(){

    $transactions =  $this->ITransaction
    ->transactions_list(\Auth::user()->is_customer(), \Auth::user()->id)
    ->join('payments', 'transactions.id', '=', 'payments.Transaction_ID')

  ->select(
        DB::raw(   DB::raw("year(Due_on) as year")  ) ,DB::raw("month(Due_on) as month")
        ,
  
        DB::raw('SUM(CASE WHEN status = "Paid" THEN payments.Amount ELSE 0 END) as Paid'),

        DB::raw('SUM(CASE WHEN status = "Outstanding" THEN payments.Amount ELSE 0 END) as Outstanding'),

        DB::raw('SUM(CASE WHEN status = "Overdue" THEN payments.Amount ELSE 0 END) as Overdue'),

        )
        
     
        ->groupBy('year','month')->get();

return response()->json($transactions,200);

    }


}
