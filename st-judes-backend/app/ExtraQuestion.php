<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraQuestion extends Model
{
    public $timestamps = true;

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
