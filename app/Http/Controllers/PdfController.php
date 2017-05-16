<?php

namespace Manelgavalda\EnrollmentMobileTest\Http\Controllers;

use App;
use Illuminate\Http\Request;

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
        $pdf->loadHTML('<h1>Hello World</h1>');
        return $pdf->stream();
    }
}
