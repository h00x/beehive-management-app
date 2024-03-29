<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_hives()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->hives);
    }
}
