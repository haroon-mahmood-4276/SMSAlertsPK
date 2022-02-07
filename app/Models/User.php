<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @method where( string $string, \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed $session )
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'remaining_of_sms'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];

    public function getAll($request)
    {
        try {
            return $this->where('company_nature', '!=', 'A')
                ->when($request->user_type, function ($query, $user_type) {
                    return $query->where('company_nature', '=', $user_type);
                })
                ->get();
        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function getAllWithPagination($request)
    {
        try {
            return $this->where('company_nature', '!=', 'A')
                ->when($request->user_type, function ($query) use ($request) {
                    return $query->where('company_nature', '=', $request->user_type);
                })
                ->paginate(50);
        } catch (Exception $ex) {
            return $ex;
        }
    }
}
