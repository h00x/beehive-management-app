<?php

namespace Tests\Unit;

use App\Hive;
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

    public function test_it_has_a_hive()
    {
        $hive = factory(Hive::class)->create();

        $this->assertTrue($hive->queen->hasAHive());
    }

    public function test_it_does_not_have_a_hive()
    {
        $hive = factory(Hive::class)->create();
        $queen = Queen::find($hive->queen->id);
        $hive->queen()->dissociate();
        $hive->save();

        $this->assertFalse($queen->hasAHive());
    }
}
