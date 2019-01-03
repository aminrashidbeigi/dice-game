<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\GameDesign;
use App\Http\Requests\CreateGameDesignRequest;
use App\Http\Requests\UpdateGameDesignRequest;
use Illuminate\Http\Request;



class GameDesignController extends Controller {

	/**
	 * Display a listing of gamedesign
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $gamedesign = GameDesign::all();

		return view('admin.gamedesign.index', compact('gamedesign'));
	}

	/**
	 * Show the form for creating a new gamedesign
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.gamedesign.create');
	}

	/**
	 * Store a newly created gamedesign in storage.
	 *
     * @param CreateGameDesignRequest|Request $request
	 */
	public function store(CreateGameDesignRequest $request)
	{
	    
		GameDesign::create($request->all());

		return redirect()->route(config('quickadmin.route').'.gamedesign.index');
	}

	/**
	 * Show the form for editing the specified gamedesign.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$gamedesign = GameDesign::find($id);
	    
	    
		return view('admin.gamedesign.edit', compact('gamedesign'));
	}

	/**
	 * Update the specified gamedesign in storage.
     * @param UpdateGameDesignRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateGameDesignRequest $request)
	{
		$gamedesign = GameDesign::findOrFail($id);

        

		$gamedesign->update($request->all());

		return redirect()->route(config('quickadmin.route').'.gamedesign.index');
	}

	/**
	 * Remove the specified gamedesign from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		GameDesign::destroy($id);

		return redirect()->route(config('quickadmin.route').'.gamedesign.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            GameDesign::destroy($toDelete);
        } else {
            GameDesign::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.gamedesign.index');
    }

}
