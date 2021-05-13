<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('is_admin',0)->latest()->paginate(10);
        return view('Admin.user.index',compact('user'));
    }
}
