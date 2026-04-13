<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private const ROLE_REDIRECTS = [
        'admin'   => '/',
        'teacher' => '/teacher/dashboard',
        'student' => '/student/dashboard',
        'parent'  => '/parent/dashboard',
    ];

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials, $request->boolean('remember'))) {

            $user = auth()->user();

            $request->session()->regenerate();

            return redirect()->intended($this->redirectPathFor($user));

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    private function redirectPathFor($user)
    {
        foreach (self::ROLE_REDIRECTS as $role => $path) {
            if ($user->hasRole($role)) {
                return $path;
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
