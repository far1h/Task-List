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

Route::get('/tasks/{task}/edit', function (ModelsTask $task)  {
    return view('edit', [
        // 'task' => ModelsTask::find($id)
        'task' => $task
    ]);
})->name("tasks.edit");

Route::get('/tasks/{task}', function (ModelsTask $task)  {
    return view('show', [
        // 'task' => ModelsTask::find($id)
        'task' => $task
    ]);
})->name("tasks.show");

Route::put("/tasks/{task}", function (ModelsTask $task, Request $request) {
    $data = $request->validate([
        "title"=> "required|max:255",
        "description"=> "required",
        "long_description"=> "required",
    ]);

    $task->title = $data["title"];
    $task->description = $data["description"];
    $task->long_description = $data["long_description"];
    $task->save();

    return redirect()->route("tasks.show", ["id"=> $task->id])->with("success","Task updated successfully!");
})->name('tasks.update');

Route::post("/tasks", function (Request $request) {
    $data = $request->validate([
        "title"=> "required|max:255",
        "description"=> "required",
        "long_description"=> "required",
    ]);

    $task = new ModelsTask;
    $task->title = $data["title"];
    $task->description = $data["description"];
    $task->long_description = $data["long_description"];
    $task->save();

    return redirect()->route("tasks.show", ["id"=> $task->id])->with("success","Task created successfully!");
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
