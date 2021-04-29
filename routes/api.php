<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\MailerApiController;
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

Route::post('/emails/send', [MailerApiController::class, 'send']);
Route::get('/emails/{emailId}', [MailerApiController::class, 'checkStatus']);
