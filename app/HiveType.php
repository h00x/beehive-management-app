<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HiveType extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/hives/types/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
