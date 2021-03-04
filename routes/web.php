<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VeterinarianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BargainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BinnacleController;

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

Route::get('login/reservaciones', [VeterinarianController::class, 'reservation'])->name('reservation');
Route::get('login/registro-mascotas', [VeterinarianController::class, 'pets_register'])->name('pets_register');
Route::get('login/editar-mascotas/{id}', [VeterinarianController::class, 'edit_pets'])->name('edit_pets');
Route::get('login/usuarios-clientes', [VeterinarianController::class, 'see_Customers'])->name('see_Customers');
Route::get('login/ver-usuarios-encontrados', [VeterinarianController::class, 'see_Searched_Users'])->name('see_Searched_Users');
Route::get('login/ver-usuarios-veterinarios', [VeterinarianController::class, 'see_Veterinarians'])->name('see_Veterinarians');


Route::get('login/ver-usuarios', [AdminController::class, 'see_users'])->name('see_users');
Route::get('login/ver-usuarios-borrados', [AdminController::class, 'see_Deleted_Users'])->name('see_Deleted_Users');
Route::get('login/editar-usuario/{id}', [AdminController::class, 'edit_Users'])->name('edit_Users');
Route::post('login/actualizar-usuario/{id}', [AdminController::class, 'update_Users'])->name('update_Users');
Route::get('login/delete-usuario/{id}', [AdminController::class, 'disable_User'])->name('disable_User');
Route::get('login/restaurar-usuario/{id}', [AdminController::class, 'able_User'])->name('able_User');
Route::get('login/ver-servicios', [AdminController::class, 'show_Services'])->name('show_Services');
Route::get('login/registrar_servicio', [AdminController::class, 'register_Services'])->name('register_Services');
Route::post('login/crear_servicio', [AdminController::class, 'create_Service'])->name('create_Service');
Route::get('login/editar_servicio/{id}', [AdminController::class, 'edit_service'])->name('edit_service');
Route::post('login/actualizar_servicio/{id}', [AdminController::class, 'update_Service'])->name('update_Service');
Route::get('login/borrar_servicio/{id}', [AdminController::class, 'delete_service'])->name('delete_service');
Route::get('login/mostrar-por-rol', [AdminController::class, 'search_per_rol'])->name('search_per_rol');
Route::get('mascotas/mostrar_todas', [AdminController::class, 'all_Pets'])->name('all_Pets');
Route::get('mascotas/buscar', [AdminController::class, 'see_Searched_Pets'])->name('see_Searched_Pets');


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('login/mostrar-mascotas/{id}', [HomeController::class, 'show_pets'])->name('show_pets');
Route::get('login/ver-reservaciones/{id}', [HomeController::class, 'see_reservations'])->name('see_reservations');
Route::get('login/vacunas/{id}', [HomeController::class, 'vaccines'])->name('vaccines');
Route::get('login/ver-notificaciones/{id}', [HomeController::class, 'see_notifications'])->name('see_notifications');


Route::get('/login/Crear-mascotas/{id}', [PetController::class, 'index'])->name('registrar_pets');
Route::post('/login/registrar-mascota', [PetController::class, 'create'])->name('create_pets');
Route::post('login/actualizar-mascota/{id}', [PetController::class, 'update'])->name('update_pets');
Route::get('login/borrar-mascota/{id}', [PetController::class, 'destroy'])->name('delete_pets');
Route::get('login/razas', [PetController::class, 'showBreeds'])->name('showBreeds')->middleware('admin');
Route::get('login/registrar_raza', [PetController::class, 'register_Breed'])->name('register_Breed')->middleware('admin');
Route::post('login/crear_raza', [PetController::class, 'create_Breed'])->name('create_Breed')->middleware('admin');
Route::get('login/editar_raza/{id}', [PetController::class, 'edit_breed'])->name('edit_breed')->middleware('admin');
Route::post('login/actualizar_raza/{id}', [PetController::class, 'update_breed'])->name('update_breed')->middleware('admin');
Route::get('login/eliminar_raza/{id}', [PetController::class, 'delete_breed'])->name('delete_breed')->middleware('admin');
Route::get('login/especies', [PetController::class, 'show_species'])->name('show_species')->middleware('admin');
Route::get('login/registrar_especie', [PetController::class, 'register_specie'])->name('register_specie')->middleware('admin');
Route::post('login/crear-especie', [PetController::class, 'create_specie'])->name('create_specie')->middleware('admin');
Route::get('login/editar-especie/{id}', [PetController::class, 'edit_specie'])->name('edit_specie')->middleware('admin');
Route::post('login/actualizar-especie/{id}', [PetController::class, 'update_specie'])->name('update_specie')->middleware('admin');
Route::get('login/eliminar-especie/{id}', [PetController::class, 'delete_specie'])->name('delete_specie')->middleware('admin');



