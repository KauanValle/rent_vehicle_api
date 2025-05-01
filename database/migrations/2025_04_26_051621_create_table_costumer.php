<?php

use App\Models\Customer;
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
        Schema::create(Customer::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(Customer::NAME);
            $table->string(Customer::EMAIL)->unique();
            $table->string(Customer::PHONE);
            $table->string(Customer::CNH);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Customer::TABLE);
    }
};
