<?php
namespace App\units\Transactions;

interface ITransaction {
    


    public function create_transaction($request);


    public function change_status_transaction($request);
    

    public function transactions_list($conditions);

}