Route::get('registrar_tratamiento/{id}', [TreatmentController::class, 'index'])->name('register_treatment');
Route::get('historial_clinico/{pet}', [TreatmentController::class, 'show_treatment'])->name('show_treatment');
Route::post('Crear_tratamiento', [TreatmentController::class, 'create'])->name('create_treatment');
Route::get('Editar_tratamiento/{id}', [TreatmentController::class, 'edit_treatment'])->name('edit_treatment');
Route::post('Actualizar_tratamiento/{id}', [TreatmentController::class, 'update_treatment'])->name('update_treatment');
Route::get('Borrar_tratamiento/{id}', [TreatmentController::class, 'destroy'])->name('destroy_treatment');

Route::get('mostrar_visita/{id}', [VisitController::class, 'show_visits'])->name('show_visits');
Route::get('registrar_visita/{id}', [VisitController::class, 'index'])->name('register_visit');
Route::post('crear_visita', [VisitController::class, 'create'])->name('create_visit');
Route::get('editar_visita/{id}', [VisitController::class, 'edit'])->name('edit_visit');
Route::post('actualizar_visita/{id}', [VisitController::class, 'update'])->name('update_visit');
Route::get('borrar_visita/{id}', [VisitController::class, 'destroy'])->name('delete_visit');

Route::post('reservacion_mostrar/{id}', [ReservationController::class, 'show'])->name('show_periods');
Route::get('registrar_reserva/{pet}/{period}/{date}', [ReservationController::class, 'register'])->name('register_reservation');
Route::post('crear_reservacion', [ReservationController::class, 'create'])->name('create_reservation');
Route::get('mostrar_reservaciones', [ReservationController::class, 'show_all'])->name('show_all_reservations')->middleware('veterinarian');
Route::get('desactivar_reservaciones/{id}', [ReservationController::class, 'inactive'])->name('inactive_reservation');
Route::get('reservaciones/search', [ReservationController::class, 'search_per_date'])->name('search_per_date');

Route::get('ofertas/todas-las-ofertas', [BargainController::class, 'showAll'])->name('all_bargains')->middleware('admin');
Route::get('ofertas/registrar', [BargainController::class, 'bargainForm'])->name('bargainForm')->middleware('admin');
Route::post('ofertas/crear', [BargainController::class, 'create'])->name('create_bargain')->middleware('admin');
Route::get('ofertas/editar/{id}', [BargainController::class, 'edit'])->name('edit_bargain')->middleware('admin');
Route::post('ofertas/actualizar/{id}', [BargainController::class, 'update'])->name('update_bargain')->middleware('admin');
Route::get('ofertas/borrar/{id}', [BargainController::class, 'destroy'])->name('destroy_bargain')->middleware('admin');
Route::get('ofertas', [BargainController::class, 'showAvailable'])->name('showAvailableBargains');

Route::get('notificaciones/{id}', [NotificationController::class, 'index'])->name('register_notification')->middleware('veterinarian');
Route::post('notificaciones/crear', [NotificationController::class, 'create'])->name('create_notification')->middleware('veterinarian');
Route::get('notificaciones/ver_notificaciones/{id}', [NotificationController::class, 'see_all'])->name('see_all_notification');
Route::get('notificaciones/editar/{id}', [NotificationController::class, 'edit'])->name('edit_notification')->middleware('veterinarian');
Route::post('notificaciones/actualizar/{id}', [NotificationController::class, 'update'])->name('update_notification')->middleware('veterinarian');
Route::get('notificaciones/borrar/{id}', [NotificationController::class, 'delete'])->name('delete_notification')->middleware('veterinarian');

Route::get('bitacora', [BinnacleController::class, 'index'])->name('show_binnacle');

// Route::get('storage/Images/{filename}', function ($filename)
// {
//     $path = storage_path('images/' . $filename);
    
//     if (!File::exists($path)) {
//        abort(404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;
// });