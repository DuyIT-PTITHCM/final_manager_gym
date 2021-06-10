<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img')->nullable();
            $table->integer('type_machine_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->boolean('disable')->nullable();

            $table->integer('supplier_id')->nullable();
            $table->integer('purchasing_id')->nullable();

            $table->double('pricebuy')->nullable();
            $table->double('pricesales')->nullable();
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
        Schema::dropIfExists('devices');
    }
}
