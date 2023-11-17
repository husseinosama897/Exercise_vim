<?php
namespace App\units\Transactions;
use App\Models\transaction;
use DateTime;
class TransactionService implements ITransaction {


    public function create_transaction($request){


     $new_request =    $request->only(['Amount','VAT','Payer','Due_on','Vat_inclusive']);

     $Due_on = new DateTime($request->Due_on); 

     $new_request['status'] = date('Y-m-d') >= $Due_on->format("Y-m-d")  ? 'Overdue' :'Outstanding';

       return transaction::create($new_request);


    }


    
    public function change_status_transaction($request){


    $transaction =  transaction::find($request->Transaction_ID);

    $PaidAmount = ($request->Amount + $transaction->paid);

    $Due_on = new DateTime($transaction->Due_on); 

   
    $status = $transaction->status;

if($transaction->Amount  == $PaidAmount ){

  $status = 'paid';

}elseif($transaction->Amount > $PaidAmount  && date('Y-m-d') >= $Due_on->format("Y-m-d")  ){

  $status = 'Overdue'; 

}

elseif($transaction->Amount > $PaidAmount  && date('Y-m-d') < $Due_on->format("Y-m-d")){

  $status = 'Outstanding'; 

} 

else{

 return [

    'success'   => false,
  
    'message'   => 'paid errors',
  
  ];

} 





$transaction->update([
  'paid'=>$PaidAmount,
  'status'=>$status
]);





return [
  'success'=>true
];

    }



    
    public function transactions_list($conditions){

      $transaction = transaction::query();
     
      if(!empty($conditions['is_user'])){
        $transaction = $transaction->where('Payer',$conditions['Payer']);
      }

      
 

      return $transaction;

     

    }


}

