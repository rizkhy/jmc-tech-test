<?php

use App\Livewire\Dashboard\DashboardPage;
use App\Livewire\Pages\City\CityPage;
use App\Livewire\Pages\Province\ProvincePage;
use App\Livewire\Pages\Resident\ResidentPage;
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

/*
| Dashboard
*/

Route::get('/', DashboardPage::class)->name('dashboard');

/*
| Pages
*/
Route::prefix('pages')->name('pages.')->group(function () {
    /*
    | Province
    */
    Route::get('/province', ProvincePage::class)->name('province');

    /*
    | City
    */
    Route::get('/city', CityPage::class)->name('city');

    /*
    | Resident
    */
    Route::get('/resident', ResidentPage::class)->name('resident');
});
