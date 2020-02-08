<?php

namespace Tests\Unit;

use App\Queen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QueenTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $queen = factory(Queen::class)->create();

        $this->assertEquals('/queens/' . $queen->id, $queen->path());
    }

    public function test_it_has_an_owner()
    {
        $queen = factory(Queen::class)->create();

        $this->assertInstanceOf('App\User', $queen->user);
    }
}
