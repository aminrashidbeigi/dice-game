<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table    = 'comments';

    protected $fillable = [
        'body',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function game()
    {
        return $this->belongsTo('App\Game');
    }
}
