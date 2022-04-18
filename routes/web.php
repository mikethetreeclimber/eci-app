<?php

use App\Http\Controllers\Admin\UsersController;
use Modules\Crm\Entities\Circuit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\Customers;
use Modules\Crm\Entities\Permission;
use Illuminate\Support\Facades\Route;

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
    // dd(auth()->user()->customers);
    $customersCount = auth()->user()->customers->count();
    $permissionCount = auth()->user()->permissions->count();
    $activeCircuits = auth()->user()->circuits->count();
    return view('dashboard', compact('customersCount', 'permissionCount', 'activeCircuits'));
})->name('dashboard');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'is_admin'
], function(){
    Route::get('/users', [UsersController::class, 'index'])
        ->name('users');
   
});

// "utilIn = 'https://ppl01.geodigital.com:8382/DDOProtocol/GETCOLUMNGROUP'
//     response = requests.post(utilIn, json = {"Protocol":"getcolumngroup","columngroupguid":"{73876A7F-2FCD-493C-956D-EB8EAE3EC65B}","columngroupname":"ECI Mailing List"},
//                                              auth=('ECI\eci christian', 'andersoneci'),verify=False)               

//     jsonResponse = response.json()";
