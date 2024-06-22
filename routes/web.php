<?php
use App\Livewire\CreatePlant;
use App\Livewire\UpdatePlant;
use App\Livewire\DeletePlant;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TalukController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\GenusController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SpecificController;
use App\Http\Controllers\CollectorController;
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

Route::view('/', 'welcome');


Route::get('plants', [PlantController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('plants');
Route::get('/plants/create', CreatePlant::class)->name('plants.create');
Route::get('/plants/update/{herbarium}', UpdatePlant::class)->name('plants.update');


Route::get('/families', [FamilyController::class, 'index'])->name('families');
Route::get('/genus', [GenusController::class, 'index'])->name('genus');
Route::get('/places', [PlaceController::class, 'index'])->name('places');
Route::get('/taluks', [TalukController::class, 'index'])->name('taluks');
Route::get('/districts', [DistrictController::class, 'index'])->name('districts');
Route::get('/states', [StateController::class, 'index'])->name('states');
Route::get('/specifics', [SpecificController::class, 'index'])->name('specifics');
Route::get('/statuses', [StatusController::class, 'index'])->name('statuses');
Route::get('/collectors', [CollectorController::class, 'index'])->name('collectors');

Route::get('/herbarium-label/{id}', [GenusController::class, 'generateLabel'])->name('herbarium-label');

Route::get('users', [UserController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('users');


Route::prefix('ajax')->group(function () {
    Route::get('/genus', [GenusController::class, 'getListForSelect'])->name('ajax.genus');
    Route::get('/families', [FamilyController::class, 'getListForSelect'])->name('ajax.families');
    Route::get('/places', [PlaceController::class, 'getListForSelect'])->name('ajax.places');
    Route::get('/taluks', [TalukController::class, 'getListForSelect'])->name('ajax.taluks');
    Route::get('/districts', [DistrictController::class, 'getListForSelect'])->name('ajax.districts');
    Route::get('/states', [StateController::class, 'getListForSelect'])->name('ajax.states');
    Route::get('/specifics', [SpecificController::class, 'getListForSelect'])->name('ajax.specifics');
    Route::get('/statuses', [StatusController::class, 'getListForSelect'])->name('ajax.statuses');
    Route::get('/collectors', [CollectorController::class, 'getListForSelect'])->name('ajax.collectors');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
