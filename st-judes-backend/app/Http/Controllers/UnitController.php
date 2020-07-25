<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
   public function getAllUnits() {
        return ResponseHelper::success(Unit::all());
   }

   public function getRatingAccordingToUnit($unit_id) {
       $unit = Unit::find($unit_id);
       if ($unit) {
           $unit_obj = DB::select("SELECT AVG(question_responses.rating) as avg, questions.unit_id from questions INNER JOIN question_responses ON question_responses.question_id = questions.id WHERE questions.unit_id = ".$unit_id." GROUP BY questions.unit_id");

           return ResponseHelper::success($unit_obj);
       }

       return ResponseHelper::badRequest();
   }
}
