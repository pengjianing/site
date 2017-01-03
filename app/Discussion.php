<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title','body','user_id','last_id'];

    public function user()
    {
        return $this->belongsTo(User::class);//一对一
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
