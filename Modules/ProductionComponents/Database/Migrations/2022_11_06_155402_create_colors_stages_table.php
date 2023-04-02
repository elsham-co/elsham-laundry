<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorsStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors_stages', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('colcategcode')->nullable();
            $table->foreign('colcategcode')->references('id')->on('colorscategory')->onDelete('cascade');
            $table->string('colorcode',20)->index();
            $table->string('colorname', 45)->index();
            $table->string('colornotes', 127)->nullable();
            $table->unsignedSmallInteger('mainornot')->nullable();
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
        // Schema::dropIfExists('colorscategory');
        Schema::dropIfExists('colors_stages');
    }
}
