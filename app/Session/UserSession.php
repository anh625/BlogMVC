<?php
namespace App\Session;
class UserSession extends SessionManager{
    public function isUserUsing(string $user_id): bool
    {
        $sessionUser = session('user');
        return $sessionUser && $sessionUser->getAttributes()['user_id'] == $user_id;
    }

    public function isAdmin(): bool{
        $sessionUser = session('user');
        return $sessionUser && $sessionUser->role == 'admin';
    }

    public static function getUser()
    {
        return session('user');
    }

    public static function setUser($user): void
    {
        session(['user' => $user]);
    }
}
