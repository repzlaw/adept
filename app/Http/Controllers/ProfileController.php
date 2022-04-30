<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\changePassword;


class ProfileController extends Controller
{
    public function index($id = null)
    {
        if (is_null($id)) {
            $user = Auth::user();
        } else {
            $user = User::where('id', $id)->first();
        }
        return Inertia::render('Authenticated/Profile/Index', ['user' => $user]);
    }


    public function edit(Request $request)
    {
        $dob = date('Y-m-d', strtotime($request->input('dob')));
        $profile = User::find($request->input('id'));
        $profile->surname = $request->input('surname');
        $profile->othername = $request->input('othername');
        $profile->name = $request->input('name');
        $profile->email = $request->input('email');
        $profile->adddress = $request->input('adddress');
        $profile->phone = $request->input('phone');
        $profile->lga = $request->input('lga');
        $profile->sex = $request->input('sex');
        $profile->marital_status = $request->input('marital_status');
        $profile->dob = $dob;
        $profile->religion = $request->input('religion');
        $profile->save();
        return response()->json(['message' => 'Profile Updated Successful']);
    }

    public function photoUpdate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'photo' => 'image|max:3999',
        ]);

        $profile = User::where('id', $request->id)->first();

        if ($request->hasFile('photo')) {
            $cac = time() . '_photo_' . $request->file('photo')->getClientOriginalName();
            $photo = str_replace(" ", "_", $cac);
            $path = $request->file('photo')->storeAs('public/images', $photo);

            if ($profile->profile_photo_path != "") {
                Storage::delete($profile->profile_photo_path);
            }
            $profile->profile_photo_path = $photo;
            // url('/').'/storage/images/'.$photo
            $profile->save();
            return response()->json(['data' => 'Profile Photo Updated Successfully'], 200);
        }
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user()->id;
        $users = Auth::user();
        $old = $request->old;
        $new = $request->password;
        $check = User::where('id', $user)->first();
        if (Hash::check($old, $check->password)) {
            $check->password = Hash::make($new);
            $update = $check->update();
            $name = Auth::user()->name;
            if ($update) {
                // Mail::to(Auth::user()->email)->send(new changePassword($name));
                return response()->json(['data' => 'Password Updated Successfully'], 200);
            }
        } else {
            return response([
                'error' => "Incorrect Old Password"
            ], 405);
        }
    }
}
