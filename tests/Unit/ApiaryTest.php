<?php

namespace Tests\Unit;

use App\Apiary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiaryTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $apiary = factory(Apiary::class)->create();

        $this->assertEquals('/apiaries/' . $apiary->id, $apiary->path());
    }

    public function test_it_has_an_owner()
    {
        $apiary = factory(Apiary::class)->create();

        $this->assertInstanceOf('App\User', $apiary->user);
    }
}
