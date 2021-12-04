<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Section extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'group_id',
        'code',
        'name',
    ];
    public function getAllWithPagination($page)
    {
        return $this->join('groups', 'sections.group_id', '=', 'groups.id')
            ->select('sections.id', 'sections.code', 'sections.name', 'groups.name AS group_name')
            ->groupBy('group_name', 'sections.code')
            ->where('sections.user_id', '=', session('Data.id'))
            ->paginate($page);
    }
}
