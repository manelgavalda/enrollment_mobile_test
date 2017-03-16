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

Route::get('/', function () {
    return view('welcome');
});

//Mailgun with sandbox domain
Route::get('mail', 'HomeController@mail');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/profile/tokens', function () {
        return view('tokens');
    });
    #adminlte_routes






//Route::get('/test', function () {
//    $study = new Study();
//    dd($study);

//Route::resource('enrollments', 'EnrollmentsController');
//    Stats::of(Scool\EnrollmentMobile\Models\Enrollment::class);
//    return Stats::total();

});

