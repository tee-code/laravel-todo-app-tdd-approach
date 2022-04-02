<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use App\Http\Controllers\TodoController;

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

Route::get('/', function(){
    return view('welcome');
});

Route::get('/todos', [TodoController::class, 'index']);

Route::get('/todos/create', [TodoController::class, 'create']);

Route::get('/todos/{todo}/edit', [TodoController::class, 'edit']);

Route::get('/todos/{id}', [TodoController::class, 'show'])->name('todos.show');

Route::post('/todos/create', [TodoController::class, 'store']);

Route::post('/todos', [TodoController::class, 'insert']);

Route::put('/todos/{todo}', [TodoController::class, 'update']);

Route::delete("/todos/{todo}", [TodoController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
