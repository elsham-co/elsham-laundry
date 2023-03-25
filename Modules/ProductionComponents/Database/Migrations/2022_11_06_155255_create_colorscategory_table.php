<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColorscategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colorscategory', function (Blueprint $table) {
         
                // $table->smallIncrements('id');
                $table->id();
                // $table->string('code',5)->index();
                $table->bigInteger('CategoryCol_code')->unsigned();
                // $table->unsignedSmallInteger('code')->index();
                $table->string('CategoryCol_name', 45)->index();
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
        // Schema::dropIfExists('colors');
        Schema::dropIfExists('colorscategory');
    }
}
