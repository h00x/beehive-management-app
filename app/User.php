<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        static::created(function (User $user) {
            $user->hiveTypes()->createMany([
                ['name' => 'Langstroth', 'protected_type' => true],
                ['name' => 'Dadant', 'protected_type' => true],
                ['name' => 'Top-bar', 'protected_type' => true],
                ['name' => 'Other', 'protected_type' => true],
            ]);
        });

        parent::boot();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hives()
    {
        return $this->hasMany(Hive::class);
    }

    public function accessibleHives()
    {
        return Hive::where('user_id', $this->id)->get();
    }

    public function hiveTypes()
    {
        return $this->hasMany(HiveType::class);
    }

    public function accessibleHiveTypes()
    {
        return HiveType::where('user_id', $this->id)->get();
    }

    public function apiaries()
    {
        return $this->hasMany(Apiary::class);
    }

    public function accessibleApiaries()
    {
        return Apiary::where('user_id', $this->id)->get();
    }
}
