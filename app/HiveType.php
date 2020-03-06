<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class HiveType extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    public function path()
    {
        return "/types/{$this->id}";
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
