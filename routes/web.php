<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsertController;

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



Route::group(['middleware' => 'prevent-back-history'],function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');



    })->middleware(['auth', 'verified'])->name('dashboard');


    Auth::routes();

    Route::middleware('auth')->group(function () {

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::get('/entry', [InsertController::class, 'entry']);
        Route::post('/insert', [InsertController::class, 'insert']);
        Route::get('/editEntry/{bId}', [InsertController::class, 'editEntry']);
        Route::post('/update/{bId}', [InsertController::class, 'update']);
        Route::get('/disableEntry/{bId}', [InsertController::class, 'disableEntry']);
        Route::get('/invoiceGenerate/{bId}', [InsertController::class, 'invoiceGenerate']);
        Route::get('/invoiceList', [InsertController::class, 'invoiceList']);
        Route::get('/singleInvoice/{bId}', [InsertController::class, 'singleInvoice']);
        Route::get('/sendMail/{bId}/mail', [InsertController::class, 'sendMail']);
    });
});




require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
