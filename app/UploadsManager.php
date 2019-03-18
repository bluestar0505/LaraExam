<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadsManager extends Model
{

    public static function imageUrl($file){

        return url('uploads/'.$file);

    }


}
