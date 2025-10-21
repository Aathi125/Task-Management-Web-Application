<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Add an 'enum' status column with default value
            $table->enum('status', ['Pending', 'In-Progress', 'Completed'])->default('Pending')->after('deadline');
            // Assigned user
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Drop the 'status' column if rollback is performed
            $table->dropColumn('status');
        });
    }
};
