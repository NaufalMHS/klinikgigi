<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class VerifyRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        $userRole = $user->role; // Mengambil peran pengguna

        if (in_array($userRole, $roles)) {
            // Peran pengguna valid, lanjutkan permintaan
            return $next($request);
        } else {

            // Redirect ke halaman login atau berikan respons sesuai kebutuhan Anda
            return redirect('/');
        }
    }
}
