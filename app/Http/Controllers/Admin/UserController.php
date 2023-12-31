<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        $users = User::query()->user()->get();

        return view('admin.users.index', compact('users'));
    }

    public function deleteUser($userId)
    {
        $user = User::query()->user()->find($userId);
        $user->delete();

        return returnResponse([], 'Deleted successfully');
    }
}
