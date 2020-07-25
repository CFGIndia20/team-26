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

/**
 * Todo
 */
Route::get('/contribution/{user_id}', 'ContributionController@getContribution');
Route::post('/contribution/comment', 'ContributionController@postComment');
Route::get('/reports/contribution', 'ContributionController@getAllContribution');
