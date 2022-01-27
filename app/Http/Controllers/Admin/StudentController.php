<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\AddRequest;
use App\Http\Requests\Admin\Student\EditRequest;
use App\Repositories\SchoolRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $student;

    private $school;

    public function __construct(StudentRepository $studentRepository,SchoolRepository $schoolRepository)
    {
        $this->student = $studentRepository;
        $this->school = $schoolRepository;
    }

    public function index()
    {
        $students = $this->student->getAllStudents();
        $schools = $this->school->getAllSchool();
        return view('admin.student.index',compact('students','schools'));
    }

    public function store(AddRequest $r)
    {
        $students = $this->student->create($r->all());
        session()->flash('success', "Add successfully");
        return back();
    }

    public function update($id,EditRequest $r)
    {
        $this->student->update($id,$r->except('_token','_method'));
        session()->flash('success', "update successfully");
        return back();
    }

    public function destroy($id)
    {
        $this->student->destroy($id);
        session()->flash('success', "delete successfully");
        return back();
    }
}
