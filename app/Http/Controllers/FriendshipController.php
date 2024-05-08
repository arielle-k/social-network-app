<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\Friendship;
use Illuminate\Support\Facades\Auth;
use App\Notifications\FriendAcceptedNotification;

class FriendshipController extends Controller
{
    public function followBack(Profile $profile)
    {
        $currentUser = Auth::user();
        $profileUser = $profile->user;

        // Vérifiez si l'utilisateur du profil est déjà ami avec l'utilisateur connecté
        if (!$profileUser->friends->contains($currentUser->id)) {
            // Créez une nouvelle entrée dans la table friendships
            Friendship::create([
                'user_id' => $profileUser->id,
                'friend_id' => $currentUser->id,
            ]);

            // Envoyer une notification à l'utilisateur qui a envoyé la demande d'amitié
            $profileUser->notify(new FriendAcceptedNotification($profileUser));
        }

        return redirect()->route('user.friends')->with('status', 'You are now friends!');
    }

}
