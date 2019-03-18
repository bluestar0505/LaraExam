<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Translations extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'translations';
    
    protected $fillable = [
          'slug',
          'text'
    ];
    

    public static function boot()
    {
        parent::boot();

        Translations::observe(new UserActionsObserver);
    }



    public static function getTranslation($slug, $language=false){

//        if($language == false) $language = Translations::DEFAULT_LANGUAGE;


        $t = Translations::where('slug',$slug)->first(); // ->where('languages_id', $language)

        if($t){
            return $t->text;
        }
        return "#NOT_FOUND #".$slug;
    }
    
    
    
}