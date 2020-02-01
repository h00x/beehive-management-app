<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hive extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/hives/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
