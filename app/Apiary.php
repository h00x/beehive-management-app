<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apiary extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/apiaries/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hives()
    {
        return $this->hasMany(Hive::class);
    }
}
