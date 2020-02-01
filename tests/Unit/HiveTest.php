<?php

namespace Tests\Unit;

use App\Hive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $hive = factory(Hive::class)->create();

        $this->assertEquals('/hives/' . $hive->id, $hive->path());
    }

    public function test_it_has_an_owner()
    {
        $hive = factory(Hive::class)->create();

        $this->assertInstanceOf('App\User', $hive->user);
    }
}
