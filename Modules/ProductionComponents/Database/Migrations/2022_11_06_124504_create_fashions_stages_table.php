<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFashionsStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fashions_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fascateg_code')->nullable();
            $table->foreign('fascateg_code')->references('id')->on('fashioncategory')->onDelete('cascade');
            $table->string('fashioncode',20)->index();
            $table->string('fashionname', 45)->index();
           
            // $table->string('type', 63);
            $table->string('fashioncount', 5)->nullable();
            $table->string('fashionnotes', 127)->nullable();
            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->unsignedSmallInteger('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('fashions_stages');
    }
}
