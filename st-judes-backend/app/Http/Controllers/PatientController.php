<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function getStrengthNumber() {
        return Patient::all()->count();
    }
}
