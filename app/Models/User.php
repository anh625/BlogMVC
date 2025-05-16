<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    //
    use HasFactory;
    protected $table = 'users';
    public $incrementing = false;
    protected $primaryKey = 'user_id';
    protected $fillable = ['user_id','name', 'email', 'password','phone_number','user_image','is_active','is_admin'];
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'user_id');
    }
}
