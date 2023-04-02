<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSamplesOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('samples_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('samplecode')->unsigned()->index(); 
            $table->timestamp('ReceiptDate')->nullable();
            $table->string('Deliveredto',30)->nullable();
            $table->timestamp('DeliveryDate')->nullable();
            $table->unsignedSmallInteger('Delivery_by')->nullable();
            $table->timestamp('fromlab_date')->nullable();
            $table->unsignedSmallInteger('fromlab_by')->nullable();
            $table->bigInteger('nopieces')->nullable();    //عدد القطع
            
            $table->unsignedBigInteger('customer_code')->nullable();
            $table->unsignedBigInteger('fabrics_code')->nullable();
            $table->string('colors_code', 300)->nullable();
            $table->string('fashion_code', 300)->nullable();
            
            $table->string('samplesnotes', 127)->nullable();
            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->string('sampleorder_titleimage', 35)->nullable(); // عنوان الصور
            $table->string('sampleorder_imagepath', 255)->nullable(); //  مسار الصور
            $table->softDeletes();
            $table->timestamps();
            // foreign keys
            // $table->foreign('customer_code')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('customer_code')->references('customers_code')->on('customers')->onDelete('cascade');
            // $table->foreign('fabrics_code')->references('id')->on('fabric')->onDelete('cascade'); 
            $table->foreign('fabrics_code')->references('fabric_code')->on('fabric')->onDelete('cascade');
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('samples_order');
    }
}
