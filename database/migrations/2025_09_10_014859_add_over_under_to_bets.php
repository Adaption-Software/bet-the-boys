<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('bets', 'over_under')) {
            Schema::table('bets', function (Blueprint $table) {
                $table->decimal('over_under')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('bets', 'over_under')) {
            Schema::table('bets', function (Blueprint $table) {
                $table->dropColumn('over_under');
            });
        }
    }
};
