<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingPageController;

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

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/authLogin', [LoginController::class,'authLogin'])->name('authLogin');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});

Route::get('/', [LandingPageController::class,'index'])->name('landingPage');
Route::get('detailrecipe/{id}', [LandingPageController::class,'detailrecipe'])->name('detailrecipe');

Route::middleware(['auth', 'checkLevel:admin,user'])->group(function () {

Route::get('/dashboard',[HomeController::class,'index'])->name('dash');

Route::prefix('user')->group(function(){
    Route::get('/', [UserController::class,'index'])->name('user');
    Route::get('/getData', [UserController::class,'getData'])->name('user.getData');
    Route::post('/createData', [UserController::class,'createData'])->name('user.createData');
    Route::post('/updateData/{id}', [UserController::class,'updateData'])->name('user.updateData');
    Route::post('/deleteData/{id}', [UserController::class,'deleteData'])->name('user.deleteData');
});

Route::prefix('category')->group(function(){
    Route::get('/', [CategoryController::class,'index'])->name('category');
    Route::get('/getData', [CategoryController::class,'getData'])->name('category.getData');
    Route::post('/createData', [CategoryController::class,'createData'])->name('category.createData');
    Route::post('/updateData/{id}', [CategoryController::class,'updateData'])->name('category.updateData');
    Route::post('/deleteData/{id}', [CategoryController::class,'deleteData'])->name('category.deleteData');
});

Route::prefix('recipe')->group(function(){
    Route::get('/', [RecipeController::class,'index'])->name('recipe');
    Route::get('/getData', [RecipeController::class,'getData'])->name('recipe.getData');
    Route::post('/createData', [RecipeController::class,'createData'])->name('recipe.createData');
    Route::post('/updateData/{id}', [RecipeController::class,'updateData'])->name('recipe.updateData');
    Route::post('/deleteData/{id}', [RecipeController::class,'deleteData'])->name('recipe.deleteData');
    Route::get('/getDataTrash', [RecipeController::class,'getDataTrash']);
    Route::get('/trash', [RecipeController::class,'trash']);
    Route::post('/restoreData/{id}', [RecipeController::class,'restoreData']);
    Route::post('/deleteTrash/{id}', [RecipeController::class,'deleteTrash']);
});

});



// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
