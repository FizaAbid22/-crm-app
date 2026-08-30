<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','deal_id','body'];

public function deal()
{
    return $this->belongsTo(Deal:: class);
}
public function user()
{
    return $this->belongsTo(User:: class);
}


}
