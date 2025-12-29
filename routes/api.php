<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/server-time', function () {
    return response()->json([
        'time' => now()->toISOString(),
        'formatted' => now()->format('F j, Y g:i:s A T'),
        'timezone' => config('app.timezone'),
    ]);
});

Route::post('/calculator', function (Request $request) {
    $validated = $request->validate([
        'number1' => ['required', 'numeric'],
        'number2' => ['required', 'numeric'],
        'operation' => ['required', 'string', 'in:add,subtract'],
    ]);

    $number1 = (float) $validated['number1'];
    $number2 = (float) $validated['number2'];
    $operation = $validated['operation'];

    $result = match ($operation) {
        'add' => $number1 + $number2,
        'subtract' => $number1 - $number2,
    };

    return response()->json([
        'number1' => $number1,
        'number2' => $number2,
        'operation' => $operation,
        'result' => $result,
    ]);
});
