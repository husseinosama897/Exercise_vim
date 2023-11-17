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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Transaction_ID')
            ->comment('The transaction to which this payment belongs');
            $table->foreign('Transaction_ID')->references('id')->on('transactions');
            $table->float('Amount')->comment('The paid amount');

            $table->dateTime('Paid_on')
            ->comment('The date on which this payment was received');

$table->text('Details')->comment('Additional comments that can be entered by the admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
