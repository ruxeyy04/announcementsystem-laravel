<?php

namespace App\Http\Controllers;

use App\Models\Allowed;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller {
  public function show(Announcement $announcement) {
    return view('guest.content', compact('announcement'));
  }

  public function index() {
    $user_id = auth()->id();
    $announcements = Announcement::orderBy("created_at", "DESC")->paginate(5);
    $users = User::get();
    if (auth()->user()->user_type === 'incharge') {
      return view('incharge.announcement', compact('announcements', 'users'));
    } else if (auth()->user()->user_type === 'admin') {
      return view('admin.announcement', compact('announcements', 'users'));
    }
  }

  public function store() {
    // dd(request()->all());
    $validated = request()->validate([
      'image' => 'image|nullable',
      'title' => 'required',
      'description' => 'required',
    ]);
    $val = request()->validate([
      'users_id' => 'array',
    ]);
    $validated['user_id'] = auth()->id();

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('announcement'), $imagePath);
      $validated['image'] = $imagePath;
    }

    $announcement = Announcement::create($validated);

    if (isset($val['users_id']) && is_array($val['users_id'])) {
      foreach ($val['users_id'] as $userId) {
        Allowed::create([
          'announcement_id' => $announcement->id,
          'user_id' => $userId,
        ]);
      }
    }

    return redirect()->route('announcements.index')->with('success', 'announcement posted');
  }

  public function update(Announcement $announcement) {
    // dd(request()->all());
    $validated = request()->validate([
      'image' => 'image|nullable',
      'title' => 'required',
      'description' => 'required',
    ]);

    $val = request()->validate([
      'users_id' => 'array',
    ]);

    $announcement->alloweds()->delete();

    if (isset($val['users_id']) && is_array($val['users_id'])) {
      foreach ($val['users_id'] as $userId) {
        Allowed::create([
          'announcement_id' => $announcement->id,
          'user_id' => $userId,
        ]);
      }
    }

    if (request()->hasFile('image')) {
      $image = request()->file('image');
      $imagePath = time() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('announcement'), $imagePath);
      $validated['image'] = $imagePath;

      if ($announcement->image) {
        $existingImagePath = public_path('announcement') . '/' . $announcement->image;
        if (file_exists($existingImagePath)) {
          unlink($existingImagePath);
        }
      }
    }

    $announcement->update($validated);

    return redirect()->route('announcements.index')->with('success', 'announcement updated');
  }

  public function destroy(Announcement $announcement) {
    $announcement->delete();

    if ($announcement->image) {
      $existingImagePath = public_path('announcement') . '/' . $announcement->image;
      if (file_exists($existingImagePath)) {
        unlink($existingImagePath);
      }
    }
    return redirect()->route('announcements.index')->with('success', 'announcement deleted');
  }
}
