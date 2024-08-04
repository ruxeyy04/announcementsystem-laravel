<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AdminController extends Controller {
  public function index() {
    $announcements = Announcement::paginate(5);
    return view('admin.index', compact('announcements'));
  }

  public function show(Announcement $announcement) {
    $announcement->update([
      'view' => $announcement->view + 1,
    ]);
    return view('admin.content', compact('announcement'));
  }
}
