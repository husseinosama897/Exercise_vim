<?php
namespace App\units\Payments;
use App\Models\payment;
class PaymentService implements IPayments{


    public function create_payment($request){


        $new_request =    $request->only(['Transaction_ID','Amount','Paid_on','Details']);


       return payment::create($new_request);

       
        
    }



}