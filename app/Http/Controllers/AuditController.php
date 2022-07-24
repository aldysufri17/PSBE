<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditController extends Controller
{
    //Audit Air
    public function indexAir()
    {
        return view('backend.audit.audit_air.index');
    }


    //Audit Energi
    public function indexEnergi()
    {
        return view('backend.audit.audit_energi.index');
    }
}
