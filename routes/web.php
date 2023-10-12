<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('guest.welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {//Tutte devono iniziare con admin ok
    //CREATE // Il create aveva bisogno dello /admin perchè veniva sovrascritto da slug
    Route::get("/admin/projects/create", [ProjectController::class, "create"])->name("admin.projects.create");//Indirizza ad una pagina con form per inserire i dati del progetto;
    Route::post("/admin/projects", [ProjectController::class, "store"])->name("admin.projects.store");//Rotta di dove verranno inviati i dati. Essa è in POST.
    
     // //READ 
    Route::get('/admin/projects', [ProjectController::class, "index"])->name("admin.projects.index"); //Anteprima dei progetti
    Route::get("/admin/projects/trash", [ProjectController::class, "trash"])->name("admin.projects.trash");//Trashbin
    Route::get('/admin/projects/{slug}', [ProjectController::class, "show"])->name("admin.projects.show"); //Dettagli di un Elemento

    //UPDATE
    Route::get('/admin/projects/{slug}/edit', [ProjectController::class, "edit"])->name('admin.projects.edit');
    Route::match(['patch', 'put'], '/admin/projects/{slug}/update', [ProjectController::class, "update"])->name('admin.projects.update');

     // //DESTROY - il metodo è DELETE e anche sul controller è $Projects->delete();
    Route::delete('/admin/projects/{slug}', [ProjectController::class, "destroy"])->name("admin.projects.destroy");
});







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
