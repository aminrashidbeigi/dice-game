<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Game;
use App\GameStatus;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GameStatusController extends Controller
{

    public function sendGameUpdate(Request $request, $id)
    {
        $gameStatus = new GameStatus();
        $gameStatus->game_id = $id;
        $gameStatus->turn = $request->all()['turn'];
        $gameStatus->user1_score = $request->all()['user1_score'];
        $gameStatus->user2_score = $request->all()['user2_score'];
        $gameStatus->user1_current_score = $request->all()['user1_current_score'];
        $gameStatus->user2_current_score = $request->all()['user2_current_score'];
        $gameStatus->dice1 = $request->all()['dice1'];
        $gameStatus->dice2 = $request->all()['dice2'];
        $gameStatus->status = $request->all()['status'];
        $gameStatus->save();
        return response()->json([]);

    }

    public function store(Request $request, $id)
    {
        $comment = new Comment();
        $comment->game_id = $id;
        $comment->user_id = $request->all()['user'];
        $comment->body = $request->all()['text'];
        $comment->status = 'pending';
        $comment->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function sendGameStatus(Request $request, $id)
    {
        $gameStatus = DB::table('game_status')->where('game_id', $id)->orderBy('id', 'desc')->first();
        $response = new StreamedResponse(function() use ($request, $gameStatus) {
            echo 'data: ' . json_encode($gameStatus) . "\n\n";
            ob_flush();
            flush();
            usleep(200000);
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        return $response;
    }
}
