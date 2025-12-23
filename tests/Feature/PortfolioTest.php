<?php

it('displays the portfolio page', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('Portfolio')
    );
});

it('loads the portfolio component successfully', function () {
    $response = $this->get('/');

    $response->assertInertia(fn ($page) => $page
        ->component('Portfolio')
    );
});

it('serves the home route correctly', function () {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page
        ->component('Portfolio')
    );
});
