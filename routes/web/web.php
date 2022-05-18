<?php
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormRequestController;
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


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        if (Gate::allows('manage-requests')) {
            return redirect()->route('form-request.index');
        }
        return redirect()->route('form-request.create');
    })->name('home');

    Route::resource('form-request', FormRequestController::class)->only(['create', 'store', 'index', 'update']);
});
