<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function editUser()
    {
        $user = auth()->user();

        return view('editUser', compact('user'));
    }

    protected function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name'=>'required',
            'email'=> 'required',
            'password' => 'required | min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // sifrovanje lozinke
        $user->update();

        return redirect()->back()->with('message','Korisnik je uspesno promenio podatke');
    }



}
