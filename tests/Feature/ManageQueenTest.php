<?php

namespace Tests\Feature;

use App\Apiary;
use App\Hive;
use App\Queen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageQueenTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_queens_overview()
    {
        $response = $this->get('/queens');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_to_create_a_queen()
    {
        $queen = factory(Queen::class)->raw();

        $this->post('/queens', $queen)->assertRedirect('/login');

        $this->assertDatabaseMissing('queens', $queen);
    }

    public function test_a_user_can_create_a_queen()
    {
        $user = $this->signIn();

        $this->get('/apiaries/create')->assertStatus(200);

        $queen = factory(Queen::class)->raw();

        $this->post('/queens', $queen);
        $this->assertDatabaseHas('queens', [
            'name' => $queen['name'],
            'race' => $queen['race'],
            'marking' => $queen['marking'],
            'user_id' => $user->id
        ]);
    }

    public function test_a_user_can_only_view_their_own_queens_on_the_queens_overview_page()
    {
        $queen1 = factory(Queen::class)->create();
        $queen2 = factory(Queen::class)->create([
            'user_id' => '1',
        ]);
        $queen3 = factory(Queen::class)->create([
            'user_id' => '1',
        ]);
        $queen4 = factory(Queen::class)->create();

        $this->signIn($queen1->user);

        $this->get('/queens')
            ->assertStatus(200)
            ->assertSee($queen1->name)
            ->assertSee($queen2->name)
            ->assertSee($queen3->name)
            ->assertDontSee($queen4->name);
    }

    public function test_a_user_can_update_a_queen()
    {
        $queen = factory(Queen::class)->create();

        $this->actingAs($queen->user)
            ->patch($queen->path(), $attributes = ['name' => 'Changed', 'race' => 'Changed', 'marking' => 'Changed'])
            ->assertRedirect('queens');

        $this->get($queen->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('queens', $attributes);
    }

    public function test_a_user_cannot_update_a_queen_of_others()
    {
        $this->signIn();

        $queen = factory(Queen::class)->create();

        $this->patch($queen->path(), ['name' => 'Changed', 'race' => 'Changed', 'marking' => 'Changed'])->assertStatus(403);
    }

    public function test_a_queen_needs_a_name()
    {
        $this->signIn();

        $queen = factory(Queen::class)->raw(['name' => '']);

        $this->post('/queens', $queen)->assertSessionHasErrors('name');
    }

    public function test_a_queen_needs_a_race()
    {
        $this->signIn();

        $queen = factory(Queen::class)->raw(['race' => '']);

        $this->post('/queens', $queen)->assertSessionHasErrors('race');
    }

    public function test_a_queen_needs_a_marking()
    {
        $this->signIn();

        $queen = factory(Queen::class)->raw(['marking' => '']);

        $this->post('/queens', $queen)->assertSessionHasErrors('marking');
    }

    public function test_a_user_can_delete_a_queen()
    {
        $this->withoutExceptionHandling();
        $queen = factory(Queen::class)->create();

        $this->assertDatabaseHas('queens', [
            'id' => $queen['id'],
        ]);

        $this->actingAs($queen->user)
            ->delete($queen->path())
            ->assertRedirect('/queens');

        $this->assertDatabaseMissing('queens', [
            'id' => $queen['id'],
        ]);
    }

    public function test_a_user_cannot_delete_a_queen_of_others()
    {
        $this->signIn();

        $queen = factory(Queen::class)->create();

        $this->delete($queen->path())
            ->assertStatus(403);
    }

    public function test_a_queen_cant_be_deleted_when_it_has_hives_allocated_to_it()
    {
        $user = $this->signIn();

        $this->post('/queens', factory(Queen::class)->raw());
        $this->post('/apiaries', factory(Apiary::class)->raw());

        $hive = factory(Hive::class)->raw([
            'queen_id' => $user->queens->first()->id,
            'hive_type_id' => $user->hiveTypes->first()->id,
            'apiary_id' => $user->apiaries->first()->id
        ]);

        $this->post('/hives', $hive);

        $this->delete($user->queens->first()->path())
            ->assertRedirect(route('queens.index'))
            ->assertSessionHas('flashMessage.description', 'This queen has a hive. Can\'t delete it.')
            ->assertSessionHas('flashMessage.type', 'danger');
    }
}
