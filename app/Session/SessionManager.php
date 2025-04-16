<?php
namespace App\Session;
class SessionManager{
    public static function flush(): void
    {
        session()->flush();
    }
}
