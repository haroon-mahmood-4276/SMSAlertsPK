<?php

namespace App\Http\Controllers;

use App\Models\User;
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
    public function index()
    {
        $Users = User::all();
        return view('User.index', ['Users' => $Users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
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
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'email' => 'required|email|unique:users,email',
            'password' => 'between:5,15',
            'company_name' => 'required|alpha|between:1,50',
            'company_mask_id' => 'required|max:11',
            'company_nature' => 'required',
            'company_email' => 'required|email|unique:users,company_email',
            'mobile_1' => 'required|digits:12',
            'mobile_2' => 'nullable||digits:12',
            'no_of_sms' => 'required|integer',
        ]);

        $User = new User;
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->email = $request->email;
        $User->password = Hash::make($request->password);
        $User->company_name = $request->company_name;
        $User->company_mask_id = $request->company_mask_id;
        $User->company_nature = $request->company_nature;
        $User->company_email = $request->company_email;
        $User->mobile_1 = $request->mobile_1;
        $User->mobile_2 = $request->mobile_2;
        $User->no_of_sms = $request->no_of_sms;

        if ($User->save()) {
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
        return view('User.edit', ['User' => $User]);
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
            'first_name' => 'bail|required|alpha|between:1,50',
            'last_name' => 'bail|required|alpha|between:1,50',
            'email' => 'required|email|unique:users,email',
            'password' => 'between:5,15',
            'company_name' => 'required|alpha|between:1,50',
            'company_mask_id' => 'required|max:11',
            'company_nature' => 'required',
            'company_email' => 'required|email|unique:users,company_email',
            'mobile_1' => 'required|digits:12',
            'mobile_2' => 'nullable||digits:12',
            'no_of_sms' => 'required|integer',
        ]);

        $User = User::find($id);
        $User->first_name = $request->first_name;
        $User->last_name = $request->last_name;
        $User->email = $request->email;
        if (Str::length($request->password) > 0) {
            $User->password = Hash::make($request->password);
        }
        $User->company_name = $request->company_name;
        $User->company_mask_id = $request->company_mask_id;
        $User->company_nature = $request->company_nature;
        $User->company_email = $request->company_email;
        $User->mobile_1 = $request->mobile_1;
        $User->mobile_2 = $request->mobile_2;
        $User->no_of_sms = $request->no_of_sms;

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
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);

        $User = User::where('email', '=', $request->email)->first();
        if ($User) {
            if (Hash::check($request->password, $User->password)) {
                $request->session()->put('user_id', $User->id);
                $request->session()->put('company_nature', 'B');
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
        if (session()->has('user_id') && session()->has('company_nature')) {
            $User = User::find(session('user_id'));
        } else {
            return with('AlertType', 'danger')->with('AlertMsg', 'Something went wrong. Err Code: 0x00001');
        }
        return view('User.dashboard', ['User' => $User]);
    }

    public function logout()
    {
        if (Session()->has('user_id') && Session()->has('company_nature')) {
            Session()->forget('user_id');
            Session()->forget('company_nature');
        }
        return redirect()->route('r.login');
    }
}
