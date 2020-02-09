<?php

namespace Tests\Feature;

use App\Hive;
use App\Inspection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageInspectionTest extends TestCase
{
    public function test_a_user_can_create_a_harvest()
    {
        $user = $this->signIn();

        $this->get('/inspections/create')->assertStatus(200);

        $hive = factory(Hive::class)->create();

        $inspection = factory(Inspection::class)->raw([
            'hive_id' => [$hive->id]
        ]);

        $this->post('/inspections', $inspection);
        $this->assertDatabaseHas('inspections', [
            'date' => $inspection['date'],
            'queen_seen' => $inspection['queen_seen'],
            'larval_seen' => $inspection['larval_seen'],
            'young_larval_seen' => $inspection['young_larval_seen'],
            'pollen_arriving' => $inspection['pollen_arriving'],
            'comb_building' => $inspection['comb_building'],
            'notes' => $inspection['notes'],
            'weather' => $inspection['weather'],
            'temperature' => $inspection['temprature'],
            'hive_id' => $hive->id,
            'user_id' => $user->id,
        ]);
    }
}
