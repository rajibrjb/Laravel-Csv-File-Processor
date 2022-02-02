<?php

use App\Http\Controllers\CsvUploaderController;
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
Route::get('/',[CsvUploaderController::class, 'show'])->name('csv.show');
Route::get('/csv-uploader',[CsvUploaderController::class, 'show'])->name('csv.show');

Route::post('/csv-uploader', [CsvUploaderController::class, 'store'])->name('csv.store');
