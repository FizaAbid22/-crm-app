<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
  protected $fillable = ['client_id', 'title', 'status', 'amount', 'start_date', 'due_date'];
  protected $casts = [
    'start_date' => 'date',
    'due_date' => 'date',
];

   public function client()
   {
    return $this->belongsTo(Client::class);
   }
    public function users()
   {
    return $this->belongsToMany(User::class);
   }

    public function comments()
   {
    return $this->hasMany(Comment::class);
   }

    public function tasks()
   {
    return $this->hasMany(Task::class);
   }
}
