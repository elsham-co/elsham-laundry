<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleCreationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_creation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_code')->nullable();
            $table->timestamp('sample_date')->nullable();  // تاريخ انشاء العينه 
            $table->timestamp('lab_receiptdate')->nullable();      //   اسنلام العينه من خدمه العملاء 
            $table->unsignedBigInteger('fabrics_code')->nullable();  // نوع الصنف
          
            // $table->string('samplecode',30)->nullable();       // رقم العينه
            $table->bigInteger('samplecode')->unsigned()->index()->nullable(); 
            // $table->string('repetition_code',25)->nullable();   //   اسم
           
            $table->string('classification', 20)->default('0')->nullable();  //  التصنيف: عينه/كارتله
            $table->string('operation_type', 20)->nullable();    //نوع العمليه
           
            $table->string('technical_description', 25)->nullable();  // الكود المرجعي
            $table->string('sample_titleimage', 35)->nullable(); // عنوان الصور
            $table->string('sample_imagepath', 255)->nullable(); //  مسار الصور
            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();


                       // foreign keys
                       $table->foreign('samplecode')->references('samplecode')->on('samples_order')->onDelete('cascade');
                       $table->foreign('customer_code')->references('id')->on('customers')->onDelete('cascade');
                       $table->foreign('fabrics_code')->references('id')->on('fabric')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sample_creation');
    }
}
