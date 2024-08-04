<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller {
  public function authenticate() {
    $validated = request()->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (auth()->attempt($validated)) {
      request()->session()->regenerate();

      if (auth()->user()->user_type === 'user') {
        return redirect()->route('clients.index')->with('success', 'User logged in!');
      } else if (auth()->user()->user_type === 'incharge') {
        return redirect()->route('incharges.index')->with('success', 'User logged in!');
      } else if (auth()->user()->user_type === 'admin') {
        return redirect()->route('admins.index')->with('success', 'User logged in!');
      }
    } else {
      return redirect()->route('index')->with('failed', 'Invalid email or password');
    }
  }

  public function logout() {
    auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('index')->with('success', 'Logged out successfully');
  }
}
