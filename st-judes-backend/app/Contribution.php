<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    public $timestamps = true;
    protected $guarded = [];

    public function donor() {
        return $this->belongsTo(Donor::class, 'donor_id');
    }
}
