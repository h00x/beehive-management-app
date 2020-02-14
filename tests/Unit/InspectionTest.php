<?php

namespace Tests\Unit;

use App\Hive;
use App\Inspection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InspectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $harvest = factory(Inspection::class)->create();

        $this->assertEquals('/inspections/' . $harvest->id, $harvest->path());
    }

    public function test_it_has_an_owner()
    {
        $harvest = factory(Inspection::class)->create();

        $this->assertInstanceOf('App\User', $harvest->user);
    }

    public function test_inspection_has_a_hive()
    {
        $inspection = factory(Inspection::class)->create();

        $this->assertInstanceOf('App\Hive', $inspection->hive);
    }
}
