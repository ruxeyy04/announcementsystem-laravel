<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {
  use HasFactory;

  protected $guarded = ['id', 'created_at', 'updated_at'];

  public function announcementImage() {
    if ($this->image) {
      return url('announcement/' . $this->image);;
    }
    return url('announcement/default_announcement.png');;
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function comments() {
    return $this->hasMany(Comment::class);
  }

  public function alloweds() {
    return $this->hasMany(Allowed::class);
  }
}
