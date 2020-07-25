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

Route::get('/donor/unverified', 'DonorController@getVerifiedDonor');

Route::post('/donor/updateVerificationStatus', 'DonorController@changeDonorVerification');

Route::post('/centre/{unit_id}/review', 'CentreController@getUnitReview');

Route::post('/centre/{centre_id}/review', 'CentreController@getCentreReview');

Route::get('/contribution', 'ContributionController@getContribution');

Route::post('/contribution/comment', 'ContributionController@postComment');

Route::get('/reports/contribution', 'ContributionController@getAllContribution');

Route::get('/questions', 'QuestionController@getAll');
