<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersListController extends Controller {

	/**
	 * Index page
	 *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
        $users = User::all();
        return view('admin.userslist.index', compact('users'));
	}

}