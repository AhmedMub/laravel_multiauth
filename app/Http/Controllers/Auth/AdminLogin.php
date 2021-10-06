<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Controller
{

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminCheck(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required|min:3',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(route('admin.home'));
        }
        return back()->withInput($request->only('username', 'remember'));
    }

    public function logout()
    {

        Auth::guard('admin')->logout();

        return redirect(route('user.home'));
    }
}
