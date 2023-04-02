<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('samplecode')->unsigned()->index()->nullable();       // رقم العينه
            
            $table->string('sample_recipy_name', 45)->nullable();    // العدد او النسبه
            $table->string('ratio/number', 20)->nullable();    // العدد او النسبه
            $table->string('measruing_name', 35)->nullable();   // اسم وحده القياس
            $table->string('measruing_unit', 35)->nullable();   // وحده القياس
            $table->unsignedSmallInteger('used_time')->nullable();  //  الوقت المستخدم
            $table->unsignedSmallInteger('used_heat')->nullable();   //  درجة حرارة
            $table->timestamps();

            // foreign keys
            $table->foreign('samplecode')->references('samplecode')->on('sample_creation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
