<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class InchargeController extends Controller {
  public function index() {
    $announcements = Announcement::paginate(5);
    return view('incharge.index', compact('announcements'));
  }

  public function show(Announcement $announcement) {
    $announcement->update([
      'view' => $announcement->view + 1,
    ]);
    return view('incharge.content', compact('announcement'));
  }
}
