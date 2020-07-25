<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\Donor;
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

    public function getDonorContributionAccordingToUnit($donor_id) {
        $donorObj = Donor::find($donor_id);
        if ($donorObj) {
            $contributionObj = Contribution::join('donor_units', 'contributions.id', 'donor_units.contribution_id')->join('units', 'donor_units.unit_id', 'units.id' )->where('donor_units.donor_id',
                '=', $donor_id)->get();
            return ResponseHelper::success($contributionObj);
        }
        return ResponseHelper::badRequest();
    }
}
