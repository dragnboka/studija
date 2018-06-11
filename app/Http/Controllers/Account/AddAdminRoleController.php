<?php

namespace App\Http\Controllers\Account;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddAdminRoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        $users = User::where('admin', '<>', 1)->get();

        return view('account.admin.index', compact('users'));
    }
    
    public function update(User $user)
    {
        $this->authorize('admin');
        $user->admin = 1;
        $user->save();

        return back()->withFlash("You made $user->ime an admin.");
    }
}
