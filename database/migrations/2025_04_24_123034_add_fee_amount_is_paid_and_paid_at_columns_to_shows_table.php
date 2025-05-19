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
        Schema::table('shows', function (Blueprint $table) {
            $table->decimal('fee_amount', 10, 2)->nullable();
            $table->boolean('is_paid')->default(false)->after('fee_amount');
            $table->timestamp('paid_at')->nullable()->after('is_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shows', function (Blueprint $table) {
            $table->dropColumn('fee_amount');
            $table->dropColumn('is_paid');
            $table->dropColumn('paid_at');
        });
    }
};
