<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;
    use Authenticatable;

    public function test_login_redirect_successfully()
    {
        $user = User::factory(1)->create([
            'email' => 'FeatureTest@mail.com',
            'password' => '123456'
        ]);
        $response = $this->post('/login',['email' => 'FeatureTest@mail.com', 'password' => '123456']);
        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
    }

    public function test_authenticated_user_can_access_schools_table()
    {
        $user = User::factory(1)->create([
            'email' => 'FeatureTest@mail.com',
            'password' => '123456',
            'user_role_id' => 1,
        ]);
        $response = $this->post('/login',['email' => 'FeatureTest@mail.com', 'password' => '123456']);
        $this->actingAs(User::findOrFail(1))->get('/schools');
        $response->assertStatus(302);
    }

    public function test_authenticated_user_cannot_access_schools_table()
    {
        $response = $this->get('/schools');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
