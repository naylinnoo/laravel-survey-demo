<?php

use App\Http\Controllers\api\V1\AuthController;
use App\Http\Controllers\api\V1\FieldController;
use App\Http\Controllers\api\V1\FormController;
use App\Http\Controllers\API\V1\RegisterController;
use App\Http\Controllers\api\V1\TemplateController;
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
Route::post('login', [AuthController::class, 'login']);
Route::post('register',[RegisterController::class, 'register']);

Route::post('/submitForm',[FormController::class, 'submitForm']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('/fields',[FieldController::class, 'getFields']);
    Route::get('/custom-field/create',[FieldController::class, 'createCustomField']);

    Route::get('/templates',[TemplateController::class, 'index']);
    Route::post('/templates/create',[TemplateController::class, 'create']);

    Route::get('/surveys',[FormController::class, 'surveys']);

});
