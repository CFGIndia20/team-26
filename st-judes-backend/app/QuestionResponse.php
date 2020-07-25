<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    public $timestamps = true;

    public function question() {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
