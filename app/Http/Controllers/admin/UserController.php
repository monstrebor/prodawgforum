<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $users = User::where('id', '!=', $userId)->get();

        return view('admin.users.index', compact('users'));
    }
}
