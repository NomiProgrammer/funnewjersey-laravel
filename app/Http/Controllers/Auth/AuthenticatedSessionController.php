<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
class AuthenticatedSessionController extends Controller
{
  /**
   * Display the login view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    return view('auth.login');
  }

  /**
   * Handle an incoming authentication request.
   *
   * @param  \App\Http\Requests\Auth\LoginRequest  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(LoginRequest $request)
  {
      // First, get the user by email
      $user = \App\Models\User::where('user_email', $request->user_email)->first();

      // Check if user exists and is blacklist
      if ($user && $user->status === 'blacklist') {
          return redirect()->back()
              ->with('error', 'Your account is blocked. Please contact support.')
              ->withInput();
      }

      // Try to log in
      if (!Auth::attempt($request->only('user_email', 'password'), $request->filled('remember'))) {
          return redirect()->back()
              ->with('error', 'Invalid email or password')
              ->withInput();
      }

      // Regenerate session
      $request->session()->regenerate();

      // Get logged-in user
      $user = Auth::user();

      // Redirect based on user level
      if ($user->level() === 2) {
          return redirect()->intended('/en/admin')->with('success', 'Welcome to the Admin Dashboard!');
      } elseif ($user->level() === 3) {
          return redirect()->intended('/user_dashboard')->with('success', 'Welcome to your Dashboard!');
      } else {
          return redirect()->intended('/user_dashboard')->with('success', 'Login Successful!');
      }
  }





  /**
   * Destroy an authenticated session.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login', app()->getLocale());
  }
}
