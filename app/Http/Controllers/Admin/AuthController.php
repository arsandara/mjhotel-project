<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session\TokenMismatchException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            // Manual check dengan field custom
            $admin = Admin::where('admin_username', $request->username)->first();

            if ($admin && Hash::check($request->password, $admin->admin_password)) {
                // Login manual
                Auth::guard('admin')->login($admin);
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }

            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ])->onlyInput('username');

        } catch (TokenMismatchException $e) {
            // Handle CSRF token mismatch (419 error)
            return redirect()->route('admin.login')
                ->with('error', 'Session Anda telah berakhir. Silakan login kembali.')
                ->withInput($request->only('username'));
                
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput($request->only('username'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/admin/login')->with('success', 'Anda telah berhasil logout.');
    }
}