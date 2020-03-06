<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;

class Hive extends Model
{
    use LogsActivity;
    use CausesActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    public function path()
    {
        return "/hives/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apiary()
    {
        return $this->belongsTo(Apiary::class);
    }

    public function type()
    {
        return $this->belongsTo(HiveType::class, 'hive_type_id');
    }

    public function queen()
    {
        return $this->belongsTo(Queen::class);
    }

    public function harvests()
    {
        return $this->belongsToMany(Harvest::class);
    }

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }
}
