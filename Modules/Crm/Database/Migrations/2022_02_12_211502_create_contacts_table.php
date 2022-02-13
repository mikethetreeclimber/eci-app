<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Customers;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customers::class, 'customer_id')->nullable();
            $table->string('region')->nullable();
            $table->integer('feeder_id')->nullable();
            $table->string('substation_name')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('service_address')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('email_address')->nullable();
            $table->string('revenue_class_desc')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
