<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use App\Notifications\AddCommentNotification;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        $comment = new Comment;
        $comment->post_id = $request->input('post_id');
        $comment->user_id = $request->user()->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        $commentData = [
            'avatar' => $request->user()->profile->avatar,
            'username' => $request->user()->name,
            'created_at' => $comment->created_at->toDateTimeString(),
            'comment' => $comment->comment
        ];

         // Envoyer la notification au propriétaire du post
         $user = $comment->post->user;
         $user->notify(new AddCommentNotification($comment));

        return response()->json($commentData);
    }

    public function destroy(Comment $comment)
    {
        // Vérifier si l'utilisateur connecté est l'auteur du commentaire ou s'il est administrateur
        if (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()) {
            $comment->delete();
            return redirect()->back()->with('status', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', "You don't have permission to delete this comment.");
        }
    }
    public function edit(Comment $comment)
    {
        // Vérifier si l'utilisateur connecté est l'auteur du commentaire ou s'il est administrateur
        if (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()) {
            return view('comments.edit', compact('comment'));
        } else {
            return redirect()->back()->with('error', "You don't have permission to edit this comment.");
        }
    }

    public function update(Request $request, Comment $comment)
    {
        // Vérifier si l'utilisateur connecté est l'auteur du commentaire ou s'il est administrateur
        if (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()) {
            $comment->update($request->all());
            return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully.');
        } else {
            return redirect()->back()->with('error', "You don't have permission to update this comment.");
        }
    }

}
