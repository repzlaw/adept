<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStateLgasTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('stname');
            $table->timestamps();
        });


        Schema::create('state_lgas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->nullable()->constrained('states');
            $table->string('lganame');
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
        Schema::dropIfExists('state_lgas');
        Schema::dropIfExists('states');
    }   
}
