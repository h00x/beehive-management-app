<?php

namespace Tests\Feature;

use App\Hive;
use App\Inspection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageInspectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_inspections_overview()
    {
        $response = $this->get('/inspections');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_to_create_an_inspection()
    {
        $inspection = factory(Inspection::class)->raw();

        $this->post('/inspections', $inspection)->assertRedirect('/login');

        $this->assertDatabaseMissing('inspections', $inspection);
    }

    public function test_a_user_can_create_an_inspection()
    {
        $user = $this->signIn();

        $this->get('/inspections/create')->assertStatus(200);

        $inspection = factory(Inspection::class)->raw();

        $this->post('/inspections', $inspection);
        $this->assertDatabaseHas('inspections', [
            'date' => $inspection['date'],
            'queen_seen' => $inspection['queen_seen'],
            'larval_seen' => $inspection['larval_seen'],
            'young_larval_seen' => $inspection['young_larval_seen'],
            'pollen_arriving' => $inspection['pollen_arriving'],
            'comb_building' => $inspection['comb_building'],
            'notes' => $inspection['notes'],
            'hive_id' => $inspection['hive_id'],
            'user_id' => $user->id,
        ]);
    }

    public function test_a_user_can_only_view_their_own_inspections_on_the_inspections_overview_page()
    {
        $inspection1 = factory(Inspection::class)->create();
        $inspection2 = factory(Inspection::class)->create([
            'user_id' => $inspection1->user->id,
        ]);
        $inspection3 = factory(Inspection::class)->create([
            'user_id' => $inspection1->user->id,
        ]);
        $inspection4 = factory(Inspection::class)->create();

        $this->signIn($inspection1->user);

        $this->get('/inspections')
            ->assertStatus(200)
            ->assertSee($inspection1->hive->name)
            ->assertSee($inspection2->hive->name)
            ->assertSee($inspection3->hive->name)
            ->assertDontSee($inspection4->hive->name);
    }

    public function test_a_user_can_update_an_inspection()
    {
        $inspection = factory(Inspection::class)->create();

        $this->actingAs($inspection->user)
            ->patch($inspection->path(), $attributes = [
                'date' => $inspection->date,
                'queen_seen' => $inspection->queen_seen,
                'larval_seen' => $inspection->larval_seen,
                'young_larval_seen' => $inspection->young_larval_seen,
                'pollen_arriving' => '39',
                'comb_building' => '30',
                'notes' => 'Changed',
                'hive_id' => $inspection->hive->id,
            ])
            ->assertRedirect($inspection->path());

        $this->get($inspection->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('inspections', $attributes);
    }

    public function test_a_user_cannot_update_an_inspection_of_others()
    {
        $this->signIn();

        $inspection = factory(Inspection::class)->create();

        $this->patch($inspection->path(), [
            'date' => $inspection->date,
            'queen_seen' => $inspection->queen_seen,
            'larval_seen' => $inspection->larval_seen,
            'young_larval_seen' => $inspection->young_larval_seen,
            'pollen_arriving' => '39',
            'comb_building' => '30',
            'notes' => 'Changed',
            'weather' => 'Changed',
            'hive_id' => $inspection->hive->id,
            'temperature' => 34,
        ])->assertStatus(403);
    }

    public function test_an_inspection_returns_an_error_when_fields_are_missing()
    {
        $this->signIn();

        $inspection = factory(Inspection::class)->raw([
            'date' => '',
            'queen_seen' => '',
            'larval_seen' => '',
            'young_larval_seen' => '',
            'pollen_arriving' => '',
            'comb_building' => '',
            'hive_id' => '',
        ]);

        $this->post('/inspections', $inspection)->assertSessionHasErrors([
            'date',
            'queen_seen',
            'larval_seen',
            'young_larval_seen',
            'pollen_arriving',
            'comb_building',
            'hive_id',
        ]);
    }

    public function test_a_user_can_delete_an_inspection()
    {
        $inspection = factory(Inspection::class)->create();

        $this->assertDatabaseHas('inspections', [
            'id' => $inspection->id,
        ]);

        $this->actingAs($inspection->user)
            ->delete($inspection->path())
            ->assertRedirect('/inspections');

        $this->assertDatabaseMissing('inspections', [
            'id' => $inspection->id,
        ]);
    }

    public function test_a_user_cannot_delete_an_inspection_of_others()
    {
        $this->signIn();

        $inspection = factory(Inspection::class)->create();

        $this->delete($inspection->path())
            ->assertStatus(403);
    }
}
