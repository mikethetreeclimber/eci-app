<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Crm\Entities\Address;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Circuit::class, 'circuit_id');
            $table->foreignIdFor(Customers::class, 'customer_id');
            $table->string('station_name')->nullable();
            $table->string('unit')->nullable();
            $table->string('assessed_date')->nullable();
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
        Schema::dropIfExists('stations');
    }
}
