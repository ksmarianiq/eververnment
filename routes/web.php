<?php

use App\Http\Controllers\EvenementCtrl;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotessCtrl;
use App\Http\Controllers\OrganisateurCtrl;
use App\Http\Controllers\ProgrammeCtrl;
use App\Models\Evenement;
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
    return view('welcome');
});

Auth::routes();
// User Route
Route::middleware(['auth', 'user-role:user'])->group(function () {
    Route::get("/home", [HomeController::class, 'userHome'])->name('home');
});

// Editor Route
Route::middleware(['auth', 'user-role:editor'])->group(function () {
    Route::get("/editor/home", [HomeController::class, 'editorHome'])->name('home.editor');
});

// Admin Route
Route::middleware(['auth', 'user-role:admin'])->group(function () {
    Route::get("/admin/home", [HomeController::class, 'adminHome'])->name('home.admin');

    //ORGANISATEUR
    Route::resource('/organisateur', OrganisateurCtrl::class);
    Route::put("/update", [OrganisateurCtrl::class, 'update'])->name('update-organisation');
    Route::delete("/delete", [OrganisateurCtrl::class, 'destroy'])->name('delete-organisation');

    //EVENEMENT
    Route::resource('/Evenement', EvenementCtrl::class);
    Route::put("/updateEv", [EvenementCtrl::class, 'update'])->name('update-evenement');
    Route::delete("/deleteEv", [EvenementCtrl::class, 'destroy'])->name('delete-evenement');

    //PROGRAMME
    Route::resource('/programme', ProgrammeCtrl::class);
    Route::put("/updatePr", [ProgrammeCtrl::class, 'update'])->name('update-programme');
    Route::delete("/deletePr", [ProgrammeCtrl::class, 'destroy'])->name('delete-programme');


    //HOTESSE
    Route::resource('/Hotesse', HotessCtrl::class);
    Route::put("/updateHot", [HotessCtrl::class, 'update'])->name('update-Hotesse');
    Route::delete("/deleteHot", [HotessCtrl::class, 'destroy'])->name('delete-Hotesse');

});
