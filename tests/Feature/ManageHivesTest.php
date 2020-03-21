<?php

namespace Tests\Feature;

use App\Apiary;
use App\Hive;
use App\Queen;
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
    {
        $this->withoutExceptionHandling();
        $user = $this->signIn();
        $this->post('/apiaries', $apiary = factory(Apiary::class)->raw(['user_id' => $user->id]));
        $this->post('/queens', factory(Queen::class)->raw(['user_id' => $user->id]));

        $this->get('/hives/create')->assertStatus(200);

        $hive = factory(Hive::class)->raw([
            'queen_id' => $user->queens->first()->id,
            'hive_type_id' => $user->hiveTypes->first()->id,
            'apiary_id' => $user->apiaries->first()->id
        ]);

        $this->post('/hives', $hive);
        $this->assertDatabaseHas('hives', [
            'name' => $hive['name'],
            'user_id' => $user->id,
            'apiary_id' => $user->apiaries->first()->id,
            'hive_type_id' => $user->hiveTypes->first()->id,
            'queen_id' => $user->queens->first()->id,
        ]);
    }

    public function test_a_user_can_view_their_hive()
    {
        $user = $this->signIn();

        $hive = factory(Hive::class)->create([
            'user_id' => $user->id,
        ]);

        $this->get($hive->path())
            ->assertStatus(200)
            ->assertSee($hive->name)
            ->assertSee($hive->apiary->location)
            ->assertSee($hive->type->name)
            ->assertSee($hive->queen->name);
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
        $this->withoutExceptionHandling();
        $hive = factory(Hive::class)->create();

        $user = $this->signIn($hive->user);

        $this->post('/apiaries', factory(Apiary::class)->raw(['user_id' => $user->id]));
        $this->post('/queens', factory(Queen::class)->raw(['user_id' => $user->id]));

        $this->actingAs($hive->user)
            ->patch($hive->path(), $attributes = [
                'name' => 'Changed',
                'apiary_id' => $user->apiaries->first()->id,
                'hive_type_id' => $user->hiveTypes->first()->id,
                'queen_id' => $user->queens->first()->id,
                ])
            ->assertRedirect($hive->path());

        $this->get($hive->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('hives', $attributes);
    }

    public function test_a_user_cannot_update_a_hive_of_others()
    {
        $user = $this->signIn();

        $hive = factory(Hive::class)->create();

        $this->patch($hive->path(), ['name' => 'Changed', 'apiary_id' => 1, 'hive_type_id' => $hive->type->id])->assertStatus(403);
    }

    public function test_a_hive_needs_a_name()
    {
        $user = $this->signIn();
        $this->post('/apiaries', factory(Apiary::class)->raw());

        $hive = factory(Hive::class)->raw(['name' => '', 'hive_type_id' => $user->hiveTypes->first()->id, 'apiary_id' => $user->apiaries->first()->id]);

        $this->post('/hives', $hive)->assertSessionHasErrors('name');
    }

    public function test_a_hive_needs_a_apiary()
    {
        //$this->withoutExceptionHandling();
        $user = $this->signIn();

        $hive = factory(Hive::class)->raw(['apiary_id' => '', 'hive_type_id' => $user->hiveTypes->first()->id]);

        $this->post('/hives', $hive)->assertSessionHasErrors('apiary_id');
    }

    public function test_a_hive_needs_a_hive_type()
    {
        $user = $this->signIn();
        $this->post('/apiaries', factory(Apiary::class)->raw());
        $this->post('/queens', factory(Queen::class)->raw());

        $hive = factory(Hive::class)->raw(['hive_type_id' => '', 'apiary_id' => $user->apiaries->first()->id, 'queen_id' => $user->queens->first()->id]);

        $this->post('/hives', $hive)->assertSessionHasErrors('hive_type_id');
    }

    public function test_a_hive_cant_use_an_apiary_and_hive_type_of_others()
    {
        //$this->withoutExceptionHandling();
        $user = $this->signIn();

        $this->post('/apiaries', $apiary = factory(Apiary::class)->raw(['user_id' => $user->id]))->assertStatus(302);
        $this->post('/queens', $queen = factory(Queen::class)->raw(['user_id' => $user->id]))->assertStatus(302);
        $this->assertDatabaseHas('apiaries', $apiary);
        $this->assertDatabaseHas('queens', $queen);

        $hive2 = factory(Hive::class)->raw();

        // Try to post with wrong apiary id and hive type id
        $this->post('/hives', $hive2)->assertStatus(403);

        // Change apiary id to apiary id of the signed in user
        $hive2['queen_id'] = $user->queens->first()->id;

        // Still has an hive type ID that is not present in the user account
        $this->post('/hives', $hive2)->assertStatus(403);

        // Change apiary id to apiary id of the signed in user
        $hive2['apiary_id'] = $user->apiaries->first()->id;

        // Still has an hive type ID that is not present in the user account
        $this->post('/hives', $hive2)->assertStatus(403);

        // Change hive type id to hive type id of the signed in user
        $hive2['hive_type_id'] = $user->hiveTypes->first()->id;

        $this->post('/hives', $hive2);
        $this->assertDatabaseHas('hives', [
            'name' => $hive2['name'],
            'user_id' => $user->id,
            'apiary_id' => $hive2['apiary_id'],
            'hive_type_id' => $hive2['hive_type_id']
        ]);
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
