<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = true;

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
