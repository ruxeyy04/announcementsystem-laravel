<?php

use App\Models\Announcement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('announcements', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->string('title');
      $table->string('description');
      $table->integer('view')->default(0);
      $table->string('image')->nullable();
      $table->timestamps();
    });

    Announcement::insert([
      [
        'user_id' => 3,
        'title' => 'Important',
        'description' => 'This is an important announcement',
        'image' => null,
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('announcements');
  }
};
