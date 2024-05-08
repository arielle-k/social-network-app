<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index()
    {
            if(Auth::id()){
                $role= Auth()->user()->role;
                if($role==='user'){
                    $user = auth()->user();
                    $profile = $user->profile;

                   // Récupère les utilisateurs que tu suis, y compris l'utilisateur connecté
                    $friends = auth()->user()->friends->pluck('id')->push(auth()->user()->id);

                    // Récupère les dernières publications des utilisateurs que tu suis, en incluant le nouvel utilisateur connecté
                    $posts = Post::whereIn('user_id', $friends)->latest()->paginate(10);



                    $friends = $user->friends ?? []; // Utilise un tableau vide comme valeur par défaut si la relation est nulle
                    $friendsCount = count($friends);

                    //recuperer les dernieres photos d'un user
                    $photos = $user->posts()->whereNotNull('image')->latest()->get();

                    //suggestion d'amis

                    $userFriends = $user->friends;

                    $suggestedFriends = [];
                    foreach ($userFriends as $friend) {
                        $mutualFriends = $friend->friends;
                        foreach ($mutualFriends as $mutualFriend) {
                            if ($mutualFriend->profile) {
                                $suggestedFriends[] = $mutualFriend;
                            }
                        }
                    }

                    $friendsSuggestions = collect($suggestedFriends)->filter(function ($suggestedFriend) use ($user, $userFriends) {
                        return !$userFriends->contains('id', $suggestedFriend->id) && !$suggestedFriend->friends->contains('id', $user->id);
                    })->map(function ($suggestedFriend) use ($user) {
                        $mutualFriendsCount = $suggestedFriend->friends()->whereHas('friends', function ($query) use ($user) {
                            $query->where('friend_id', $user->id);
                        })->count();

                        $suggestedFriend->mutualFriendsCount = $mutualFriendsCount;

                        return $suggestedFriend;
                    });


                    //recuperer les notifications non lues
                    $unreadNotificationsCount = Auth::user()->unreadNotifications()->count();
                    //dd(auth()->user()->unreadNotifications);



                    return view('posts.index', ['posts' => $posts, 'profile' => $profile, 'friends' => $friends, 'friendsCount' => $friendsCount, 'photos' => $photos, 'friendsSuggestions' => $friendsSuggestions,'unreadNotificationsCount' => $unreadNotificationsCount,'userFriends'=>$userFriends]);

                }
                else if($role==='admin'){
                    return redirect('/admin/login');
                }
            }
    }


}
