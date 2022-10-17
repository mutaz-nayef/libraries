<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /*
    between get and attribute you can write any attr not to make it easy when you us it in view model
       public function get_____Attribute(){
        return $this->attributeHere #some code;
       }
    */
    public function getActiveStatusAttribute()
    {
        return $this->active ? 'Active' : 'Non-Active';
    }
}
