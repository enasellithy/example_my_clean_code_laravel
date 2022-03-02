<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolsTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private $user;

    private function create_user($is_admin = 0) {
        $this->user = User::factory(1)->create([
            'email' => ($is_admin) ? 'admin@mail.com' : 'user@mail.com',
            'password' => bcrypt('123456'),
            'user_role_id' => ($is_admin) ? 1 : 2,
        ]);
    }

    public function test_admin_can_see_create_school_button()
    {
        $this->create_user(1);
        $response = $this->actingAs(User::findOrFail(1))->get('/schools');
        $response->assertStatus(200);
        $response->assertSee('Add New School');
    }

    public function test_user_can_not_see_create_school_button()
    {
        $this->create_user();
        $response = $this->actingAs(User::findOrFail(1))->get('/');
        $response->assertStatus(200);
        $response->assertDontSee('Add New School');
    }

    public function test_store_school_exists_in_database()
    {
        $this->create_user(1);
        $response = $this->actingAs(User::findOrFail(1))
            ->post('/schools',['name' => 'School Test']);
        $this->assertDatabaseHas('schools',['name' => 'School Test']);
        $school = School::orderBy('id', 'desc')->first();
        $this->assertEquals('School Test', $school->name);
    }

    public function test_update_school_from_contains_correct_name()
    {
        $this->create_user(1);
        $school = School::factory(1)->create();
        $response = $this->actingAs(User::findOrFail(1))
            ->put('/schools/'.$school->last()->id,
                ['name' => 'Update School Name'],
                ['Accept' => 'Application/json']);
        $response->assertStatus(422);
    }
}
