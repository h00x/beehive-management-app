<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Harvest extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

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
