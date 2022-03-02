<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertSee('Laravel');
        $response->assertStatus(200);
    }

    public function test_login_view_form_email()
    {
        $response = $this->get('/login');
        $response->assertSee('email');
        $response->assertStatus(200);
    }

    public function test_login_view_form_password()
    {
        $response = $this->get('/login');
        $response->assertSee('password');
        $response->assertStatus(200);
    }

    public function test_login_view_forget_password_link_exists()
    {
        $response = $this->get('/login');
        $response->assertSee('Forgot your password?');
        $response->assertStatus(200);
    }

}
