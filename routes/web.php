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
use App\Http\Controllers\BookController;


Route::get('/', [BookController::class , 'books'])->name('books');
Route::get('admin/', [LoginController::class , 'login'])->name('login');
Route::post('/submitlogin', [LoginController::class , 'submitlogin'])->name('submitlogin');
Route::get('/logout', [LoginController::class , 'logout'])->name('logout');
Route::get('/getdata', [BookController::class , 'getdata'])->name('getdata');
Route::get('/viewbook/{id}', [BookController::class , 'viewbook'])->name('viewbook');

Route::middleware([checkAdministratorLogin::class])->group(function () {

    Route::resource('admin/manage-book', BookController::class)->names([
        'index' => 'manage-book.index',
        'create' => 'manage-book.create',
        'store' => 'manage-book.store',
        'show' => 'manage-book.show',
        'edit' => 'manage-book.edit',
        'update' => 'manage-book.update',
        'destroy' => 'manage-book.destroy',
    ]);


});
