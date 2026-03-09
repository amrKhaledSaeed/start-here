<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

test('products index route is publicly accessible', function () {
    $this->get(route('products.index'))
        ->assertOk()
        ->assertSee('Products');
});

test('products show route is publicly accessible', function () {
    $this->get(route('products.show', ['slug' => 'demo-product']))
        ->assertOk()
        ->assertSee('demo-product');
});

test('cart route is publicly accessible', function () {
    $this->get(route('cart.index'))
        ->assertOk()
        ->assertSee('Cart');
});

test('checkout route requires authentication', function () {
    $this->get(route('checkout.index'))
        ->assertRedirect(route('login'));
});

test('authenticated user can access checkout routes', function () {
    $user = User::factory()->make();

    $this->actingAs($user)
        ->get(route('checkout.index'))
        ->assertOk()
        ->assertSee('Checkout');

    $this->actingAs($user)
        ->get(route('checkout.confirmation'))
        ->assertOk()
        ->assertSee('Checkout Confirmation');
});
