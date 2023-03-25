<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFabricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fabric', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryFabric')->nullable();
            $table->foreign('categoryFabric')->references('id')->on('fabric_category')->onDelete('cascade');
            // $table->foreignID('categoryFabric')->nullable()->constrained('fabric_category')->onDelete('cascade');
            // $table->string('code',5)->index();
            $table->unsignedBigInteger('fabric_code')->index();
            $table->string('fabricName', 63)->index();
            $table->string('fabricnotes', 127)->nullable();
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
        Schema::dropIfExists('fabric');
    }
}
