<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


use App\Http\Controllers\LoginController;
use App\Http\Controllers\CustomerController;


Route::get('/', [LoginController::class , 'login'])->name('login');
Route::post('/submitlogin', [LoginController::class , 'submitlogin'])->name('submitlogin');
Route::get('/logout', [LoginController::class , 'logout'])->name('logout');

Route::middleware([checkAdministratorLogin::class])->group(function () {

    Route::resource('customers', CustomerController::class)->names([
        'index' => 'customers.index',
        'create' => 'customers.create',
        'store' => 'customers.store',
        'show' => 'customers.show',
        'edit' => 'customers.edit',
        'update' => 'customers.update',
        'destroy' => 'customers.destroy',
    ]);


    // Route::get('/customer-list', [CustomerController::class , 'dashboard'])->name('customerlist');
});
