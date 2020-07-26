<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Question;
use App\QuestionResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAll() {
        return ResponseHelper::success(Question::all());
    }

    public function getAllQuestion() {
        return ResponseHelper::success( Question::with('unit')->get());
    }

    public function postQuestionResponse(Request $request) {
        $patient = $request->input('patient');
        $questions = $request->input('question');

        foreach ($questions as $question) {
            $questionResponse = QuestionResponse::create([
                "patient_id" => $patient,
                "question_id" => $question->question_id,
                "rating" => $question->rating,
                "description" => $question->description,
            ]);
            if ($questionResponse) {
                return ResponseHelper::created($questionResponse);
            }
            return  ResponseHelper::badRequest();
        }
    }
}
