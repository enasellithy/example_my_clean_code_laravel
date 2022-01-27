<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\School\AddRequest;
use App\Http\Requests\Admin\School\EditRequest;
use App\Repositories\SchoolRepository;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    private $school;

    public function __construct(SchoolRepository $schoolRepository)
    {
        $this->school = $schoolRepository;
    }

    public function index()
    {
        $schools = $this->school->getAllSchool();
        return view('admin.school.index',compact('schools'));
    }

    public function store(AddRequest $r)
    {
        $this->school->create($r->all());
        session()->flash('success', "Add successfully");
        return back();
    }

    public function update($id,EditRequest $r)
    {
        $this->school->update($id,$r->except('_token','_method'));
        session()->flash('success', "update successfully");
        return back();
    }

    public function destroy($id)
    {
        $this->school->destroy($id);
        session()->flash('success', "delete successfully");
        return back();
    }
}
