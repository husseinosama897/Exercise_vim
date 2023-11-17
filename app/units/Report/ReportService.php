<?php

namespace App\units\Report;
use App\units\Transactions\ITransaction;
use DB;
class ReportService implements IReport{


    public function transaction_report($request){

$transaction = resolve(ITransaction::class);

$report =  $transaction->transactions_list($request)->join('payments', 'transactions.id', '=', 'payments.Transaction_ID');


if($request->start_date){
    $report = $report->whereDate('Due_on','>=',$request->start_date);
  }

  if($request->end_date){
    $report = $report->whereDate('Due_on','<=',$request->end_date);
  }


$report = $report->select(
      DB::raw(   DB::raw("year(Due_on) as year")  ) ,DB::raw("month(Due_on) as month")
      ,
      DB::raw('SUM(CASE WHEN status = "Paid" THEN payments.Amount ELSE 0 END) as Paid'),

      DB::raw('SUM(CASE WHEN status = "Outstanding" THEN payments.Amount ELSE 0 END) as Outstanding'),

      DB::raw('SUM(CASE WHEN status = "Overdue" THEN payments.Amount ELSE 0 END) as Overdue'),

    )
      
   
      ->groupBy('year','month');

   



      return $report;


    }


}