<?php

namespace Manelgavalda\EnrollmentMobileTest\Http\Controllers;

use App;
use Illuminate\Http\Request;
use View;

/**
 * Class PdfController
 * @package Manelgavalda\EnrollmentMobileTest\Http\Controllers
 */
class PdfController extends Controller
{
    public function enrollments()
    {
        return 'todo';
    }

    public function enrollment()
    {
        $pdf = App::make('dompdf.wrapper');
        $view = View::make('pdf.enrollments')->render();
        $pdf->loadHTML($view);
        return $pdf->stream('enrollments');
    }

    public function enrollments_view()
    {
        return view('pdf.enrollments');
    }

}
