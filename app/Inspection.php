<?php

namespace App;

use App\Helpers\UnitSystemHelper;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Inspection extends Model
{
    use LogsActivity;

    protected $guarded = [];
    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    protected $casts = [
        'queen_seen' => 'boolean',
        'larval_seen' => 'boolean',
        'young_larval_seen' => 'boolean',
    ];

    protected $appends = ['computed_temperature'];

    public function path()
    {
        return "/inspections/{$this->id}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hive()
    {
        return $this->belongsTo(Hive::class);
    }

    /**
     * Sets the temperature variable based on the user unit setting
     * and the symbol is suffixed to the number
     *
     * @param $value
     * @return string
     */
    public function getComputedTemperatureAttribute()
    {
        return UnitSystemHelper::processTemperatureFromCelsius($this->temperature, auth()->user()->uses_metric);
    }
}
