<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentAcceptController extends Controller {

	/**
	 * Index page
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index()
    {
        $comments = Comment::where('status', 'pending')->get();
        return view('admin.commentaccept.index', compact('comments'));
	}

    /**
     * Index page
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function acceptComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'accepted';
        $comment->save();
        $comments = Comment::where('status', 'pending')->get();
        return view('admin.commentaccept.index', compact('comments'));
    }

    /**
     * Index page
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function rejectComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 'rejected';
        $comment->save();
        $comments = Comment::where('status', 'pending')->get();
        return view('admin.commentaccept.index', compact('comments'));
    }

}