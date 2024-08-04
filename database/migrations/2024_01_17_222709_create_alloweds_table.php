<?php

use App\Models\Allowed;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('alloweds', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->foreignId('announcement_id')->constrained()->cascadeOnDelete();
      $table->timestamps();
    });

    Allowed::insert([
      [
        'user_id' => 1,
        'announcement_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 2,
        'announcement_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'user_id' => 3,
        'announcement_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('alloweds');
  }
};
