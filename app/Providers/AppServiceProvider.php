<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\units\Transactions\ITransaction;
use App\units\Transactions\TransactionService;
use App\units\Payments\IPayments;
use App\units\Payments\PaymentService;
use App\units\Report\IReport;
use App\units\Report\ReportService;
class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     */
    public function register(): void
    {

            $this->app->bind(IReport::class,function($app){
          
            return new ReportService;
       
        });



        $this->app->bind(ITransaction::class,function($app){
          
            return new TransactionService;
       
        });



        $this->app->bind(IPayments::class,function($app){
          
            return new PaymentService;
       
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
