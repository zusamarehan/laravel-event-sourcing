<?php

use Illuminate\Support\Facades\Route;

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

// Trying out Sync in Event & Listeners
Route::get('sync', function() {
   event(new \App\Events\SyncEvent());
});

Route::apiResource('project', 'ProjectController');

Route::get('/', function () {
    return view('welcome');
});
