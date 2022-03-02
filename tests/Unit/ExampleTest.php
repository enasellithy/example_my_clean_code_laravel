<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function test_students_page_contains_not_empty_student_table()
    {
        $response = $this->get('/students');
        $response->assertDontSee('No Student');
    }

    public function test_students_page_contains_non_empty_student_table()
    {
        $students = User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => '123456',
            'role_id' => 2
        ]);
        $schools = School::all();
        $response = $this->get('/students');
        $view = $this->view('admin.student.index',['students' => $students->latest()->paginate(10),'schools' => $schools]);
        $this->assertEquals($students->name,$students->first()->name);
    }

    public function test_paginated_students_table_doesnt_show()
    {
        $students = User::factory(11)->create();
        $response = $this->get('/students');
        $response->assertDontSee($students->first()->name);
    }
}
