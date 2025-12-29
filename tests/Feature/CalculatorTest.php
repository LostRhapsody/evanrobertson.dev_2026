<?php

it('performs addition correctly', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 5,
        'number2' => 3,
        'operation' => 'add',
    ]);

    $response->assertSuccessful()
        ->assertJson([
            'number1' => 5,
            'number2' => 3,
            'operation' => 'add',
            'result' => 8,
        ]);
});

it('performs subtraction correctly', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 10,
        'number2' => 4,
        'operation' => 'subtract',
    ]);

    $response->assertSuccessful()
        ->assertJson([
            'number1' => 10,
            'number2' => 4,
            'operation' => 'subtract',
            'result' => 6,
        ]);
});

it('handles decimal numbers', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 5.5,
        'number2' => 2.3,
        'operation' => 'add',
    ]);

    $response->assertSuccessful()
        ->assertJson([
            'number1' => 5.5,
            'number2' => 2.3,
            'operation' => 'add',
            'result' => 7.8,
        ]);
});

it('handles negative results', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 3,
        'number2' => 10,
        'operation' => 'subtract',
    ]);

    $response->assertSuccessful()
        ->assertJson([
            'number1' => 3,
            'number2' => 10,
            'operation' => 'subtract',
            'result' => -7,
        ]);
});

it('validates required fields', function (array $data, string $expectedError) {
    $response = $this->postJson('/api/calculator', $data);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors([$expectedError]);
})->with([
    'missing number1' => [['number2' => 5, 'operation' => 'add'], 'number1'],
    'missing number2' => [['number1' => 5, 'operation' => 'add'], 'number2'],
    'missing operation' => [['number1' => 5, 'number2' => 3], 'operation'],
]);

it('validates operation must be add or subtract', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 5,
        'number2' => 3,
        'operation' => 'multiply',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['operation']);
});

it('validates numbers must be numeric', function () {
    $response = $this->postJson('/api/calculator', [
        'number1' => 'abc',
        'number2' => 3,
        'operation' => 'add',
    ]);

    $response->assertUnprocessable()
        ->assertJsonValidationErrors(['number1']);
});
