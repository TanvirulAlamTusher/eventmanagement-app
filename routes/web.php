<?php

use App\Http\Controllers\AllEventController;
use App\Http\Controllers\EventCategotyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\EventCategoty;
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
    return view('pages.public-event-page');
});

Route::get('/dashboard', function () {
   // return view('dashboard');
   // return view('pages.dashboard-page');
   return view('pages.public-event-page');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
   //event route
   Route::post('/create-event',[EventController::class,'CreateEvent'])->name('event.create');
   Route::get('/get-event',[EventController::class,'GetEvent'])->name('event.get');
   Route::post('/get-event-by-id',[EventController::class,'EventById']);
   Route::post('/update-event',[EventController::class,'UpdateEvent'])->name('event.update');
   Route::post('/delete-event',[EventController::class,'DeleteEvent'])->name('event.delete');
   
   //event category
   Route::post('/create-catagory', [EventCategotyController::class, 'CreateCategory']);
   Route::get('/catagory-list', [EventCategotyController::class, 'CategoryList']);
   Route::post('/catagory-delete', [EventCategotyController::class, 'DeleteCategory']);
   Route::post('/catagory-update', [EventCategotyController::class, 'UpdateCategory']);
    Route::post('/category-by-id', [EventCategotyController::class, 'CategotyById']);

 
});
Route::middleware('auth')->group(function () {
    //event page route
    Route::get('/event-page',[EventController::class,'EventPage']);
    //category page
   Route::get('/category-page',[EventCategotyController::class,'CategoryPage']);
   
 });
require __DIR__.'/auth.php';

Route::get('/logout',[UserController::class,'destroy'])->name('logout');
//public route
Route::get('/get-allevent',[AllEventController::class,'AllEvents']);
Route::post('/add-attendance',[EventController::class,'incrementAttendance']);
