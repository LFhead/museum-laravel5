<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class UserController extends Controller
{
    public function modify(Request $request){
    	$user = User::find($request->id);

    	if(!empty($user)) {
    		$user->privilege = $request->privilege;

    		$user->save();
    	}

    	return redirect('user/list');
    }

    public function delete(Request $request) {
    	$user = User::find($request->id);

    	if(!empty($user)) {
    		$user->delete();
    	}

    	return redirect('user/list');
    }

    public function recommend(Request $request) {
        
    }
}
