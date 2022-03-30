<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;

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

Route::get('/todos', function(){

   $todos = \App\Models\Todo::latest()->get();

   return view('todos.index', compact('todos'));

});

Route::get('/todos/{id}', function ($id){

    $todo = \App\Models\Todo::where('id', $id)->first();

    return view('todos.show', compact('todo'));
});

Route::post('/todos/create', function (\Illuminate\Http\Request $request){

    $todo = Todo::create([
        "title" => $request->title,
        "description" => $request->description,
        "user_id" => Auth()->id()
    ]);

    return redirect("todos/$todo->id");

});

Route::post('/todos', function (){

    \App\Models\Todo::create(request(['title', 'description', 'user_id']));

    return redirect('/');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
