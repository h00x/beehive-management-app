<?php

namespace Tests\Feature;

use App\Harvest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageHarvestTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_guests_cannot_view_harvests_overview()
    {
        $response = $this->get('/harvests');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_to_create_a_harvest()
    {
        $harvest = factory(Harvest::class)->raw();

        $this->post('/harvests', $harvest)->assertRedirect('/login');

        $this->assertDatabaseMissing('harvests', $harvest);
    }

    public function test_a_user_can_create_a_harvest()
    {
        $user = $this->signIn();

        $this->get('/harvests/create')->assertStatus(200);

        $hive = factory(\App\Hive::class)->create();

        $harvest = factory(Harvest::class)->raw([
            'hive_id' => [$hive->id]
        ]);

        $this->post('/harvests', $harvest);
        $this->assertDatabaseHas('harvests', [
            'name' => $harvest['name'],
            'date' => $harvest['date'],
            'batch_code' => $harvest['batch_code'],
            'weight' => $harvest['weight'],
            'moister_content' => $harvest['moister_content'],
            'nectar_source' => $harvest['nectar_source'],
            'description' => $harvest['description'],
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('harvest_hive', [
            'harvest_id' => Harvest::first()->id,
            'hive_id' => $hive->id
        ]);
    }

    public function test_a_user_can_only_view_their_own_harvests_on_the_harvests_overview_page()
    {
        $harvest1 = factory(Harvest::class)->create();
        $harvest2 = factory(Harvest::class)->create([
            'user_id' => $harvest1->user->id,
        ]);
        $harvest3 = factory(Harvest::class)->create([
            'user_id' => $harvest1->user->id,
        ]);
        $harvest4 = factory(Harvest::class)->create();

        $this->signIn($harvest1->user);

        $this->get('/harvests')
            ->assertStatus(200)
            ->assertSee($harvest1->name)
            ->assertSee($harvest2->name)
            ->assertSee($harvest3->name)
            ->assertDontSee($harvest4->name);
    }

    public function test_a_user_can_update_a_harvest()
    {
        $harvest = factory(Harvest::class)->create();

        $this->actingAs($harvest->user)
            ->patch($harvest->path(), $attributes = [
                'name' => 'Changed',
                'date' => '2001-03-14',
                'batch_code' => 'Changed',
                'weight' => 3445,
                'moister_content' => 13,
                'nectar_source' => 'Changed',
                'description' => 'Changed'
            ])
            ->assertRedirect($harvest->path());

        $this->get($harvest->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('harvests', $attributes);
    }

    public function test_a_user_cannot_update_a_harvest_of_others()
    {
        $this->signIn();

        $harvest = factory(Harvest::class)->create();

        $this->patch($harvest->path(), [
            'name' => 'Changed',
            'date' => '2001-03-14',
            'batch_code' => 'Changed',
            'weight' => 3445,
            'moister_content' => 13,
            'nectar_source' => 'Changed',
            'description' => 'Changed'
        ])->assertStatus(403);
    }

    public function test_a_harvest_returns_an_error_when_fields_are_missing()
    {
        $this->signIn();

        $harvest = factory(Harvest::class)->raw([
            'name' => '',
            'date' => '',
            'batch_code' => '',
            'weight' => '',
            'moister_content' => '',
            'nectar_source' => ''
        ]);

        $this->post('/harvests', $harvest)->assertSessionHasErrors([
            'name',
            'date',
            'batch_code',
            'weight',
            'moister_content',
            'nectar_source'
        ]);
    }

    public function test_a_user_can_delete_a_harvest()
    {
        $harvest = factory(Harvest::class)->create();

        $this->assertDatabaseHas('harvests', [
            'id' => $harvest['id'],
        ]);

        $this->actingAs($harvest->user)
            ->delete($harvest->path())
            ->assertRedirect('/harvests');

        $this->assertDatabaseMissing('harvests', [
            'id' => $harvest['id'],
        ]);
    }

    public function test_a_user_cannot_delete_a_harvest_of_others()
    {
        $this->signIn();

        $harvest = factory(Harvest::class)->create();

        $this->delete($harvest->path())
            ->assertStatus(403);
    }
}
