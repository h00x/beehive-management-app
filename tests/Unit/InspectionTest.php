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
        $user = $this->signIn();

        $inspection = factory(Inspection::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals('/inspections/' . $inspection->id, $inspection->path());
    }

    public function test_it_has_an_owner()
    {
        $user = $this->signIn();

        $inspection = factory(Inspection::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf('App\User', $inspection->user);
    }

    public function test_inspection_has_a_hive()
    {
        $user = $this->signIn();

        $inspection = factory(Inspection::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf('App\Hive', $inspection->hive);
    }
}
