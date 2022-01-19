<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = [
        'user_id',
        'code',
        'name',
    ];

    public function getAll()
    {
        return $this->where('user_id', '=', session('Data.id'))->orderBy('code')->get();
    }

    public function checkCode($code)
    {
        return $this->where([
            'user_id' => session('Data.id'),
            'code' => $code
        ])->exists();
    }
}
