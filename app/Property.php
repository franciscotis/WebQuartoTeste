<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function images(){
        return $this->hasMany('App\PropertyImage','property_id');
    }

    public function address(){
        return $this->hasOne('App\PropertyAddress','property_id');
    }
}
