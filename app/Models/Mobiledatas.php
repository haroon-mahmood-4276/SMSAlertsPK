<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mobiledatas extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'group_id',
        'section_id',
        'code',
        'student_first_name',
        'student_last_name',
        'student_mobile_1',
        'student_mobile_2',
        'dob',
        'cnic',
        'gender',
        'parent_first_name',
        'parent_last_name',
        'parent_mobile_1',
        'parent_mobile_2',
        'active',
    ];
}
