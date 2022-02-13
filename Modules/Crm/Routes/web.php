<?php

use Illuminate\Support\Facades\Route;
use Modules\Crm\Http\Controllers\CrmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')
    ->prefix('crm')->as('crm.')
        ->group(function() {
            Route::get('/', [CrmController::class, 'index'])->name('index');
            Route::get('/{circuit:circuit_name}', [CrmController::class, 'show'])->name('show');
            Route::get('/{circuit:circuit_name}/customer/{customer}', [CrmController::class, 'showCustomer'])->name('customer.show');
});
