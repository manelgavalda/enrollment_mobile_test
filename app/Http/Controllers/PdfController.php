<?php

namespace Manelgavalda\EnrollmentMobileTest\Http\Controllers;

use App;
use Cache;
use Illuminate\Http\Request;
use Scool\EnrollmentMobile\Models\Enrollment;
use View;

/**
 * Class PdfController
 * @package Manelgavalda\EnrollmentMobileTest\Http\Controllers
 */
class PdfController extends Controller
{
    public function enrollment()
    {
        return 'todo';
    }

    public function enrollments()
    {
        $enrollments = Enrollment::all();
        $pdf = App::make('dompdf.wrapper');
        $view = View::make('pdf.enrollments')->with('enrollments', $enrollments)->render();
        $pdf->loadHTML($view);
        return $pdf->stream('enrollments');
    }

    public function enrollments_view()
    {
        Cache::put('enrollments',Enrollment::all(), 5);
        return view('pdf.enrollments')->with('enrollments', Cache::get('enrollments'));
    }

}
