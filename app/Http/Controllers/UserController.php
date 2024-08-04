<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  public function register() {
    $validated = request()->validate([
      'image' => 'image|nullable',
      'first_name' => 'required',
      'last_name' => 'required',
      'gender' => 'required',
      'email' => 'required|email|unique:users,email',
      'contact_number' => 'required|digits:11',
      'password' => 'required',
    ]);
    $validated['user_type'] = 'user';
    if (request()->has('incharge')) {
      $validated['user_type'] = 'incharge';
    }
    // dd($validated);
    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;
    }

    User::create($validated);

    if (auth()->check()) {
      if (request()->has('incharge')) {
        return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'incharge added');
      }
      return redirect()->route('users.index', ['user_type' => 'user'])->with('success', 'user added');
    } else {
      return redirect()->route('index')->with('success', 'user registered');
    }
  }

  public function show(User $user) {
    if (auth()->user()->user_type === 'user') {
      return view('client.profile', compact('user'));
    } else if (auth()->user()->user_type === 'incharge') {
      return view('incharge.profile', compact('user'));
    } else if (auth()->user()->user_type === 'admin') {
      return view('admin.profile', compact('user'));
    }
  }

  public function update(User $user) {
    $validated = request()->validate([
      'image' => 'image|nullable',
      'first_name' => 'required',
      'last_name' => 'required',
      'gender' => 'required',
      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($user->id),
      ],
      'contact_number' => 'required',
    ]);

    if (request()->get('password') !== null) {
      $validated['password'] = request()->get('password');
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('profile'), $imagePath);
      $validated['image'] = $imagePath;

      if ($user->image) {
        $existingImagePath = public_path('profile') . '/' . $user->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $user->update($validated);

    if (request()->has('profile')) {
      return redirect()->route('users.show', $user->id)->with('success', 'profile updated');
    }
    if (request()->has('incharge')) {
      return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'incharge updated');
    }
    return redirect()->route('users.index', ['user_type' => 'user'])->with('success', 'user updated');
  }

  public function index() {
    $page = request('user_type');

    if ($page === 'incharge') {
      $users = User::where('user_type', 'incharge')->orderBy('id', 'ASC')->paginate(5);
      return view('admin.incharge-page', compact('users', 'page'));
    }

    $users = User::where('user_type', 'user')->orderBy('id', 'ASC')->paginate(5);
    if (auth()->user()->user_type === 'incharge') {
      return view('incharge.user-page', compact('users'));
    } else if (auth()->user()->user_type === 'admin') {
      return view('admin.user-page', compact('users'));
    }
  }

  public function destroy(User $user) {
    $user->delete();

    if ($user->image) {
      $existingImagePath = public_path('profile') . '/' . $user->image;
      if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
      }
    }

    if (request()->has('incharge')) {
      return redirect()->route('users.index', ['user_type' => 'incharge'])->with('success', 'incharge deleted');
    }
    return redirect()->route('users.index', ['user_type' => 'user'])->with('success', 'user deleted');
  }
}
