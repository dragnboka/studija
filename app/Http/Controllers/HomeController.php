<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Account\ProfileStoreRequest;

class HomeController extends Controller
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
        return view('account.index');
    }
    
    public function store(ProfileStoreRequest $request)
    {
        $request->user()->update($request->only('ime','prezime', 'email'));

        return back()->withFlash('Profile details updated.');
    }
}
