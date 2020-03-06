<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Queen extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

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

    public function hasAHive()
    {
        if ($this->hive) {
            return $this->hive->exists();
        }

        return false;
    }
}
