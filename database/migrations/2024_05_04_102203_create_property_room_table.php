<?php

declare(strict_types=1);

use App\Models\Property;
use App\Models\Room;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('property_room', static function (Blueprint $table) {
            $table->foreignIdFor(Property::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Room::class)
                ->constrained()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_room');
    }
};
