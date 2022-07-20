<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_a_id')->constrained('users');
            $table->foreignIdFor(User::class, 'user_b_id')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pairs');
    }
};
