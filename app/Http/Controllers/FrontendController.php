<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Hasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function inputAudit()
    {
        $audits = Audit::all();
        $hasil = Hasil::where('user_id', Auth::user()->id)->first();
        return view('frontend.input-audit', compact('audits', 'hasil'));
    }
}
