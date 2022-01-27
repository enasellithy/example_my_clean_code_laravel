<?php


namespace App\Repositories;


use App\Models\School;

class SchoolRepository
{
    public function getAllSchool()
    {
        return School::latest()->paginate(10);
    }

    public function create(array $data)
    {
        School::create($data);
    }

    public function update($id,array $data)
    {
        School::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        School::findOrFail($id)->delete();
    }
}
