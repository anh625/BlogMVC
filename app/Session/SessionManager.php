<?php
namespace App\Session;
class SessionManager{
    public static function flush(): void
    {
        session()->flush();
    }
    public static function flash($key,$value): void
    {
        session()->flash($key,$value);
    }
}
