<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {
  public function store() {
    $validated = request()->validate([
      'comment' => 'required'
    ]);

    $validated['user_id'] = auth()->id();
    $validated['announcement_id'] = request()->get('announcement_id');

    Comment::create($validated);

    $announcement = Announcement::find(request()->get('announcement_id'));

    if (auth()->user()->user_type === 'user') {
      return redirect()->route('clients.announcements.show', compact('announcement'))->with('success', 'comment posted');
    } else if (auth()->user()->user_type === 'incharge') {
      return redirect()->route('incharges.announcements.show', compact('announcement'))->with('success', 'comment posted');
    } else if (auth()->user()->user_type === 'admin') {
      return redirect()->route('admins.announcements.show', compact('announcement'))->with('success', 'comment posted');
    }
  }
}
