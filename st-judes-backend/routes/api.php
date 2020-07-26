<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * Done
 */
Route::get('/donor/unverified', 'DonorController@getVerifiedDonor');
Route::post('/donor/updateVerificationStatus', 'DonorController@changeDonorVerification');
Route::get('/unit/{unit_id}/review', 'UnitController@getRatingAccordingToUnit');
Route::get('/centre/{centre_id}/review', 'CentreController@getRatingAccordingToCentre');
Route::get('donor/all','DonorController@getAllDonors');
Route::get('unit/all','UnitController@getAllUnits');
Route::get('centre/all','CentreController@getAllCentres');
Route::get('/questions', 'QuestionController@getAll');
Route::get('/contribution/centre/{donor_id}', 'ContributionController@getContribution');
Route::get('/contribution/unit/{donor_id}', 'ContributionController@getContribution');
Route::get('report/insights', 'DonorController@getDonorReport');
Route::get('donor/{phone_number}', 'DonorController@getDonorByPhoneNumber');
Route::get('/contribution/all','ContributionController@getAllContribution');
Route::get('patient/strength', 'PatientController@getStrengthNumber');
Route::get('/question', "QuestionController@getAllQuestion");
Route::post('/question-response', "QuestionController@postAllQuestionResponse");
Route::get('contribution/donor/all', 'ContributionController@getAllUserContribution');
Route::post('/contribution/{contribution_id}/comment', 'ContributionController@postAdminFeedback');

Route::post('/question/update', 'QuestionController@updateQuestion');
