<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasingApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leasing_applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->enum('application_type', ['individual', 'corporate'])->default('individual');
            $table->string('business_name');
            $table->string('business_email');
            $table->string('business_nature')->nullable();
            $table->string('last_year_net_income')->nullable();
            $table->string('current_year_income')->nullable();
            $table->string('evidence_of_residence')->nullable();
            $table->string('incorporation_business_name')->nullable();
            $table->text('details_of_asset')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('id_number')->nullable();
            $table->text('financial_obligation')->nullable();
            $table->text('goods_description')->nullable();
            $table->text('certificate')->nullable();
            $table->text('guarantor_1')->nullable();
            $table->text('guarantor_2')->nullable();
            $table->text('guarantor_3')->nullable();
            $table->enum('application_status',['open', 'closed'])->default('open');
            $table->enum('status',['Approved', 'declined', 'pending'])->default('pending');
            $table->enum('Admin_status',['Approved', 'declined', 'pending'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leasing_applications');
    }
}
