<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::all();
        return view('backend.audit.index', compact('audits'));
    }
    public function create()
    {
        return view('backend.audit.add');
    }
    public function store(Request $request)
    {

        #Validations
        $request->validate([
            'pertanyaan'    => 'required',
            'jawaban'         => 'required',
        ]);

        $items = array();
        foreach ($request->jawaban as $key => $value) {
            $items[] = array(
                'jawaban' => $value,
                'parameter' => $request->parameter[$key],
            );
        }

        $jawaban = json_encode($items);
        $audit = Audit::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $jawaban
        ]);
        if ($audit) {
            return redirect()->route('audit.index')->with('success', 'Audit Berhasil ditambah.');
        } else {
            return redirect()->back()->with('error', 'Audit Gagal ditambah!.');
        }
    }
}
