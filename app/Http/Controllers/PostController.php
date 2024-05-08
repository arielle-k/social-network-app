<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AddCommentNotification;
use App\Notifications\PostLikedNotification;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:5',
            'content'=>'required',
            'image'=>'required|image|max:3999',

        ]);
        $file = $request->image;
        $imageName = $file->getClientOriginalName();
        $file->storeAs('images', $imageName);

        $user_id=Auth::user()->id;

    if (Auth::user()->hasProfile()) {
        Post::create([
            'name' => $request->name,
            'content' => $request->content,
            'image' => $imageName,
            'user_id' => $user_id,
        ]);

        return redirect()->route('posts.index')->with('status', 'Post posted successfully');
    } else {
        return redirect()->route('profile.create')->withErrors('Please create a profile before posting.');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
         return view('posts.show', compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'content' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Exemple de validation pour l'image
    ]);

    // Mettez à jour les champs du post
    $post->name = $validatedData['name'];
    $post->content = $validatedData['content'];

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();
        $file->storeAs('images', $imageName);
        $post->image = $imageName;
    }

    $post->save();

    return redirect()->route('user.activities', Auth::user()->id)->with('status', 'Post updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    // Supprimer le fichier image associé au post (si nécessaire)
    //Storage::disk('public')->delete($post->image);

    // Supprimer le post de la base de données
    $post->delete();

    return redirect()->route('user.activities', Auth::user()->id)->with('status', 'Post deleted successfully!');
}



    public function userPhotos()
    {
            $user = Auth::user();
            $photos = $user->posts()->whereNotNull('image')->get();

            return view('posts.photos', compact('photos'));
    }

    public function showFriends()
    {
        $user = Auth::user();
        $friends = $user->friends;
        if ($friends->count() > 0) {
            return view('posts.friends', ['friends' => $friends]);
        } else {
            return redirect()->route('add.friends')->withErrors( 'You don\'t have any friends yet. Add new friends here !');
        }

    }



    public function unfollow($amiId)
    {
         $ami = Friendship::where('friend_id', $amiId)->first();
        // Vérifier si l'ami existe
        if ($ami) {
            // Supprimer la relation d'amitié
            $ami->delete();

            // Retourner une réponse JSON indiquant le succès
            return response()->json(['success' => true]);
        }

        // Retourner une réponse JSON en cas d'erreur
        return response()->json(['success' => false, 'message' => 'Ami non trouvé']);


    }

    public function follow($amiId)
{
    // Récupérer l'utilisateur à suivre
    $ami = User::find($amiId);

    // Vérifier si l'utilisateur existe et n'est pas déjà un ami
    if ($ami && !$ami->friends->contains(auth()->user())) {
        // Créer la relation d'amitié
        $nouveauAmi = new Friendship();
        $nouveauAmi->user_id = auth()->id();
        $nouveauAmi->friend_id = $ami->id;
        $nouveauAmi->save();

        // Retourner une réponse JSON indiquant le succès
        return response()->json(['success' => true]);
    }

    // Retourner une réponse JSON en cas d'erreur
    return response()->json(['success' => false, 'message' => 'Impossible de suivre cet utilisateur']);
}






    //public function like(Request $request, Post $post)
    //{
        // Vérifiez si l'utilisateur est authentifié
       // if (Auth::check()) {
            // Enregistrez le like pour le post et l'utilisateur authentifié
           // $post->likes()->attach(Auth::user()->id);
       // }

        // Retournez une réponse JSON indiquant le succès
        //return response()->json(['success' => true]);
    //}

    public function like(): JsonResponse
    {
        $post=Post::find(request()->id);
        if($post->isLikedByLoggedInUser()){
            $res = Like::Where([
                'user_id'=>auth()->user()->id,
                'post_id'=>request()->id
            ])->delete();

            if($res){
                return response()->json([
                    'count'=>Post::find(request()->id)->likes->count()
                ]);
            }

        }else{
            $like=new Like();
            $like->user_id=auth()->user()->id;
            $like->post_id=request()->id;
            $like->save();
            $post->user->notify(new PostLikedNotification(auth()->user(),$post));

            return response()->json([
                'count'=>Post::find(request()->id)->likes->count()
            ]);
        }
    }


    public function addComment(Request $request, $postId)
    {
        // Valider les données du formulaire
        $request->validate([
            'comment' => 'required',
        ]);

        // Créer le nouveau commentaire
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $postId;
        $comment->comment = $request->input('comment');
        $comment->save();

        // Récupérer les détails du commentaire et de l'utilisateur associé
        $comment->load('user.profile');

        // Récupérer le chemin absolu de l'avatar de l'utilisateur
        $avatarPath = $comment->user->profile->avatar;
        $avatarUrl = Storage::url('avatars/' . $avatarPath);

        // Envoyer la notification au propriétaire du post
        $user = $comment->post->user;
        $user->notify(new AddCommentNotification($comment));



        // Retourner la réponse JSON avec les détails du commentaire et l'URL de l'avatar
        return response()->json(['success' => true, 'comment' => $comment, 'avatarUrl' => $avatarUrl]);
    }


}
