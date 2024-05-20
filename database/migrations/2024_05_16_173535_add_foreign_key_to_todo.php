<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('todos', function (Blueprint $table) {
            $table->foreignId('list_id')->nullable()
                ->constrained()->onDelete('set null');
        });
    }


    public function down(): void {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['list_id']);
        });
    }
};
