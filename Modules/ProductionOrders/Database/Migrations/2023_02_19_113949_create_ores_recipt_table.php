<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOresReciptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ores_recipt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('orescode')->unsigned()->index()->nullable(); 
            $table->timestamp('ores_recipt_date')->nullable();  // تاريخ استلام الخامات 
            $table->unsignedBigInteger('customer_code')->nullable();
            $table->string('model_no',25)->nullable();  // رقم الموديل
            $table->unsignedBigInteger('fabrics_code')->nullable();  // نوع الصنف
            $table->unsignedSmallInteger('material_number')->nullable(); // عدد الخامات
            $table->unsignedSmallInteger('material_weight')->nullable(); // وزن الخامات
            $table->string('materials_receiver', 25)->nullable();  //  اسم مستقبل الخامات
            $table->string('materials_notes', 127)->nullable(); //   ملاحظات استلام الخام

            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('ores_recipt');
    }
}
