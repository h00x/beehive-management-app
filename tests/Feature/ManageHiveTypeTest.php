<?php

namespace Tests\Feature;

use App\Apiary;
use App\Hive;
use App\HiveType;
use App\Queen;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageHiveTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_view_hive_types_overview()
    {
        $response = $this->get('/types');

        $response->assertRedirect('/login');
    }

    public function test_you_need_to_be_authenticated_create_a_hive_type()
    {
        $hiveType = factory(HiveType::class)->raw();

        $this->post('/types', $hiveType)->assertRedirect('/login');

        $this->assertDatabaseMissing('hive_types', $hiveType);
    }

    public function test_a_user_can_create_a_hive_type()
    {
        $user = $this->signIn();

        $this->get('/types/create')->assertStatus(200);

        $hiveType = factory(HiveType::class)->raw();

        $this->post('/types', $hiveType);
        $this->assertDatabaseHas('hive_types', [
            'name' => $hiveType['name'],
            'user_id' => $user->id
        ]);
    }

    public function test_a_user_can_view_all_their_hive_types_on_the_hive_type_overview_page()
    {
        $type1 = factory(HiveType::class)->create();
        $type2 = factory(HiveType::class)->create([
            'user_id' => '1',
        ]);
        $type3 = factory(HiveType::class)->create([
            'user_id' => '1',
        ]);

        $this->signIn($type1->user);

        $this->get('/types')
            ->assertStatus(200)
            ->assertSee($type1->name)
            ->assertSee($type2->name)
            ->assertSee($type3->name);
    }

    public function test_a_user_doesnt_see_hive_types_of_others_in_their_hive_type_overview()
    {
        $hiveTypeOfDave = factory(HiveType::class)->create();
        $hiveTypeOfPete = factory(HiveType::class)->create();

        $this->actingAs($hiveTypeOfDave->user)
            ->get('/types')
            ->assertStatus(200)
            ->assertSee($hiveTypeOfDave->name)
            ->assertDontSee($hiveTypeOfPete->name);
    }

    public function test_a_user_has_the_default_hive_types()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('hive_types', ['name' => 'Langstroth', 'user_id' => $user->id, 'protected' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Dadant', 'user_id' => $user->id, 'protected' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Top-bar', 'user_id' => $user->id, 'protected' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Other', 'user_id' => $user->id, 'protected' => true]);
    }

    public function test_a_user_can_update_a_hive_type()
    {
        $this->withoutExceptionHandling();

        $type = factory(HiveType::class)->create();

        $this->actingAs($type->user)
            ->patch($type->path(), $attributes = ['name' => 'Changed'])
            ->assertRedirect($type->path());

        $this->get($type->path() . '/edit')->assertOk();

        $this->assertDatabaseHas('hive_types', $attributes);
    }

    public function test_a_user_cannot_update_a_hive_of_others()
    {
        $this->signIn();

        $hiveType = factory(HiveType::class)->create();

        $this->patch($hiveType->path(), ['name' => 'Changed'])->assertStatus(403);
    }

    public function test_a_user_cannot_update_a_protected_hive_type()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->patch($user->hiveTypes->first()->path(), ['name' => 'Changed'])->assertStatus(403);
    }

    public function test_a_hive_type_needs_a_name()
    {
        $this->signIn();

        $hiveType = factory(HiveType::class)->raw(['name' => '']);

        $this->post('/types', $hiveType)->assertSessionHasErrors('name');
    }

    public function test_a_user_can_delete_a_hive_type()
    {
        $hiveType = factory(HiveType::class)->create();

        $this->assertDatabaseHas('hive_types', [
            'id' => $hiveType['id'],
        ]);

        $this->actingAs($hiveType->user)
            ->delete($hiveType->path())
            ->assertRedirect('/types');

        $this->assertDatabaseMissing('hive_types', [
            'id' => $hiveType['id'],
        ]);
    }

    public function test_a_user_cannot_delete_a_hive_type_that_is_protected()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->delete($user->hiveTypes->first()->path())
            ->assertStatus(403);
    }

    public function test_a_user_cannot_delete_a_hive_type_of_others()
    {
        $this->signIn();

        $hiveType = factory(HiveType::class)->create();

        $this->delete($hiveType->path())
            ->assertStatus(403);
    }

    public function test_a_hive_type_cant_be_deleted_when_it_has_hives_allocated_to_it()
    {
        $user = $this->signIn();

        $this->post('/apiaries', factory(Apiary::class)->raw());
        $this->post('/queens', factory(Queen::class)->raw());
        $type = factory(HiveType::class)->create([
            'user_id' => $user->id,
        ]);

        $hive = factory(Hive::class)->raw([
            'queen_id' => $user->queens->first()->id,
            'hive_type_id' => $type->id,
            'apiary_id' => $user->apiaries->first()->id
        ]);

        $this->post('/hives', $hive);

        $this->delete($type->path())
            ->assertRedirect(route('types.index'))
            ->assertSessionHasErrors('delete');
    }
}
