<?php

use Illuminate\Support\Facades\Route;

Route::get('/server-time', function () {
    return response()->json([
        'time' => now()->toISOString(),
        'formatted' => now()->format('F j, Y g:i:s A T'),
        'timezone' => config('app.timezone'),
    ]);
});
