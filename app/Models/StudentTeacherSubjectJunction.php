<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTeacherSubjectJunction extends Model
{
    use HasFactory;
    protected $table = "student_teacher_subject_junction";

    protected $fillable = [
        'user_id',
        'teacher_id',
        'mobiledata_id',
        'subject_id',
    ];
}
