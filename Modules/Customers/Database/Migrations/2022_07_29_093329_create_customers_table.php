<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customers_code')->index();
            $table->string('customers_name', 45)->index();
            $table->string('phone1', 11); // Essential for whatsapp
            $table->string('phone2', 11)->nullable();
            $table->string('email', 127)->nullable();
            $table->string('customers_notes', 127)->nullable();
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
        Schema::dropIfExists('customers');
    }
}
