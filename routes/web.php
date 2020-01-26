<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * TODO: I focused on the other parts of the software, that's why i put his select here.
 * I just wanted to show the results. In a real application i would never put it here.
 */

use App\Models\Transaction;

Route::get('/', function () {
    $transactions = Transaction::where('is_processed', '=', true)
        ->orderBy('created_at', 'DESC')
        ->get();

    return view('dashboard', [
        'transactions' => $transactions
    ]);
});
