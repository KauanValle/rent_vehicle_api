<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    CONST TABLE = 'customer';

    CONST NAME = 'name';
    const EMAIL = 'email';
    const PHONE = 'phone';
    const CNH = 'cnh';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PHONE,
        self::CNH
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
