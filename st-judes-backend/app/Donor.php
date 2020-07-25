<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    public $timestamps = true;

    public const DONOR_IN_REVIEW = 0;
    public const DONOR_VERIFIED = 1;
    public const DONOR_REJECTED = 2;

    public function user() {
        return$this->belongsTo(User::class, 'user_id');
    }
}
