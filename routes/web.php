<?php

use Illuminate\Support\Facades\Route;
use Modules\Crm\Entities\Contacts;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $contactsCount = count(Contacts::get());
    return view('dashboard', compact('contactsCount'));
})->name('dashboard');
