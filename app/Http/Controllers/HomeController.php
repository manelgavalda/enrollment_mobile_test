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
        $data = [];

        $data['labels1'] = "['January', 'February', 'March', 'April', 'May', 'June', 'July']";
        $data['values1'] = "[10, 42, 4, 23, 43, 54]";

        $data['labels2'] = "['January', 'February', 'March', 'April', 'May', 'June', 'July']";
        $data['values2'] = "[10, 42, 4, 23, 43, 54]";
        return view('enrollment_mobile::dashboard.dashboard', $data);
    }
  public function mail()
  {
    $user = User::find(1)->toArray();
    Mail::send('emails.mailEvent', $user, function($message) use ($user) {
      $message->to($user->email);
      $message->subject('Mailgun Testing');
    });
//    dd('Mail Send Successfully');
  }
}