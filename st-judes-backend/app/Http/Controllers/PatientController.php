<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function getStrengthNumber() {
        return ResponseHelper::success(Patient::all()->count());
    }
}
