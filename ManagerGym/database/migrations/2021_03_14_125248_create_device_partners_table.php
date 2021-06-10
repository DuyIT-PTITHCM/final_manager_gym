<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_partners', function (Blueprint $table) {
            $table->id();
            $table->integer('device_id')->nullable();
            $table->integer('partner_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('service_id')->nullable();
            $table->timestamp('enddate')->nullable();
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
        Schema::dropIfExists('device_partners');
    }
}
