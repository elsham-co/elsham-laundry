<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplecatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samplecat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('stage_code')->index();       // كود نوع المرحله
            $table->string('stage_typename', 30);  //  اسم نوع المرحله
            $table->string('measruing_name', 20);  // اسم وحده القياس
            $table->string('measruing_unit', 20);  // وحده القياس
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
        Schema::dropIfExists('samplecat');
    }
}
