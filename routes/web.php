<?php

use App\Models\Task as ModelsTask;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    // return view('welcome');
    return view('index', [
        // 'tasks' => ModelsTask::latest()->where('completed',true)->get()
        'tasks' => ModelsTask::latest()->get()
    ]);
})->name('tasks.index');

//order of routes matter
Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{id}', function ($id)  {
    return view('show', [
        // 'task' => ModelsTask::find($id)
        'task' => ModelsTask::findOrFail($id)
    ]);
})->name("tasks.show");

Route::post("/tasks", function (Request $request) {
    dd($request->all());
})->name('tasks.store');

// blade templates: used to render dynamic content that can differ depending on the data

// Route::get("/hello", function () {
//     return "Hello";
// })->name("hello");

// Route::get("/hallo", function () {
//     return redirect()->route("hello");
// });

// Route::get("/greet/{name}", function ($name) {
//     return "Hello " . $name . "!" ;
// });

Route::fallback(function () {
    return "Still got somwehere";
});
