<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EtudiantCtrl;
use App\Http\Controllers\SuperCtrl;
use App\Http\Controllers\UserCtrl;

use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();

// User Route
    Route::middleware(['auth', 'user-role:user'])->group(function () {
    Route::get("/home", [HomeController::class, 'userHome'])->name('home');
    Route::resource('/etudiant', EtudiantCtrl::class);

    //ETUDIANT
    Route::put("/update_Etudiant", [EtudiantCtrl::class, 'update'])->name('update-etudiant');
    Route::delete("/delete_Eudiant", [EtudiantCtrl::class, 'destroy'])->name('delete-etudiant');
});

// Editor Route
Route::middleware(['auth', 'user-role:editor'])->group(function () {
    Route::get("/editor/home", [HomeController::class, 'editorHome'])->name('home.editor');


    //ECOLE
    Route::resource('/ecole', SuperCtrl::class);
    Route::put("/updateEcole", [SuperCtrl::class, 'update'])->name('update-ecole');
    Route::delete("/deleteEcole", [SuperCtrl::class, 'destroy'])->name('delete-ecole');
});

// Admin Route
    Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get("/admin/home", [HomeController::class, 'adminHome'])->name('home.admin');

//USER
      Route::resource('/user', UserCtrl::class);
      Route::put("/update_user", [UserCtrl::class, 'update'])->name('update-user');
      Route::delete("/delete_user", [UserCtrl::class, 'destroy'])->name('delete-user');

});

