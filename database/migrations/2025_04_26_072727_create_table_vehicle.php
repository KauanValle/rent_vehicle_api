<?php

use App\Models\Vehicle;
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
        Schema::create(Vehicle::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Vehicle::MAKE);
            $table->string(Vehicle::MODEL);
            $table->string(Vehicle::PLATE);
            $table->string(Vehicle::DAILY_RATE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Vehicle::TABLE);
    }
};
