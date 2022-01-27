<?php


namespace App\Repositories;


use App\Models\User;

class StudentRepository
{
    public function getAllStudents()
    {
        return User::where('user_role_id',2)->latest()->paginate(10);
    }

    public function create(array $data)
    {
        User::create($data);
    }

    public function update($id,array $data)
    {
        User::whereId($id)->update($data);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
    }

}
