<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;

    public const TABLE = 'vehicle';

    public const PLATE = 'plate';
    public const MAKE = 'make';
    public const MODEL = 'model';
    public const DAILY_RATE = 'daily_rate';

    protected $table = self::TABLE;
    protected $fillable = [
        self::PLATE,
        self::MAKE,
        self::MODEL,
        self::DAILY_RATE,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
