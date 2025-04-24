<?php
namespace App\Session;
class SessionManager{
    //xoá tất cả các session
    public static function flush(): void
    {
        session()->flush();
    }

    //lưu session tạm thời. session này chỉ tồn tại sau 1 redirect
    public static function flash($key,$value): void
    {
        session()->flash($key,$value);
    }
}
