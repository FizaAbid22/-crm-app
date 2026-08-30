<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['deal_id','title','description','due_date','status'];



    public function users()
    {
        return $this->belongsToMany(User::class);
    }

      public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
