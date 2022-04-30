<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('payment_duration', $precision = 8, $scale = 2);
            $table->decimal('interest_charge', $precision = 8, $scale = 2);
            $table->decimal('processing_fee', $precision = 8, $scale = 2);
            $table->decimal('legal_fee', $precision = 8, $scale = 2);
            $table->decimal('vat_fee', $precision = 8, $scale = 2);
            $table->decimal('credit_check_fee', $precision = 8, $scale = 2);
            $table->decimal('insurance_fee', $precision = 8, $scale = 2);
            $table->decimal('equity_contribution', $precision = 8, $scale = 2);
            $table->decimal('purchase_option_fee', $precision = 8, $scale = 2);
            $table->decimal('licensing_registration', $precision = 8, $scale = 2)->nullable();
            $table->enum('plan_type', ['normal', 'custom'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_plans');
    }
}
