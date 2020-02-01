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

        $response->assertStatus(302);
    }


    /**
     * Test if users can create hives
     *
     * @return void
     */
    public function test_a_user_can_create_a_hive()
    {
        $this->signIn();

        $this->get('/hives/create')->assertStatus(200);

        $hive = factory(Hive::class)->raw();

        $this->followingRedirects()
            ->post('/hives', $hive)
            ->assertSee($hive['name'])
            ->assertSee($hive['location']);
    }
}
