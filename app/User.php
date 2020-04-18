<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use Notifiable;
    use CausesActivity;

    public static function boot()
    {
        static::created(function (User $user) {
            $user->hiveTypes()->createMany([
                ['name' => 'Langstroth', 'protected' => true],
                ['name' => 'Dadant', 'protected' => true],
                ['name' => 'Top-bar', 'protected' => true],
                ['name' => 'Other', 'protected' => true],
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
        'first_name', 'last_name', 'email', 'password', 'language', 'uses_metric', 'profile_image_name'
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
        'uses_metric' => 'boolean',
    ];

    public function hives()
    {
        return $this->hasMany(Hive::class);
    }

    public function hiveTypes()
    {
        return $this->hasMany(HiveType::class);
    }

    public function apiaries()
    {
        return $this->hasMany(Apiary::class);
    }

    public function queens()
    {
        return $this->hasMany(Queen::class);
    }

    public function harvests()
    {
        return $this->hasMany(Harvest::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function availableQueens()
    {

        $availableQueens = $this->queens->reject(function ($queen) {
            return $queen->hive;
        });

        return $availableQueens;
    }
}
