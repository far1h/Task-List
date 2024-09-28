<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('index', [
        'name'=> 'mo'
    ]);
});

// blade templates: used to render dynamic content that can differ depending on the data

Route::get("/hello", function () {
    return "Hello";
})->name("hello");

Route::get("/hallo", function () {
    return redirect()->route("hello");
});

Route::get("/greet/{name}", function ($name) {
    return "Hello " . $name . "!" ;
});

Route::fallback(function () {
    return "Still got somwehere";
});