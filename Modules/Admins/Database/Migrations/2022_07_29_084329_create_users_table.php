<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('full_name', 63);
            // $table->string('last_name', 63);
            $table->string('email', 127)->index();
            $table->string('username', 127)->index();
            $table->string('password', 63);
            $table->string('phone', 12)->nullable()->index();
            $table->unsignedTinyInteger('active')->index();
            $table->string('remember_token', 255)->nullable();
            $table->unsignedSmallInteger('created_by')->index();
            $table->unsignedSmallInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index(['username', 'password']);
            $table->index(['email', 'password']);
            $table->index(['password', 'phone']);
            $table->index(['email', 'username', 'phone', 'active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}