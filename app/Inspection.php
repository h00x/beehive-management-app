<?php

namespace App;

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
}
