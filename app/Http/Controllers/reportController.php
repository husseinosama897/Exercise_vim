<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\units\Report\IReport;

class reportController extends Controller
{

    function __construct(IReport $IReport){
      
        $this->IReport = $IReport;
   
    }

    public function transaction(request $request){

$this->validate($request,[
'start_date'=>'date',
    'end_date'=>'date|after_or_equal:start_date',
]);

      $report =  $this->IReport->transaction_report($request)->get();

      
      return response()->json(['data'=>$report],200);

    }




}
