<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::all()
        ]);
    }

    public function update($id)
    {
        $user = User::find($id);
        if ($user->status == 0) {

            $user->update([
                'status' => 1
            ]);
            return back()->with('flash', 'User Activated Successfully');
        } else {
            $user->update([
                'status' => 0
            ]);
            return back()->with('flash', 'User Deactivated Successfully');
        }
    }
}
