<?php

namespace Tests\Feature;

use App\Hive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageHivesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if unauthenticated users can't reach the hive overview
     *
     * @return void
     */
    public function test_guests_cannot_view_hives_overview()
    {
        $response = $this->get('/hives');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_create_a_hive()
    {
        $hive = factory(Hive::class)->raw();

        $this->post('/hives', $hive)->assertRedirect('/login');

        $this->assertDatabaseMissing('hives', $hive);
    }

    /**
     * Test if users can create hives
     *
     * @return void
     */
    public function test_a_user_can_create_a_hive()
    {        $user = $this->signIn();

        $this->get('/hives/create')->assertStatus(200);

        $hive = factory(Hive::class)->raw();

        $this->post('/hives', $hive);
        $this->assertDatabaseHas('hives', [
            'name' => $hive['name'],
            'user_id' => $user->id,
            'apiary_id' => $hive['apiary_id']
        ]);
    }

    public function test_a_user_can_view_their_hive()
    {
        $hive = factory(Hive::class)->create();

        $this->actingAs($hive->user)->get($hive->path())
            ->assertStatus(200)
            ->assertSee($hive->name)
            ->assertSee($hive->apiary->location);
    }

    public function test_a_user_cannot_view_hives_of_others()
    {
        $this->signIn();

        $hive = factory(Hive::class)->create();

        $this->get($hive->path())->assertStatus(403);
    }

    public function test_a_user_can_view_all_their_hives_on_the_hive_overview_page()
    {
        $hive1 = factory(Hive::class)->create();
        $hive2 = factory(Hive::class)->create([
            'user_id' => '1',
        ]);
        $hive3 = factory(Hive::class)->create([
            'user_id' => '1',
        ]);

        $this->signIn($hive1->user);

        $this->get('/hives')
            ->assertStatus(200)
            ->assertSee($hive1->name)
            ->assertSee($hive1->apiary->location)
            ->assertSee($hive2->name)
            ->assertSee($hive2->apiary->location)
            ->assertSee($hive3->name)
            ->assertSee($hive3->apiary->location);
    }

    public function test_a_user_doesnt_see_hives_of_others_in_their_hive_overview()
    {
        $hiveOfDave = factory(Hive::class)->create();
        $hiveOfPete = factory(Hive::class)->create();

        $this->actingAs($hiveOfDave->user)
            ->get('/hives')
            ->assertStatus(200)
            ->assertSee($hiveOfDave->name)
            ->assertDontSee($hiveOfPete->apiary->location)
            ->assertDontSee($hiveOfPete->name)
            ->assertDontSee($hiveOfPete->apiary->location);
    }

    public function test_a_user_can_update_a_hive()
    {
        $hive = factory(Hive::class)->create();

        $this->actingAs($hive->user)
            ->patch($hive->path(), $attributes = ['name' => 'Changed', 'apiary_id' => 1])
            ->assertRedirect($hive->path());

        $this->get($hive->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('hives', $attributes);
    }

    public function test_a_user_cannot_update_a_hive_of_others()
    {
        $this->signIn();

        $hive = factory(Hive::class)->create();

        $this->patch($hive->path(), ['name' => 'Changed', 'apiary_id' => 1])->assertStatus(403);
    }

    public function test_a_hive_needs_a_name()
    {
        $this->signIn();

        $hive = factory(Hive::class)->raw(['name' => '']);

        $this->post('/hives', $hive)->assertSessionHasErrors('name');
    }

    public function test_a_hive_needs_a_apiary()
    {
        $this->signIn();

        $hive = factory(Hive::class)->raw(['apiary_id' => '']);

        $this->post('/hives', $hive)->assertSessionHasErrors('apiary_id');
    }

    public function test_a_user_can_delete_a_hive()
    {
        $hive = factory(Hive::class)->create();

        $this->assertDatabaseHas('hives', [
            'id' => $hive['id'],
        ]);

        $this->actingAs($hive->user)
            ->delete($hive->path())
            ->assertRedirect('/hives');

        $this->assertDatabaseMissing('hives', [
            'id' => $hive['id'],
        ]);
    }

    public function test_a_user_cannot_delete_a_hive_of_others()
    {
        $this->signIn();

        $hive = factory(Hive::class)->create();

        $this->delete($hive->path())
            ->assertStatus(403);
    }
}
