<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
   protected $fillable =[ "user_id", "check_in", "check_out"];



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function casts(): array
    {
        return [
            'check_in' => 'datetime',
            'check_out' => 'datetime',


        ];
    }
}


