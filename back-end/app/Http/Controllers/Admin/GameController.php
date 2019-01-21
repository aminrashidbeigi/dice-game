<?php

namespace App\Http\Controllers\Admin;

use App\GameStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Schema;
use App\Game;
use Illuminate\Http\Request;



class GameController extends Controller {

	/**
	 * Display a listing of game
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $id = Auth::user()->id;
        $game = Game::all()->where('user_id', $id);

		return view('admin.game.index', compact('game'));
	}

	/**
	 * Show the form for creating a new game
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    return view('admin.game.create');
	}

	/**
	 * Store a newly created game in storage.
	 *
	 */
	public function store(Request $request)
	{

	    $game = new Game();
	    $game->user_id = Auth::user()->id;
        $game->maximum_score = $request->all()['maximum_score'];
        $game->current_score = $request->all()['current_score'];
        $game->dice_number = $request->all()['dice_number'];
        $game->save();
		return redirect()->route('game.index');
	}

	/**
	 * Show the form for editing the specified game.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$game = Game::find($id);
	    
	    
		return view('admin.game.edit', compact('game'));
	}

	/**
	 * Update the specified game in storage.
     *
	 * @param  int  $id
	 */
	public function update($id, Request $request)
	{
		$game = Game::findOrFail($id);

		$game->update($request->all());
        return redirect()->route('game.index');
	}

	/**
	 * Remove the specified game from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Game::destroy($id);

		return redirect()->route('game.index');
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
            Game::destroy($toDelete);
        } else {
            Game::whereNotNull('id')->delete();
        }

        return redirect()->route('game.index');
    }

    public function gamesList()
    {
        $game = Game::all();
        return view('admin.game.list', compact('game'));
    }

    public function playingGames()
    {
        $playingGameIds = GameStatus::where('status', 'playing')->get();
        $games = Game::whereIn('id', $playingGameIds)->get();
        return view('admin.game.playing', compact('games'));
    }
}
