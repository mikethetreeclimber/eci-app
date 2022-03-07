<?php

use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\Customers;
use Modules\Crm\Entities\PhoneFinder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiedContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verified_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('service_address')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('phone_three')->nullable();
            $table->string('phone_four')->nullable();
            $table->string('phone_five')->nullable();
            $table->string('email_address')->nullable();
            $table->text('other_names')->nullable();
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
        Schema::dropIfExists('verified_contacts');
    }
}
