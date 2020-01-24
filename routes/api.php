<?php

use Illuminate\Http\Request;

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

// Mocked endpoints for the banks (Brazilian and Irish bank).
Route::post('brazilian-bank/make-transfer', function () {
    return response([
        'numero_confirmacao' => rand(23231, 323123232),
        'data_processamento' => (new \DateTime)->format('Y-m-d')
    ], 202);
});

Route::post('irish-bank/make-transfer', function () {
    return response([
        'confirmation_number' => rand(23231, 323123232),
        'date' => (new \DateTime)->format('Y-m-d')
    ], 202);
});
