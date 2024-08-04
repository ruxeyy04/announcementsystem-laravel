<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $guarded = ['id', 'created_at', 'updated_at'];
  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'password' => 'hashed',
  ];
  
  public function userImage() {
    if ($this->image) {
      return url('profile/' . $this->image);;
    }
    return url('profile/default_profile.jpg');;
  }

  public function comments() {
    return $this->hasMany(Comment::class)->latest();
  }

  public function announcements() {
    return $this->hasMany(Announcement::class)->latest();
  }

  public function allowed() {
    return $this->hasMany(Allowed::class);
  }
}
