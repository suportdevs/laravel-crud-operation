<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');

// Category Routes
Route::get('/all/category', [CategoryController::class, 'index'])->name('all.category');
Route::get('/add/category', [CategoryController::class, 'add'])->name('add.category');
Route::post('/store/category', [CategoryController::class, 'store'])->name('store.category');
Route::get('/edit/category/{id}/{slug}', [CategoryController::class, 'edit']);
Route::post('/update/category/{id}/{slug}', [CategoryController::class, 'update']);
Route::get('/delete/category/{id}/{slug}', [CategoryController::class, 'softDelete']);
Route::get('/category/trash/list/', [CategoryController::class, 'trashList']);
Route::get('/restore/category/{id}/{slug}', [CategoryController::class, 'restore']);
Route::get('/force/delete/category/{id}/{slug}', [CategoryController::class, 'forceDelete']);

// Brand Routes
Route::get('/all/brands', [BrandController::class, 'index'])->name('all.brands');
Route::get('/add/brand', [BrandController::class, 'add'])->name('add.brand');
Route::post('/store/brand', [BrandController::class, 'store'])->name('store.brand');
Route::get('/edit/brand/{id}', [BrandController::class, 'edit']);
Route::post('/update/brand/{id}', [BrandController::class, 'update']);
Route::get('/delete/brand/{id}', [BrandController::class, 'delete']);
Route::get('/brand/trash/list/', [BrandController::class, 'trashList']);
Route::get('/force/delete/brand/{id}', [BrandController::class, 'forceDelete']);

// Gallery and Mulitple Image
Route::get('/gallery/view/', [GalleryController::class, 'index']);
Route::post('/gallery/insert', [GalleryController::class, 'insert'])->name('gallery.insert');