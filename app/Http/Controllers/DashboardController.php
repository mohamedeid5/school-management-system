<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function redirect()
    {
        $user = auth()->user();
        if ($user->hasRole('admin'))   return redirect()->route('admin.dashboard');
        if ($user->hasRole('teacher')) return redirect()->route('teacher.dashboard');
        if ($user->hasRole('parent'))  return redirect()->route('parent.dashboard');
        if ($user->hasRole('student')) return redirect()->route('student.dashboard');
        abort(403);
    }
}
