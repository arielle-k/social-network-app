<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FriendshipController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home',[HomeController::class,'index'])->name('posts.index');
Route::get('/Dashbord',[HomeController::class,'dashbord'])->name('dashboard');

//Route::get('/home',[PostController::class, 'index'])->name('posts.index');

Route::resource('/posts', PostController::class)->except('index');

Route::get('/photos', [PostController::class, 'userPhotos'])->name('user.photos');
Route::get('/friends', [PostController::class, 'showFriends'])->name('user.friends');
Route::delete('/friends/{amiId}/unfollow', [PostController::class, 'unfollow'])->name('friend.unfollow');
Route::post('/friends/{amiId}/follow', [PostController::class, 'follow'])->name('friend.follow');
// Route pour le like d'un post
Route::post('/like', [PostController::class, 'like'])->name('posts.like');

// Route pour ajouter un commentaire à un post
//Route::post('/posts/{postId}/comments', [PostController::class, 'addComment'])->name('posts.comments.add');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'acc'])->name('profile.edit');
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::get('/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::post('/connect-with-users', [UserController::class,'connectWithUsers'])->name('connect.with.users');
Route::get('/Add-users', [UserController::class, 'addFriends'])->name('add.friends');
Route::get('/user/activities/{user}', [UserController::class, 'activities'])->name('user.activities');
Route::get('/users/search', [UserController::class,'search'])->name('users.search');
Route::get('/suggestion', [UserController::class,'ShowFriendsuggestion']);
Route::post('/add-friend', [UserController::class, 'addFriend'])->name('add.friend');// route pour la demande d'amitier

Route::get('/friends/{profile}/follow-back', [FriendshipController::class, 'followBack'])->name('friends.follow-back');





//route pour add un commentaire
Route::post('/comments', [CommentController::class,'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');


Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');






require __DIR__.'/auth.php';
