<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey = 'category_id';
    protected $keyType = 'string';

    protected $fillable = [
        'category_name',
        'category_slug',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'category_id');
    }
}
