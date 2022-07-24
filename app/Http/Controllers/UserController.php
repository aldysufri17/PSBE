<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::user()->id;
        $user = User::where('id', '!=', $id_user)
            ->get();
        return view('backend.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.users.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email',
            'status'        =>  'required|numeric|in:0,1',
            'role'          =>  'required|numeric',
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'role_id'       => $request->role,
            'status'        => $request->status,
            'password'      => bcrypt('password')
        ]);

        // Assign Role To User
        $user->assignRole($request->role);
        if ($user) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil ditambah!.');
        }
        return redirect()->route('pengguna.index')->with('error', 'Pengguna Gagal ditambah!.');
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
        $user = User::whereId($id)->first();
        return view('backend.users.edit', compact('user'));
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
        // Validations
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email,' . $id . ',id',
            'status'        =>  'required|numeric|in:0,1',
        ]);

        $user = User::whereId($id)->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'status'        => $request->status,
        ]);

        // Assign Role To User
        // $user->assignRole($user->role_id);
        if ($user) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil diubah!.');
        }
        return redirect()->route('pengguna.index')->with('error', 'Pengguna Gagal diubah!.');
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success
     * @author Shani Singh
     */
    public function updateStatus($user_id, $status)
    {
        // Validation
        Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);
        $user_id = decrypt($user_id);
        // Update Status
        $user = User::whereId($user_id)->update(['status' => $status]);

        // Masssage
        if ($user) {
            if ($status == 0) {
                return redirect()->route('pengguna.index')->with('info', 'Status Pengguna Inactive!.');
            }
            return redirect()->route('pengguna.index')->with('info', 'Status Pengguna Active!.');
        } else {
            return redirect()->route('pengguna.index')->with('error', 'Gagal diperbarui');
        }
    }

    public function reset(Request $request)
    {
        $id = $request->reset_id;
        User::whereId($id)->update(['password' => bcrypt('password')]);
        return redirect()->back()->with('success', 'Password Berhasil direset!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $delete = User::whereId($request->delete_id)->delete();
        if ($delete) {
            return redirect()->route('pengguna.index')->with('success', 'Pengguna Berhasil dihapus!.');
        } else {
            return redirect()->back()->with('error', 'Pengguna Gagal dihapus!.');
        }
    }
}
