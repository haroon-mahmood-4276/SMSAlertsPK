<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
                return redirect('dashboard');
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
            // return $User;
        } else {
            return with('AlertType', 'danger')->with('AlertMsg', 'Something went wrong. Err Code: 0x00001');
        }
        return view('user.dashboard', ['User' => $User]);
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
