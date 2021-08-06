<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Section;
use App\Models\User;
use App\Models\Mobiledatas;
use App\Models\Package;
use App\Models\Setting;
use App\Rules\CheckUserCode;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user_type != "") {
            $Users = User::where('company_nature', '=', $request->user_type)->where('company_nature', '!=', 'A')->get();
        } else
            $Users = User::where('company_nature', '!=', 'A')->get();

        return view('user.index', ['Users' => $Users, 'Selection' => $request->user_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckUserCode()],
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'email' => 'required|email|unique:users,email',
            'password' => 'between:5,15',
            'company_name' => 'required|alpha|between:1,50',
            'company_mask_id' => 'required|max:11',
            'company_username' => 'required|max:11',
            'company_password' => 'required|max:11',
            'company_email' => 'required|email|unique:users,company_email',
            'company_nature' => 'required',
            'mobile_1' => 'required|digits:12',
            'mobile_2' => 'nullable||digits:12',
        ]);
        // dd($request->input());
        $User = new User;
        $User->code = $request->code;
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->company_name = $request->company_name;
        $User->company_mask_id = $request->company_mask_id;
        $User->company_username = $request->company_username;
        $User->company_password = $request->company_password;
        $User->company_email = $request->company_email;
        $User->company_nature = $request->company_nature;
        $User->mobile_1 = $request->mobile_1;
        $User->mobile_2 = $request->mobile_2;

        if ($User->save()) {

            $BirthdaySetting = new Setting();
            $BirthdaySetting->birthday_enabled = 'N';
            $BirthdaySetting->birthday_message = null;
            $BirthdaySetting->parent_secondary_number = 'N';
            $BirthdaySetting->student_primary_number = 'N';
            $BirthdaySetting->student_secondary_number = 'N';

            return redirect()->route('users.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been saved.');
        } else {
            return redirect()->route('users.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not saved.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $User = User::find($id);
        return view('user.edit', ['User' => $User]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => ['bail', 'required', 'numeric', 'digits:5', new CheckUserCode(true, $id)],
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'email' => 'required|email',
            'password' => 'nullable|between:5,15',
            'company_name' => 'required|alpha|between:1,50',
            'company_mask_id' => 'required|max:11',
            'company_username' => 'required|max:11',
            'company_password' => 'required|max:11',
            'company_email' => 'required|email',
            'company_nature' => 'required',
            'mobile_1' => 'required|digits:12',
            'mobile_2' => 'nullable||digits:12',
        ]);

        $User = User::find($id);
        $User->code = $request->code;
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->email = $request->email;
        if (Str::length($request->password) > 0) {
            $User->password = Hash::make($request->password);
        }
        $User->company_name = $request->company_name;
        $User->company_mask_id = $request->company_mask_id;
        $User->company_username = $request->company_username;
        $User->company_password = $request->company_password;
        $User->company_email = $request->company_email;
        $User->company_nature = $request->company_nature;
        $User->mobile_1 = $request->mobile_1;
        $User->mobile_2 = $request->mobile_2;

        if ($User->save()) {
            return redirect()->route('users.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been updated.');
        } else {
            return redirect()->route('users.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::find($id);

        if ($User->delete()) {
            return redirect()->route('users.index')->with('AlertType', 'success')->with('AlertMsg', 'Data has been deleteed.');
        } else {
            return redirect()->route('users.index')->with('AlertType', 'danger')->with('AlertMsg', 'Data could not deleteed.');
        }
    }

    /*
     * Custom Login
     */
    public function loginform()
    {
        // return dd(session('Data'));
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $User = User::where('email', '=', $request->email)->first();
        // return $User;
        if ($User) {
            if (Hash::check($request->password, $User->password)) {
                $request->session()->put('Data', $User);
                return redirect()->route('r.dashboard');
            } else {
                return back()->with('AlertType', 'danger')->with('AlertMsg', 'Incorrect Password.');
            }
        } else {
            return back()->with('AlertType', 'danger')->with('AlertMsg', 'No account found for this email.');
        }
        return $User;
    }

    public function dashboard()
    {
        $GroupCount = 0;
        $SectionCount = 0;
        $MobileDatasCount = 0;
        // return dd(session('Data'));
        if (session()->has('Data')) {
            $User = User::find(session()->get('Data.id'));
            session()->put(['Data' => $User]);
            if (session('Data.company_nature') == 'A') {
                $GroupCount = User::count() - 1;
                $SectionCount = User::where('company_nature', '=', 'B')->count();
                $MobileDatasCount = User::where('company_nature', '=', 'S')->count();
                $BirthdayData = [];
            } else {
                $GroupCount = Group::where('user_id', '=', session('Data.id'))->count();
                $SectionCount = Section::where('user_id', '=', session('Data.id'))->count();
                $MobileDatasCount = MobileDatas::where('user_id', '=', session('Data.id'))->count();

                if (strval(new DateTime(Date('Y-m-d')) > new DateTime($User->expiry_date))) {
                    $User->remaining_of_sms = 0;
                    $User->save();
                    session()->put(['Data' => $User]);
                }
                $BirthdayData = Mobiledatas::join('users', 'mobiledatas.user_id', '=', 'users.id')
                    ->join('groups', 'mobiledatas.group_id', '=', 'groups.id')
                    ->join('sections', 'mobiledatas.section_id', '=', 'sections.id')
                    ->select('mobiledatas.code', 'mobiledatas.student_first_name', 'mobiledatas.student_last_name', 'mobiledatas.dob', 'groups.name AS group_name', 'sections.name AS section_name')
                    ->where('mobiledatas.user_id', '=', session('Data.id'))
                    ->where('mobiledatas.dob', '=', Carbon::today()->toDateString())
                    ->where('mobiledatas.active', '=', 'Y')->get();
            }
        }
        return view('user.dashboard', ['GroupCount' => $GroupCount, 'SectionCount' => $SectionCount, 'MobileDatasCount' => $MobileDatasCount, 'BirthdayData' => $BirthdayData]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('r.login');
    }
}
