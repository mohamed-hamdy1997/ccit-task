<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        $data = $request->validated();
        $admin = User::query()
            ->admin()
            ->whereEmail($data['email'])
            ->get()
            ->first();

        if ($admin) {
            if (!Hash::check($data['password'], $admin->password)) {
                return redirect()->route('admin.login')->with('error', "Invalid credentials.");
            }
        } else {
            return redirect()->route('admin.login')->with('error', "Invalid credentials.");
        }
        Auth::login($admin);

        return redirect()->route('admin.getAllUsers');
    }

    public function logout()
    {
        \auth()->logout();

        return redirect()->route('admin.login');
    }
}
