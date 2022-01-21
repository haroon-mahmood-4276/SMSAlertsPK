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
        'card_number',
        'active',
    ];

    public function getMembersWithGroups($request, $limit)
    {
        return $this->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
            ->leftJoin('sections', 'mobiledatas.section_id', '=', 'sections.id')
            ->select('mobiledatas.*', 'groups.name AS group_name', 'sections.name AS section_name')
            ->where('mobiledatas.user_id', '=', session('Data.id'))
            ->when($request->group_id, function ($query, $groupid) {
                return $query->where('mobiledatas.group_id', $groupid);
            })
            ->paginate($limit);
    }

    public function storeMobileData($request)
    {
        dd($request);
        $data = [
            'group_id' => filter_strip_tags($request['group']),
            'section_id' => filter_strip_tags($request['section']),
            'user_id' => filter_strip_tags(session('Data.id')),
            'code' => filter_strip_tags($request['code']),
            'student_first_name' => filter_strip_tags($request['student_first_name']),
            'student_last_name' => filter_strip_tags($request['student_last_name']),
            'dob' => filter_strip_tags($request['dob']),
            'gender' => filter_strip_tags($request['gender']),
            'parent_first_name' => filter_strip_tags($request['parent_first_name'] ?? ''),
            'parent_last_name' => filter_strip_tags($request['parent_last_name'] ?? ''),
            'student_mobile_1' => filter_strip_tags($request['student_mobile_1']),
            'student_mobile_2' => filter_strip_tags($request['student_mobile_2']),
            'parent_mobile_1' => filter_strip_tags($request['parent_mobile_1'] ?? ''),
            'parent_mobile_2' => filter_strip_tags($request['parent_mobile_2'] ?? ''),
            'active' => filter_strip_tags($request['active']),
        ];

        return $this->create($data);
    }
}
