<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        if ($role) {
            return redirect()->route('role.index')->with('success', 'Role Pengguna Berhasil ditambah!.');
        }
        return redirect()->route('role.index')->with('error', 'Role Pengguna Gagal ditambah!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::whereId($id)->first();
        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $role = Role::whereId($id)->update([
            'name' => $request->name,
        ]);

        if ($role) {
            return redirect()->route('role.index')->with('success', 'Role Pengguna Berhasil ditambah!.');
        }
        return redirect()->route('role.index')->with('warning', 'Role Pengguna Gagal ditambah!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $id = $request->delete_id;
        $cekRole = User::where('role_id', $id)->get();
        if ($cekRole->IsNotEmpty()) {
            request()->session()->flash('failed', "Role gagal dihapus, Role Digunakan");
            return redirect()->route('role.index');
        }

        $role = Role::whereId($id)->delete();
        if ($role) {
            return redirect()->route('role.index')->with('success', 'Role Pengguna Berhasil ditambah!.');
        } else {
            return redirect()->route('role.index')->with('warning', 'Role Pengguna Gagal ditambah!.');
        }
    }
}
