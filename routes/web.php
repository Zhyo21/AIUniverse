<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WebsiteController;
use App\Models\Category;
use App\Models\Website;
use Illuminate\Support\Facades\DB;
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


// init route
Route::get('/', function () {
    return redirect("/website");
});




// for admin routes
Route::middleware('admin')->group(function () {

    Route::get('/dashboard', function () {
        $categories = new Category();
        $websitesWithCategories = Website::with('categories')->get();
         

        return view('dashboard', ["categories" => $categories::all(), "websites" =>  $websitesWithCategories]);
    })->name('dashboard');

    // websites create,update and delete routes
    Route::post("/website", [WebsiteController::class, 'store'])->name('websites');
    Route::get("/website/create", [WebsiteController::class, 'create'])->name('websites');
    Route::get("/website/edit/{id}", [WebsiteController::class, 'edit'])->name("websites");
    Route::put("/website/{id}", [WebsiteController::class, 'update'])->name('websites');
    Route::delete("/website/{id}", [WebsiteController::class, 'destroy'])->name('websites');

    // category create,update and delete routes
    Route::get("/category/create", [CategoryController::class, 'create'])->name('categories');
    Route::post("/category", [CategoryController::class, 'store'])->name('categories');
    Route::get("/category/edit/{id}", [CategoryController::class, 'edit'])->name("websites");
    Route::put("/category/{id}", [CategoryController::class, 'update'])->name('websites');
    Route::delete("/category/{id}", [CategoryController::class, 'destroy'])->name('websites');
});


//for user routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get("/favourite", [FavouriteController::class, 'index'])->name('favourites');
    Route::post("/favourite", [FavouriteController::class, 'store'])->name('favourites');
    Route::delete("/favourite", [FavouriteController::class, 'destroy'])->name('favourites');


    Route::post("/rate", [RatingController::class, 'store']);
});



//guest routes
Route::get("/website", [WebsiteController::class, 'index'])->name('websites');
Route::get("/categories", [CategoryController::class, 'index'])->name('categories');
Route::get("/website/filter", [WebsiteController::class, 'filter'])->name('websites');
Route::get("/website/{id}", [WebsiteController::class, 'show'])->name('websites');
Route::get("/aboutUs", function(){
    return view("Aboutus");
})->name('aboutus');

require __DIR__ . '/auth.php';
