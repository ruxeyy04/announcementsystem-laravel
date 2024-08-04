<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
  use AuthorizesRequests, ValidatesRequests;

  public function index() {
    $announcements = Announcement::paginate(5);
    return view('guest.index', compact('announcements'));
  }
}
