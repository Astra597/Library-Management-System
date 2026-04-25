<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('book_id');
            $table->index('status');
            $table->index('borrow_date');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('book_id');
            $table->index('status');
            $table->index('reserved_date');
        });

        Schema::table('books', function (Blueprint $table) {
            $table->index('category_id');
            $table->index('available_quantity');
        });
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'book_id', 'status', 'borrow_date']);
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'book_id', 'status', 'reserved_date']);
        });

        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['category_id', 'available_quantity']);
        });
    }
};