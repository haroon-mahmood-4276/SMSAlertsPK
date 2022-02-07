<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\{Session};
use Illuminate\Notifications\Notifiable;

/**
 * @method static select( string $string, string $string1 )
 */
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

    public function getAllWithPaginate( $limit )
    {
        return $this->where('user_id', '=', session('Data.id'))->orderBy('code', 'DESC')->paginate($limit);
    }

    public function checkCode( $code )
    {
        return $this->where([
            'user_id' => session('Data.id'),
            'code' => $code
        ])->exists();
    }

    public function storeGroup( $request )
    {
        // dd($request);
        $data = [
            'user_id' => filter_strip_tags(Session::get('Data.id')),
            'code' => filter_strip_tags($request[ 'code' ]),
            'name' => filter_strip_tags($request[ 'name' ]),
        ];
        return $this->create($data);
    }

    public function deleteAllGroups()
    {
        return $this->where('user_id', '=', session('Data.id'))->delete();
    }
}
