<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Activity;
use App\Models\Attendance;
use App\Models\Attendence;
use App\Models\Deal;
use App\Models\Leave;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role",
    ];
    public function deals()
{
    return $this->belongsToMany(Deal::class);
}

    public function comments()
{
    return $this->hasMany(Comment::class);
}
    public function task()
{
    return $this->belongsToMany(Task::class);
}

     public function timeLogs()
 {
    return $this->hasMany(TimeLog::class);
 }
    public function activities()
 {
    return $this->hasMany(Activity::class);
 }

      public function leaves()
 {
    return $this->hasMany(Leave::class);
 }



public function attendance()
 {
    return $this->hasMany(Attendance::class);
 }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
