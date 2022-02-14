<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\PhoneFinder;

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
            $table->id();
            $table->foreignIdFor(Circuit::class, 'circuit_id');
            $table->string('mailing_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('physical_address')->nullable();
            $table->string('physical_city')->nullable();
            $table->string('physical_state')->nullable();
            $table->string('title')->nullable();
            $table->string('work_order')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
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
