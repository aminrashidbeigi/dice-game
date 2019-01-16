<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProfileController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
		return view('admin.profilecontroller.index');
	}

}