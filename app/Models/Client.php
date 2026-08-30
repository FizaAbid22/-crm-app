<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //Mess assigment 
    protected $fillable = ['name','email','phone'];
    
     public function deals()
    {
        return $this->hasMany(Deal::class);
    }
    
    
}

   