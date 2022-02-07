<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

/**
 * @method create( array $data )
 * @method where( string $string, string $string1, Application|SessionManager|Store|mixed $session )
 * @method find( int $id )
 * @method whereIn( string $string, array|mixed $template_ids )
 */
class Template extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'template',
    ];

    public function getAll()
    {
        return $this->where('user_id', '=', session('Data.id'))->get();
    }

    public function storeTemplate( $input )
    {
        $data = [
            'user_id' => filter_strip_tags(Session::get('Data.id')),
            'name' => filter_strip_tags($input[ 'name' ]),
            'template' => filter_strip_tags($input[ 'template' ]),
        ];

        return $this->create($data);
    }

    public function updateTemplate( $input, $id )
    {
        $data = [
            'name' => filter_strip_tags($input[ 'name' ]),
            'template' => filter_strip_tags($input[ 'template' ]),
        ];

        return $this->where('id', decryptParams($id))->update($data);
    }

    public function deleteAllTemplates()
    {
        return $this->where('user_id', '=', session('Data.id'))->delete();
    }
}
