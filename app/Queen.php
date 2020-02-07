<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queen extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/queens/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hive()
    {
        return $this->hasOne(Hive::class);
    }
}
