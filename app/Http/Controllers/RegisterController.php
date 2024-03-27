<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('reset');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak cocok.');
        }
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        // $user->password = Hash::make($request->new_password);
            // $user->save();
        // return $user;
        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
