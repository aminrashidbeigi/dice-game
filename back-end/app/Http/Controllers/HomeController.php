<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $games = \App\Game::all();
        $users = \App\User::all();
        $onlineUsers = [];
        foreach ($users as $user) {
            if ($user->isOnline()) {
                $onlineUsers[] = $user;
            }
        }
        return view('welcome')->with('games', $games)->with('onlineUsers', $onlineUsers);
    }
}
