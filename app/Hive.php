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
}
