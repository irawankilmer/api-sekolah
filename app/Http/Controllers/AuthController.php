<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
      $type     = filter_var($request->input('umail'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      $remember = $request->has('remember') ? true : false;

      if (Auth::attempt([$type => $request->input('umail'), 'password' => $request->input('password')], $remember)) {
        $request->session()->regenerate();

        return redirect()->intended('/sys')->with('success', 'Selamat Datang Kembali!!!');
      }

      return back()->withErrors([
          'umail' => 'Username/Email atau Password salah!'
      ])->onlyInput('umail');
    }
}
