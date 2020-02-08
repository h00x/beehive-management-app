<?php

namespace Tests\Unit;

use App\Harvest;
use App\Hive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HarvestTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $harvest = factory(Harvest::class)->create();

        $this->assertEquals('/harvests/' . $harvest->id, $harvest->path());
    }

    public function test_it_has_an_owner()
    {
        $harvest = factory(Harvest::class)->create();

        $this->assertInstanceOf('App\User', $harvest->user);
    }

    public function test_harvest_has_a_hive()
    {
        $harvest = factory(Harvest::class)->create();
        $hive = factory(Hive::class)->create();

        $harvest->hives()->attach($hive);

        $this->assertTrue($harvest->hasHive($hive));
    }
}
