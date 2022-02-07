<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * @method static join( string $string, string $string1, string $string2, string $string3 )
 */
class Mobiledatas extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

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

    public function getById($id)
    {
        return $this->find($id);
    }

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
        $data = [
            'group_id' => isset($request['group']) ? filter_strip_tags($request['group']) : null,
            'section_id' => isset($request['section']) ? filter_strip_tags($request['section']) : null,
            'user_id' => filter_strip_tags(session('Data.id')),
            'code' => isset($request['code']) ? filter_strip_tags($request['code']) : null,
            'student_first_name' => isset($request['student_first_name']) ? filter_strip_tags($request['student_first_name']) : null,
            'student_last_name' => isset($request['student_last_name']) ? filter_strip_tags($request['student_last_name']) : null,
            'dob' => isset($request['dob']) ? filter_strip_tags($request['dob']) : null,
            'gender' => isset($request['gender']) ? filter_strip_tags($request['gender']) : null,
            'parent_first_name' => isset($request['parent_first_name']) ? filter_strip_tags($request['parent_first_name']) : null,
            'parent_last_name' => isset($request['parent_last_name']) ? filter_strip_tags($request['parent_last_name']) : null,
            'student_mobile_1' => isset($request['student_mobile_1']) ? filter_strip_tags($request['student_mobile_1']) : null,
            'student_mobile_2' => isset($request['student_mobile_2']) ? filter_strip_tags($request['student_mobile_2']) : null,
            'parent_mobile_1' => isset($request['parent_mobile_1']) ? filter_strip_tags($request['parent_mobile_1']) : filter_strip_tags($request['student_mobile_1']),
            'parent_mobile_2' => isset($request['parent_mobile_2']) ? filter_strip_tags($request['parent_mobile_2']) : filter_strip_tags($request['student_mobile_2']),
            'active' => isset($request['active']) ? filter_strip_tags($request['active']) : null,
        ];
        // dd($data);

        return $this->create($data);
    }

    public function updateMobileData($request, $id)
    {
        $data = [
            'group_id' => isset($request['group']) ? filter_strip_tags($request['group']) : null,
            'section_id' => isset($request['section']) ? filter_strip_tags($request['section']) : null,
            'student_first_name' => isset($request['student_first_name']) ? filter_strip_tags($request['student_first_name']) : null,
            'student_last_name' => isset($request['student_last_name']) ? filter_strip_tags($request['student_last_name']) : null,
            'dob' => isset($request['dob']) ? filter_strip_tags($request['dob']) : null,
            'gender' => isset($request['gender']) ? filter_strip_tags($request['gender']) : null,
            'parent_first_name' => isset($request['parent_first_name']) ? filter_strip_tags($request['parent_first_name']) : null,
            'parent_last_name' => isset($request['parent_last_name']) ? filter_strip_tags($request['parent_last_name']) : null,
            'student_mobile_1' => isset($request['student_mobile_1']) ? filter_strip_tags($request['student_mobile_1']) : null,
            'student_mobile_2' => isset($request['student_mobile_2']) ? filter_strip_tags($request['student_mobile_2']) : null,
            'parent_mobile_1' => isset($request['parent_mobile_1']) ? filter_strip_tags($request['parent_mobile_1']) : filter_strip_tags($request['student_mobile_1']),
            'parent_mobile_2' => isset($request['parent_mobile_2']) ? filter_strip_tags($request['parent_mobile_2']) : filter_strip_tags($request['student_mobile_2']),
            'active' => isset($request['active']) ? filter_strip_tags($request['active']) : null,
        ];
        // dd($data);

        return $this->where('id', $id)->update($data);
    }

    public function checkCode($code)
    {
        return $this->where([
            'user_id' => session('Data.id'),
            'code' => $code
        ])->exists();
    }

    public function deleteAllData()
    {
        $this->where('user_id', '=', session('Data.id'))->delete();
    }
}
