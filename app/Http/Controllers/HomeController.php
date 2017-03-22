<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace Manelgavalda\EnrollmentMobileTest\Http\Controllers;

use Manelgavalda\EnrollmentMobileTest\Http\Requests;
use Manelgavalda\EnrollmentMobileTest\User;
use Illuminate\Http\Request;
use Mail;

/**
 * Class HomeController
 * @package Manelgavalda\EnrollmentMobileTest\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('adminlte::home');
    }
  public function mail()
  {
    $user = User::find(1)->toArray();
    Mail::send('emails.mailEvent', $user, function($message) use ($user) {
      $message->to($user->email);
      $message->subject('Mailgun Testing');
    });
    dd('Mail Send Successfully');
  }
}