<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $primaryKey = 'cmt_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'cmt_content',
        'user_id',
        'post_id',
        'cmt_content'
    ];
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
