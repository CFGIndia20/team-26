<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $timestamps = true;

    public function centre() {
        return $this->belongsTo(Centre::class, 'centre_id');
    }
}
