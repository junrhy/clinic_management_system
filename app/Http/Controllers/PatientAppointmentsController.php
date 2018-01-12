<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientAppointmentsController extends Controller
{
    public function index()
    {
        return view('report.appointments.index');
    }
}
