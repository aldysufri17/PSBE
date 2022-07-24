<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAdmin()
    {
        return view('backend.dashboard');
    }

    public function indexPengguna()
    {
        return view('frontend.home');
    }

    public function profile()
    {
        if (Auth::user()->role_id == 1) {
            return view('backend.profile');
        }
        return view('frontend.profile');
    }

    public function updateProfile(Request $request, User $user)
    {
        #Validations
        $request->validate([
            'name'    => 'required',
            'email'         => 'required|unique:users,email,' . $user->id . ',id',
        ]);

        #Update Profile Data
        $user = User::whereId(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($user) {
            return back()->with('success', 'Profile Berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'User Gagal ditambah!.');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        #Update Password
        $user = User::find(auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
        if ($user) {
            return back()->with('success', 'Profile Berhasil diubah.');
        } else {
            return redirect()->back()->with('error', 'User Gagal ditambah!.');
        }
    }

    public function updateFoto(Request $request, User $user)
    {
        $user_id = Auth::user()->id;
        if ($request->foto) {
            $usercek = User::whereid($user_id)->first();
            if (file_exists(public_path() . '/images/profil/' . $usercek->foto)) {
                unlink(public_path() . '/images/profil/' . $usercek->foto);
            }
            $foto = $request->foto;
            $new_foto = Auth::user()->name . "-" . Auth::user()->nim . "." . $foto->getClientOriginalExtension();
            $destination = 'images/profil/';
            $foto->move($destination, $new_foto);
            // Store Data
            $user_updated = User::whereId($user_id)->update([
                'foto'          => $new_foto,
            ]);
        }
        if ($user_updated) {
            return redirect()->back()->with('success', 'Foto Berhasil diperbarui!.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Foto Gagal diperbarui!.');
        }
    }
}
