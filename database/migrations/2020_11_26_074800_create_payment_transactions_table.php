<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       return  Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('orderid');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('leasing_application_id')->references('id')->on('leasing_applications');
            $table->foreignId('payment_plan_id')->references('id')->on('payment_plans');
            $table->string('amount_paid');
            $table->text('reference')->nullable();
            $table->text('description')->nullable();
            $table->string('resp_code')->nullable();
            $table->string('resp_desc')->nullable();
            $table->string('pan')->nullable();
            $table->dateTime('trans_date');
            $table->string('gateway');
            $table->text('raw_response')->nullable();
            $table->enum('status', ['APPROVED','PENDING','DECLINED'])->default('PENDING');
            $table->enum('payment_type', ['CASH','CARD'])->default('CARD');
            $table->enum('client_delete', [0,1])->default(0);
            $table->enum('cron', ['YES', 'NO'])->default('NO');
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
        Schema::dropIfExists('payment_transactions');
    }
}
