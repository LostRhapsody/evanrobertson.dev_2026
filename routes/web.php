<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Portfolio');
})->name('home');

Route::get('/blog', function () {
    return Inertia::render('Blog');
})->name('blog');

Route::get('/blog/{slug}', function ($slug) {
    return Inertia::render("blog/{$slug}");
})->name('blog.post');
