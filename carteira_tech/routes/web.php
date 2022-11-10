<?php

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
    return view('index');
})->middleware('guest')->name('index');

Route::get('/inicial', function () {
    //return view('welcome');
    return redirect()->route('indexAplication');
})->name('inicial');


Route::get('/teste', function () {
    return view('teste');
})->name('teste');


require __DIR__ . '/auth.php';
require __DIR__ . '/rotas.php';
