<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function ShowAddPackage($id)
    {
        $Packages = Package::where('user_id', '=', $id)->get();
        return view('user.package', ['Packages' => $Packages, 'UserID' => $id]);
    }

    public function AddPackage(Request $request, $id)
    {
        $User = User::find($id);
        $User->remaining_of_sms = $User->remaining_of_sms + $request->no_of_sms;
        $User->no_of_sms = $User->no_of_sms + $request->no_of_sms;
        $User->expiry_date = new DateTime($request->expiry_date);

        if ($User->save()) {
            $Package = new Package();
            $Package->user_id = $id;
            $Package->no_of_sms = $request->no_of_sms;
            $Package->expiry_date = new DateTime($request->expiry_date);
            $Package->purchase_date = new DateTime(now());

            $Package->save();
            return redirect()->route('users.index')->with('AlertType', 'success')->with('AlertMsg', 'Package Added.');
        } else {
            return redirect()->route('users.index')->with('AlertType', 'danger')->with('AlertMsg', 'Package could not added.');
        }

        return view('user.package');
    }
}
