<?php

namespace App\Http\Controllers\Api;

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


    public function getGame($id) {
        $game = Game::findOrFail($id);
        $result = [
            'id' => $game->id,
            'comments' => []
        ];

        foreach ($game->comments as $cm) {
            if ($cm->status == 'accepted') {
                $result['comments'][] = [
                    'text' => $cm->body,
                    'user' => $cm->user
                ];
            }
        }

        return response()->json([
            'result' => $result,
        ]);
    }
}
