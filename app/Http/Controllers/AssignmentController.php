<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Assignment;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::User();
        $assignments = $user->assignments;

        return view('assignments.index', [
            'assignments' => $assignments,
        ]);
    }
    public function addForm(){
        if(Auth::Check()) {
            $user = Auth::User();
            if (!$user->isSuperUser()) {
                return redirect('/assignments');
            } else {
                return view('assignments.add');
            }
        }else{
            return redirect('/');
        }
    }
    public function add(){

        $user = Auth::User();
        if(!$user->isSuperUser()){

            return redirect('/assignments');

        }else{

            $users = User::all();
            $usersID = array();

            foreach($users as $User){
                array_push($usersID,$User->id);
            }

            $assignment = new Assignment;
            $assignment->name = Input::get('name');
            $assignment->save();
            $assignment->users()->attach($usersID);

            return redirect('/assignments');
        }

    }
}
