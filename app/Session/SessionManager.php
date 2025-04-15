<?php
namespace App\Session;
class SessionManager{
    public static function flush()
    {
        session()->flush();
    }
}
