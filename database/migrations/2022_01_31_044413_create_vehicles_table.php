<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration', 100)->unique();
            $table->string('purchase_type', 50);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('vehicle_cc', 20)->nullable();
            $table->unsignedBigInteger('vehi_type_id')->nullable();
            $table->foreign('vehi_type_id')->references('id')->on('vehicletypes')->onDelete('cascade');
            $table->unsignedBigInteger('vehi_cat_id')->nullable();
            $table->foreign('vehi_cat_id')->references('id')->on('vehicletypes')->onDelete('cascade');
            $table->string('engine_type', 30)->nullable();
            $table->string('seat', 10)->nullable();
            $table->string('fuel_type', 20)->nullable();
            $table->string('fuel_limit', 25)->nullable();
            $table->unsignedBigInteger('colour_id')->nullable();
            $table->foreign('colour_id')->references('id')->on('colours')->onDelete('cascade');
            $table->string('vehicle_model', 10)->nullable();
            $table->string('chasis_no', 50)->nullable();
            $table->string('engine_no', 50)->nullable();
            $table->date('tax', 30)->nullable();
            $table->date('fitness', 30)->nullable();
            $table->date('cylinder', 30)->nullable();
            $table->string('remarks', 150)->nullable();
            $table->string('status')->default(1);
            $table->string('assign_status')->default(0);
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
        Schema::dropIfExists('vehicles');
    }
}
