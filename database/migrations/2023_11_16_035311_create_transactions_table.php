<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
         
            $table->float('Amount')->comment('The total amount of the transaction');
            $table->float('VAT')->comment('The VAT percentage');
            $table->unsignedBigInteger('Payer')->comment('The customer who will pay the given amount');

            $table->foreign('Payer')->references('id')->on('users');

            $table->dateTime('Due_on')
            ->comment('The date on which the customer should pay');

            $table->enum('Vat_inclusive',['exclusive' , 'inclusive']
            )->comment('Is the VAT amount included in the entered amount');

            $table->enum('status',['Paid' , 'Outstanding', 'Overdue']
            );


       $table->float('paid')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
