<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // user_type', 'address', 'phone',
        // 'lga', 'sex', 'marital_status','dob', 'religion', 'is_complete'
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('surname')->nullable();
            $table->string('othername')->nullable();
            $table->string('name'); 
            $table->string('bvn_number')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('user_type',['client', 'admin'])->default('client');
            $table->text('adddress')->nullable();
            $table->string('phone')->nullable();
            $table->string('lga')->nullable();
            $table->enum('sex',['m', 'f'])->default('m')->nullable();
            $table->enum('marital_status',['single', 'married', 'divorce', 'none'])->default('married')->nullable();
            $table->date('dob')->nullable();
            $table->enum('religion', ['islamic', 'christian', 'other'])->default('other')->nullable();
            $table->enum('is_complete', ['yes', 'no'])->default('no')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}
