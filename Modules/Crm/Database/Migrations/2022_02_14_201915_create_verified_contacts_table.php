<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\PhoneFinder;

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
            $table->foreignIdFor(Circuit::class, 'circuit_id');
            $table->foreignIdFor(Customers::class, 'customer_id');
            $table->foreignIdFor(PhoneFinder::class, 'phone_id')->nullable();
            $table->foreignIdFor(Contacts::class, 'contact_id')->nullable();
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
