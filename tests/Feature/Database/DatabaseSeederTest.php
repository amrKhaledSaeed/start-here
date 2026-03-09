<?php

declare(strict_types=1);

use App\Enums\UserType;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

test('database seeder creates the required customer test user', function () {
    $this->seed(DatabaseSeeder::class);

    $user = User::query()->where('email', 'user@example.com')->first();

    expect($user)->not->toBeNull();
    expect($user?->user_type)->toBe(UserType::Customer);
    expect(Hash::check('password', $user?->password ?? ''))->toBeTrue();
});
