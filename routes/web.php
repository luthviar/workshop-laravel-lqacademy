<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;

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


Route::get('/logout', [UsersController::class, 'logout'])->name('logout');

Route::get('/', [ProductsController::class, 'index'])->name('home');
Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['auth']], function() {
    Route::get('create', [ProductsController::class, 'create'])->name('create');
    Route::get('detail/{id}', [ProductsController::class, 'show'])->name('show');    
    Route::get('edit/{id}', [ProductsController::class, 'edit'])->name('edit')->middleware('role:seller');
    Route::post('update/{id}', [ProductsController::class, 'update'])->name('update');
    Route::post('delete', [ProductsController::class, 'delete'])->name('delete');
    Route::post('store', [ProductsController::class, 'store'])->name('store');
});

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
