<?php

namespace App\Http\Controllers;

use App\User;
use App\Task;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.profile', ['user' => $user]);
        }
        else{
            return redirect('/');
        }

    }
    public function updateProfile(){


        $user = Auth::user();
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->complete_name = Input::get('complete_name');
        $user->phone_number = Input::get('phone_number');
        $user->address = Input::get('address');
        $user->country = Input::get('country');
        $user->save();

        return Redirect::route('profile');

    }
    public function changePass(){

        if (Auth::check()) {

            return view('profile.changepass');
        }
        else{
            return redirect('/');
        }

    }
    public function userList(Request $request){

        $user = Auth::user();
        $users = User::all();
        if($user->isSuperUser()){
            return view('admin.users', [
                'users' => $users,
            ]);
        }else{
            return Redirect::route('dashboard');
        }
    }
    public function updatePass(Request $request)
    {

        $user = Auth::user();
        $oldpassword = Input::get('oldpass');
        $password = Input::get('password');
        $password_confirmation = Input::get('password_confirmation');
        if (Hash::check($oldpassword, $user->password)) {
            if ($password == $password_confirmation) {
                $user->password = bcrypt($password);
                $user->save();
                $request->session()->flash('alert-success', 'Password successfully changed.');
                return redirect()->route("profile.changepass");
            } else {
                $request->session()->flash('alert-danger', 'Your passwords do not match.');
                return redirect()->route("profile.changepass");
            }
        }
        else {
            $request->session()->flash('alert-danger', 'Your current password is incorrect.');
            return redirect()->route("profile.changepass");
        }
    }
}