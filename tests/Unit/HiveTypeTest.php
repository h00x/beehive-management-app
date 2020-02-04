<?php

namespace Tests\Unit;

use App\HiveType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HiveTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $hive = factory(HiveType::class)->create();

        $this->assertEquals('/types/' . $hive->id, $hive->path());
    }

    public function test_it_has_an_owner()
    {
        $hive = factory(HiveType::class)->create();

        $this->assertInstanceOf('App\User', $hive->user);
    }
}
