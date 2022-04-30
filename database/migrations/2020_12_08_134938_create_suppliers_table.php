<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leasing_application_id')->references('id')->on('leasing_applications');
            $table->foreignId("payment_plan_id")->nullable()->references('id')->on('payment_plans');
            $table->string('name');
            $table->string("address");
            $table->string("phone");
            $table->string("item");
            $table->string("description");
            $table->string("amount");
            $table->string("amount_to_refund")->nullable();
            $table->string("amount_per_month")->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_name')->nullable();
            $table->string('goods_type')->nullable();
            $table->string('payment_spread')->nullable();
            $table->string('advance_rentals')->nullable();
            $table->enum('status',['Pending', 'Cancelled','Completed'])->default('Pending');
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
        Schema::dropIfExists('suppliers');
    }
}

