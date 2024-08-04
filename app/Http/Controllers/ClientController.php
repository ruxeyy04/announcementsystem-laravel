<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class ClientController extends Controller {
  public function index() {
    $announcements = Announcement::join('alloweds', 'announcements.id', '=', 'alloweds.announcement_id')
      ->where('alloweds.user_id', auth()->user()->id)
      ->paginate(5);
    // dd($announcements);
    return view('client.index', compact('announcements'));
  }

  public function show(Announcement $announcement) {
    $announcement->update([
      'view' => $announcement->view + 1,
    ]);
    return view('client.content', compact('announcement'));
  }
}
