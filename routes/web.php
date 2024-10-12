<?php

use App\Http\Requests\TaskRequest;
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
        'tasks' => ModelsTask::latest()->paginate(10)
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

Route::post("/tasks", function (TaskRequest $request) {
    // $data = $request->validated();
    // $task = new ModelsTask;
    // $task->title = $data["title"];
    // $task->description = $data["description"];
    // $task->long_description = $data["long_description"];
    // $task->save();
    $task = ModelsTask::create($request->validated());
    return redirect()->route("tasks.show", ["task"=> $task->id])->with("success","Task created successfully!");
})->name('tasks.store');

Route::put("/tasks/{task}", function (ModelsTask $task, TaskRequest $request) {
    // $data = $request->validated();
    // $task->title = $data["title"];
    // $task->description = $data["description"];
    // $task->long_description = $data["long_description"];
    // $task->save();
    $task->update($request->validated());
    return redirect()->route("tasks.show", ["task"=> $task->id])->with("success","Task updated successfully!");
})->name('tasks.update');

Route::delete('/task/{task}', function (ModelsTask $task) {
    $task->delete();

    return redirect()->route('tasks.index')->with('success','Task deleted successfully!');
})->name('tasks.destroy');


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
