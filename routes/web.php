<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('login/reservaciones', [VeterinarianController::class,'reservation'])->name('reservation');
Route::get('login/registro-mascotas', [VeterinarianController::class,'pets_register'])->name('pets_register');

Route::get('login/ver-usuarios', [AdminController::class,'see_users'])->name('see_users');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login/pets', [HomeController::class, 'see_pets'])->name('see_pets');
Route::get('/login/reservaciones-por-usuario', [HomeController::class, 'reservation_users'])->name('reservation_users');

