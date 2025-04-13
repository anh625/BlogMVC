<?php
namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\IUserRepository;

class UserRepository implements IUserRepository
{
    public function show(int $perPage) {
        return User::paginate($perPage);
    }

    public function getById(string $id) {
        return User::where('user_id', $id)->first();
    }

    public function getByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function store(array $data) {
        return User::create($data);
    }

    public function update(array $data, string $id) {
        $User = User::where('user_id', $id)->first();
        if (!$User) return null;

        $User->update($data);
        return $User;
    }

    public function delete(string $id) {
        $User = User::where('user_id', $id)->first();
        if (!$User) return null;

        $User->delete();
        return $User;
    }
}
