<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoleController;
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
Route::get('/recomendaciones', function () {
    return view('recomendaciones');
})->name('recomendaciones');
Route::get('/contactanos', function () {
    return view('contactanos');
})->name('contactanos');


Route::get('/registro_usuarios', function () {
    return view('registro_usuarios');
})->name('registro.usuarios');
Route::get('/reservaciones', function () {
    return view('reservaciones');
})->name('reservaciones')->middleware('admin');

Auth::routes();

Route::post('login/custom', [RoleController::class,'login'])->name('login.custom');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

