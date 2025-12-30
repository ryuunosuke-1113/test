<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->foreignId('user_id')->nullable()->after('id');
        // sqliteでは constrained() が絡むと面倒なので一旦外す
    });
}

public function down(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}  
};
