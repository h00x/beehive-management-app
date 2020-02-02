<?php

namespace Tests\Feature;

use App\Apiary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageApiariesTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_apiaries_overview()
    {
        $response = $this->get('/apiaries');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_create_a_apiary()
    {
        $hive = factory(Apiary::class)->raw();

        $this->post('/apiaries', $hive)->assertRedirect('/login');

        $this->assertDatabaseMissing('apiaries', $hive);
    }

    public function test_a_user_can_create_an_apiary()
    {
        $user = $this->signIn();

        $this->get('/apiaries/create')->assertStatus(200);

        $apiary = factory(Apiary::class)->raw();

        $this->post('/apiaries', $apiary);
        $this->assertDatabaseHas('apiaries', [
            'name' => $apiary['name'],
            'location' => $apiary['location'],
            'user_id' => $user->id
        ]);
    }

    public function test_a_user_can_view_their_apiary()
    {
        $apiary = factory(Apiary::class)->create();

        $this->actingAs($apiary->user)->get($apiary->path())
            ->assertStatus(200)
            ->assertSee($apiary->name)
            ->assertSee($apiary->location);
    }

    public function test_a_user_can_view_all_their_apiaries_on_the_apiary_overview_page()
    {
        $this->signIn();

        $apiary1 = factory(Apiary::class)->raw();
        $apiary2 = factory(Apiary::class)->raw();
        $apiary3 = factory(Apiary::class)->raw();

        $this->post('/apiaries', $apiary1);
        $this->post('/apiaries', $apiary2);
        $this->post('/apiaries', $apiary3);

        $this->get('/apiaries')
            ->assertStatus(200)
            ->assertSee($apiary1['name'])
            ->assertSee($apiary1['location'])
            ->assertSee($apiary2['name'])
            ->assertSee($apiary2['location'])
            ->assertSee($apiary3['name'])
            ->assertSee($apiary3['location']);
    }

    public function test_a_user_doesnt_see_apiaries_of_others_in_their_apiary_overview()
    {
        $apiaryOfDave = factory(Apiary::class)->create();
        $apiaryOfPete = factory(Apiary::class)->create();

        $this->actingAs($apiaryOfDave->user)
            ->get('/apiaries')
            ->assertStatus(200)
            ->assertSee($apiaryOfDave->name)
            ->assertSee($apiaryOfDave->location)
            ->assertDontSee($apiaryOfPete->name)
            ->assertDontSee($apiaryOfPete->location);
    }

    public function test_a_user_can_update_an_apiary()
    {
        $apiary = factory(Apiary::class)->create();

        $this->actingAs($apiary->user)
            ->patch($apiary->path(), $attributes = ['name' => 'Changed', 'location' => 'Changed'])
            ->assertRedirect($apiary->path());

        $this->get($apiary->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('apiaries', $attributes);
    }

    public function test_a_user_cannot_update_an_apiary_of_others()
    {
        $this->signIn();

        $apiary = factory(Apiary::class)->create();

        $this->patch($apiary->path(), ['name' => 'Changed', 'location' => 'Changed'])->assertStatus(403);
    }

    public function test_an_apiary_needs_a_name()
    {
        $this->signIn();

        $apiary = factory(Apiary::class)->raw(['name' => '']);

        $this->post('/apiaries', $apiary)->assertSessionHasErrors('name');
    }

    public function test_an_apiary_needs_a_location()
    {
        $this->signIn();

        $apiary = factory(Apiary::class)->raw(['location' => '']);

        $this->post('/apiaries', $apiary)->assertSessionHasErrors('location');
    }

    public function test_a_user_can_delete_an_apiary()
    {
        $apiary = factory(Apiary::class)->create();

        $this->assertDatabaseHas('apiaries', [
            'id' => $apiary['id'],
        ]);

        $this->actingAs($apiary->user)
            ->delete($apiary->path())
            ->assertRedirect('/apiaries');

        $this->assertDatabaseMissing('apiaries', [
            'id' => $apiary['id'],
        ]);
    }

    public function test_a_user_cannot_delete_an_apiary_of_others()
    {
        $this->signIn();

        $apiary = factory(Apiary::class)->create();

        $this->delete($apiary->path())
            ->assertStatus(403);
    }
}
