<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function todos()
    {
        return $this->hasMany(Todo::class, 'user_id')
            ->orderBy('order');
    }

    public function hasPassedTasks()
    {
        $today = date("Y-m-d");

        return Todo::where('user_id', $this->id)
            ->where('due_dat', '>', $today)
            ->count();
    }

    public function passedTasks()
    {
        $today = date("Y-m-d");

        return Todo::where('user_id', $this->id)
            ->where('due_dat', '>', $today)
            ->get();
    }
}
