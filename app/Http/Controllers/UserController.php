<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\Friendship;
use App\Models\Comment;
use App\Notifications\FriendNotification;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function connectWithUsers(Request $request)
{
    // Récupérer les utilisateurs au hasard qui ont déjà un profil
    $users = User::whereHas('profile')->inRandomOrder()->take(5)->get();

    // Récupérer l'utilisateur actuellement connecté
    $currentUser = Auth::user();

    // Parcourir les utilisateurs récupérés et les connecter avec l'utilisateur actuel
    foreach ($users as $user) {
        // Vérifier si l'utilisateur actuel n'est pas déjà connecté avec cet utilisateur
        if (!$currentUser->friends->contains($user->id)) {
            // Créer une nouvelle entrée dans la table friendships
            Friendship::create([
                'user_id' => $currentUser->id,
                'friend_id' => $user->id,
            ]);
        }
    }

dd($users);
    // Rediriger vers une vue avec les utilisateurs connectés
    return view('posts.suggestion', ['users' => $users]);
}


public function addFriends()
{
    $currentUser = Auth::user();

    $users = User::whereHas('profile')
        ->whereDoesntHave('friends', function ($query) use ($currentUser) {
            $query->where('friend_id', $currentUser->id);
        })
        ->where('id', '!=', $currentUser->id) // Exclure l'utilisateur connecté
        ->orderBy('created_at', 'asc')
        ->take(5)
        ->get();

    return view('posts.suggestion', ['users' => $users]);
}

public function addFriend(Request $request)
{
    $userId = $request->input('user_id');
    $user = User::find($userId);

    if ($user) {
        $currentUser = Auth::user();

        // Ajouter la logique d'ajout d'amis ici

        // Envoie de la notification FriendNotification
        $user->notify(new FriendNotification($currentUser));

        return response()->json(['success' => true, 'message' => 'Friend added successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Failed to add friend.']);
}








public function activities(User $user)
{
    $posts = $user->posts;
    $userComments = Comment::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        $userLikes = Like::where('user_id', $user->id)
        ->where('post_id', '!=', null)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();


    return view('posts.activities', [
        'posts' => $posts,
        'userComments' => $userComments,
        'userLikes' => $userLikes
    ]);
}

public function search(Request $request)
{
    $query = $request->input('query');

    // Effectuez votre logique de recherche ici, par exemple :
    $users = User::where('name', 'like', '%' . $query . '%')->get();

    return view('posts.search', compact('users', 'query'));
}



public function showFriendSuggestions()
{
    $user = auth()->user();

    $userFriends = $user->friends;

    $suggestedFriends = [];
    foreach ($userFriends as $friend) {
        $mutualFriends = $friend->friends;
        foreach ($mutualFriends as $mutualFriend) {
            if ($mutualFriend->profile && !$userFriends->contains('id', $mutualFriend->id) && $mutualFriend->profile) {
                $suggestedFriends[] = $mutualFriend;
            }
        }
    }

    $friendsSuggestions = collect($suggestedFriends)
        ->where('profile', '!=', null)
        ->whereDoesntHave('friends', function ($query) use ($user) {
            $query->where('friend_id', $user->id);
        })
        ->withCount(['friends as mutualFriendsCount' => function ($query) use ($user) {
            $query->whereHas('friends', function ($query) use ($user) {
                $query->where('friend_id', $user->id);
            });
        }])
        ->all();

    return view('posts.index', compact('friendsSuggestions'));
}



}
