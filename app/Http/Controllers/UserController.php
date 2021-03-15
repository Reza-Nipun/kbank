<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Applicability;
use App\UserApplicability;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $users = User::whereIN('status', [0, 1])->get();

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('users', compact('new_requests_count'))->with(['users' => $users]);
    }

    public function newAccountRequests(){
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('new_account_requests', compact('new_requests_count'))->with(['new_requests' => $new_requests]);
    }

    public function editNewAccountRequest($id){
        $user_info = User::find($id);

//        $applicabilities = Applicability::where('status', 1)->get();
//        $user_applicabilities = UserApplicability::where('user_id', $id)->get();

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('edit_new_account_request', compact('new_requests_count'))->with(['user_info' => $user_info]);
    }

    public function updateUserAccount(Request $request, $id){
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'access_level' => 'required',
            'status' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->access_level = $request->access_level;
        $user->status = $request->status;
        $user->save();

        $user_id = $user->id;

//        UserApplicability::where('user_id', $user_id)->delete();

//        $applicability_ids = $request->applicability_ids;
//
//        foreach($applicability_ids as $u_app){
//            $user_applicability = new UserApplicability();
//
//            $user_applicability->user_id = $user_id;
//            $user_applicability->applicability_id = $u_app;
//            $user_applicability->save();
//        }

        \Session::flash('message', 'Successfully Updated!');

        return redirect('/users');
    }
}
