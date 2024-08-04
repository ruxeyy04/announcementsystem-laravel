<?php

use App\Models\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('announcement_id')->constrained()->cascadeOnDelete();
      $table->text('comment');
      $table->timestamps();
    });

    Comment::insert([
      [
        'user_id' => 1,
        'announcement_id' => 1,
        'comment' => 'nice',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('comments');
  }
};
