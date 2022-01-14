<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'code',
        'name',
    ];

    public function getAll()
    {
        return $this->where('user_id', '=', session('Data.id'))->get();
    }

    public function checkCode($code)
    {
        return $this->where([
            'user_id' => session('Data.id'),
            'code' => $code
        ])->exists();
    }
}
