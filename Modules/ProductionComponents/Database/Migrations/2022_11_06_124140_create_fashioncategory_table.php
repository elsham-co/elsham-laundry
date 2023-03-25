<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFashioncategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fashioncategory', function (Blueprint $table) {
      // $table->smallIncrements('id');
      $table->id();
      $table->unsignedBigInteger('fascategory_code')->index();
      $table->string('fascategory_name', 45)->index();
      // $table->unsignedSmallInteger('code')->index();
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
        Schema::dropIfExists('fashioncategory');
    }
}
