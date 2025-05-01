<?php

use App\Models\Customer;
use App\Models\Rental;
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
        Schema::create(Rental::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Rental::VEHICLE_ID);
            $table->unsignedBigInteger(Rental::CUSTOMER_ID);
            $table->date(Rental::START_DATE)->default(null)->nullable();
            $table->date(Rental::END_DATE)->default(null)->nullable();
            $table->decimal(Rental::TOTAL_AMOUNT, 10, 2)->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(Rental::VEHICLE_ID)->references('id')->on(Vehicle::TABLE)->onDelete('cascade');
            $table->foreign(Rental::CUSTOMER_ID)->references('id')->on(Customer::TABLE)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Rental::TABLE);
    }
};
