<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/harvests/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hives()
    {
        return $this->belongsToMany(Hive::class, 'harvest_hive')->withTimestamps();
    }

    public function hasHive($hive)
    {
        return $this->hives->contains($hive);
    }
}
