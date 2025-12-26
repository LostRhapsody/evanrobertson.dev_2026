<?php

it('returns server time data', function () {
    $response = $this->getJson('/api/server-time');

    $response->assertSuccessful()
        ->assertJsonStructure([
            'time',
            'formatted',
            'timezone',
        ])
        ->assertJson([
            'timezone' => config('app.timezone'),
        ]);

    // Verify the time format is ISO 8601
    $data = $response->json();
    expect($data['time'])->toMatch('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.\d{6}Z$/');
    expect($data['formatted'])->toBeString();
    expect($data['timezone'])->toBe(config('app.timezone'));
});
