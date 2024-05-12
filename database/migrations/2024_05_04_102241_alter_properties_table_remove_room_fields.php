<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropColumns('properties', [
            'bedrooms',
            'bathrooms',
            'garages',
        ]);
    }

    public function down(): void
    {
        Schema::table('properties', static function (Blueprint $table) {
            $table->unsignedTinyInteger('bedrooms')->default(0);
            $table->unsignedTinyInteger('bathrooms')->default(0);
            $table->unsignedTinyInteger('garages')->default(0);
        });
    }
};
