<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    use HasFactory, SoftDeletes;

    const TABLE = 'rental';

    const VEHICLE_ID = 'vehicle_id';
    const CUSTOMER_ID = 'customer_id';
    const START_DATE = 'start_date';
    const END_DATE = 'end_date';
    const TOTAL_AMOUNT = 'total_amount';

    protected $table = self::TABLE;
    protected $fillable = [
        self::VEHICLE_ID,
        self::CUSTOMER_ID,
        self::START_DATE,
        self::END_DATE,
        self::TOTAL_AMOUNT,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, self::VEHICLE_ID);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, self::CUSTOMER_ID);
    }
}
