<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method create( array $data )
 */
class Sms extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sms',
        'phone_number',
        'response',
    ];
}
