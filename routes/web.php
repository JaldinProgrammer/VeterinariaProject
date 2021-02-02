<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VisitController;

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
Route::get('login/editar-mascotas/{id}', [VeterinarianController::class,'edit_pets'])->name('edit_pets');
Route::get('login/ver-usuarios-clientes', [VeterinarianController::class,'see_Customers'])->name('see_Customers');
Route::get('login/ver-usuarios-encontrados', [VeterinarianController::class,'see_Searched_Users'])->name('see_Searched_Users');


Route::get('login/ver-usuarios', [AdminController::class,'see_users'])->name('see_users');
Route::get('login/ver-usuarios-borrados', [AdminController::class,'see_Deleted_Users'])->name('see_Deleted_Users');

Route::get('login/editar-usuario/{id}', [AdminController::class,'edit_Users'])->name('edit_Users');
Route::post('login/actualizar-usuario/{id}', [AdminController::class,'update_Users'])->name('update_Users');
Route::get('login/delete-usuario/{id}', [AdminController::class,'disable_User'])->name('disable_User');
Route::get('login/restaurar-usuario/{id}', [AdminController::class,'able_User'])->name('able_User');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/login/pets', [HomeController::class, 'see_pets'])->name('see_pets');
Route::get('/login/reservaciones-por-usuario', [HomeController::class, 'reservation_users'])->name('reservation_users');
Route::get('login/mostrar-mascotas/{id}', [HomeController::class,'show_pets'])->name('show_pets');

Route::get('/login/Crear-mascotas/{id}', [PetController::class, 'index'])->name('registrar_pets');
Route::post('/login/registrar-mascota', [PetController::class, 'create'])->name('create_pets');
Route::post('login/actualizar-mascota/{id}', [PetController::class,'update'])->name('update_pets');
Route::get('login/borrar-mascota/{id}', [PetController::class,'destroy'])->name('delete_pets');


Route::get('registrar_tratamiento/{id}', [TreatmentController::class,'index'])->name('register_treatment');
Route::get('historial_clinico/{pet}', [TreatmentController::class,'show_treatment'])->name('show_treatment');
Route::post('Crear_tratamiento', [TreatmentController::class,'create'])->name('create_treatment');
Route::get('Editar_tratamiento/{id}', [TreatmentController::class,'edit_treatment'])->name('edit_treatment');
Route::post('Actualizar_tratamiento/{id}', [TreatmentController::class,'update_treatment'])->name('update_treatment');
Route::get('Borrar_tratamiento/{id}', [TreatmentController::class,'destroy'])->name('destroy_treatment');

Route::get('mostrar_visita/{id}', [VisitController::class,'show_visits'])->name('show_visits');
Route::get('registrar_visita/{id}', [VisitController::class,'index'])->name('register_visit');
Route::post('crear_visita', [VisitController::class,'create'])->name('create_visit');
Route::get('editar_visita/{id}', [VisitController::class,'edit'])->name('edit_visit');
Route::post('actualizar_visita/{id}', [VisitController::class,'update'])->name('update_visit');
Route::get('borrar_visita/{id}', [VisitController::class,'destroy'])->name('delete_visit');






