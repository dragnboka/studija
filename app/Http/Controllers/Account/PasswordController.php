<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordStoreRequest;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        return view('account.password.index');
    }

    public function store(PasswordStoreRequest $request)
    {
        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('home')->withFlash('Password updated.');
    }
}
