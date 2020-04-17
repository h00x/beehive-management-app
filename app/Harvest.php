<?php

namespace App;

use App\Helpers\UnitSystemHelper;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Harvest extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    protected $appends = ['computed_weight', 'converted_weight'];

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

    public function getConvertedWeightAttribute()
    {
        if(!auth()->user()->uses_metric) {
            return UnitSystemHelper::calculateLbs($this->weight);
        }

        return $this->weight;
    }

    public function getComputedWeightAttribute()
    {
        return UnitSystemHelper::processWeightFromKg($this->weight, auth()->user()->uses_metric);
    }
}
