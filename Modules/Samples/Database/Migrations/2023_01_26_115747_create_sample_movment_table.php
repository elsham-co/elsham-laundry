<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleMovmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_movment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('samplecode')->unsigned()->index(); 
            $table->string('samplestage', 35)->nullable();
            $table->unsignedSmallInteger('created_by')->index();
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
        Schema::dropIfExists('sample_movment');
    }
}
