<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sample_code')->unsigned()->index()->nullable();       // رقم العينه
            // $table->bigInteger('repetition_code')->unsigned()->index()->nullable();   //  عدد تكرار العينه
            $table->string('stage_category', 20)->nullable();       // كود نوع المرحله
            // $table->string('stage_type', 30);  //  نوع المرحله
            $table->string('stage_name', 45)->nullable();    // اسم المرحله
            $table->string('stage_notes', 20)->nullable();    // ملاحظات المرحله
            
           

            // $table->bigInteger('water')->nullable();
            // $table->bigInteger('industrial_salt')->nullable();
            // $table->bigInteger('ash')->nullable();  // اش
            // $table->bigInteger('msd')->nullable();  //  ماده كاويه
            // $table->bigInteger('heat')->nullable();
            // $table->bigInteger('ctime')->nullable();  //  زمن العمليه


            // $table->string('notes', 127);
            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->timestamps();


                       // foreign keys
                     
                    //    $table->foreign('stage_code')->references('id')->on('samplecat')->onDelete('cascade');
                    //    $table->foreign('sample_code')->references('sample_code')->on('sample_creation')->onDelete('cascade');
                    //    $table->foreign('repetition_code')->references('repetition_code')->on('sample_creation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_info');
    }
}
