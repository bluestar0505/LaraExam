<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;


class suggestions extends Model {


    protected $table    = 'category';
    
    protected $fillable = [
          'name',
          'parent_id',
          'visible'
    ];
    

    public static function boot()
    {
        parent::boot();

        Category::observe(new UserActionsObserver);
    }
    
    public function parent()
    {
        return $this->hasOne('App\Category', 'id', 'parent_id');
    }


    public static function pluckParent($id=0){

        $categories = Category::where('id','!=',$id)->get();

        return $categories->pluck("name", "id")->prepend('None', 0);
    }


    public static function getCategory($id){
        return Category::where('id',$id)->where('visible',1)->first();
    }
    public static function allCategories(){
        return Category::where('name','LIKE','1E%')->where('visible',1) ->orderByRaw(
     "CASE 
     WHEN name LIKE '1E1 %'
     THEN 1 
     WHEN name LIKE '1E2%'
     THEN 2 
     WHEN name LIKE '1E3%'
     THEN 3 
     WHEN name LIKE '1E4%'
     THEN 4
     WHEN name LIKE '1E5%'
     THEN 5
     WHEN name LIKE '1E6%'
     THEN 6
     WHEN name LIKE '1E7%'
     THEN 7
     WHEN name LIKE '1E8%'
     THEN 8 
     ELSE 9
     END"
)->get();
    }

     public static function allCategoriesSF(){
        return Category::where('name','LIKE','2E%')->where('visible',1)->orderByRaw(
     "CASE 
     WHEN name LIKE '2E1 %'
     THEN 1 
     WHEN name LIKE '2E2%'
     THEN 2 
     WHEN name LIKE '2E3%'
     THEN 3 
     WHEN name LIKE '2E4%'
     THEN 4
     WHEN name LIKE '2E5%'
     THEN 5
     WHEN name LIKE '2E6%'
     THEN 6
     WHEN name LIKE '2E7%'
     THEN 7
     WHEN name LIKE '2E8%'
     THEN 8 
     ELSE 9
     END"
)->get();
    }



     public static function MACategories(){
        return Category::where('name','LIKE','MA%')->orWhere('name','LIKE','ST%')->where('visible',1)->get();
    }


    public static function getChilds($parent_id){
        return Category::where('parent_id',$parent_id)->where('visible',1)->get();
    }


    public static function search($string){

        return Category::where('name','LIKE','%'.$string.'%')->where('visible',1)->get();
    }
    
    public function unreadNotifications()
    {
        return  DB::table('notification_users')
            ->where('IsSeen', '=', 0)
            ->count();
    }
    
}