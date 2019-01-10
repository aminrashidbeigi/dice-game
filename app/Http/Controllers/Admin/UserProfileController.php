<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;


class UserProfileController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
        $user  = User::findOrFail(Auth::user()->id);
        return view('admin.userprofile.index', compact('user'));
	}


    public function update(Request $request){

	    $user = Auth::user();
        $user = User::findOrFail($user->id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user->update($input);


        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user->avatar = $filename;
            $user->save();
        }
        return redirect()->route('admin.userprofile.index')->withMessage(trans('quickadmin::admin.users-controller-successfully_updated'));
    }
}