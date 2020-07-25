<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAll() {
        return ResponseHelper::success(Question::all());
    }
}
