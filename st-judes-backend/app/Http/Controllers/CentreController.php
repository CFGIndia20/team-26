<?php

namespace App\Http\Controllers;

use App\Centre;
use App\Helper\ResponseHelper;
use App\Question;
use App\QuestionResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CentreController extends Controller
{
    public function getAllCentres()
    {
        return ResponseHelper::success(Centre::all());
    }

    public function getRatingAccordingToCentre($centre_id)
    {
        $centre = Centre::find($centre_id);
        if ($centre) {
            $centre_obj = DB::select("SELECT AVG(question_responses.rating) as avg, centres.id from question_responses INNER JOIN patients on patients.id= question_responses.patient_id INNER JOIN centres on patients.centre_id= centres.id where centres.id = ".$centre_id ." GROUP BY centres.id");
            return ResponseHelper::success($centre_obj);
        } else {
            return  ResponseHelper::badRequest();
        }
    }
}
