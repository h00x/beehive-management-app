<?php

namespace Tests\Feature;

use App\HiveType;
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

    public function test_a_user_has_the_default_hive_types()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('hive_types', ['name' => 'Langstroth', 'user_id' => $user->id, 'protected_type' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Dadant', 'user_id' => $user->id, 'protected_type' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Top-bar', 'user_id' => $user->id, 'protected_type' => true]);
        $this->assertDatabaseHas('hive_types', ['name' => 'Other', 'user_id' => $user->id, 'protected_type' => true]);
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
}
