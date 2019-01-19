<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class GameStatus extends Model {

    protected $table    = 'game_status';
    
//    protected $fillable = [
//          'maximum_score',
//          'current_score',
//          'dice_number'
//    ];
    
    public function game(){
        return $this->belongsTo('App\Game');
    }
    
}