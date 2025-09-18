<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

// 2.1 4 Verb
Route::get('/test-submit', function () {
    return view('test-submit');
});

Route::put('/update', function () {
    return 'Profile UPDATED';
});
Route::delete('/remove', function () {
    return 'Profile REMOVED';
});

Route::post('/submit', function () {
    return 'Post';
});

// 2.2 Route Group
// admin page -> view student page, view lecture page, view employ page

Route::prefix('admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.student');
    });

    Route::get('/admin', function () {
        return view('admin.employee');
    });

    Route::get('/admin', function () {
        return view('admin.lecture');
    });
});


// 2.3 Route Match
Route::match(['get', 'post', 'delete'], '/feedback', function (Request $request) {
    if ($request->isMethod('post')) {
        return 'Feedback submitted via POST';
    } elseif ($request->isMethod('get')) {
        return 'Feedback submitted via GET';
    } elseif ($request->isMethod('delete')) {
        return 'Feedback deleted';
    }
});


// 2.4 Submit data from views to routes
Route::get('/contact', function () {
    return view('contact');
});

Route::post('/submit-contact', function (Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');

    return "Name: $name, Email: $email";
});

// 2.5 From routes data to the view

Route::get("/users", function () {
    return view("users", ["name" => "Andrew", "age" => 19]);
});

// 2.6 Route Parameters { so we will get the data from the url directly }
// profile 1
Route::get("/profile/{username}", function ($username) {
    return view("profile", ["name" => $username]);
});

// 2.7 Route Fallback
Route::fallback(function () {
    return response()->view(('fallback'), [], 404);
});