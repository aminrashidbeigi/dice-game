<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class GameDesign extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'gamedesign';
    
    protected $fillable = [
          'maximum_score',
          'current_score',
          'dice_number'
    ];
    

    public static function boot()
    {
        parent::boot();

        GameDesign::observe(new UserActionsObserver);
    }
    
    
    
    
}