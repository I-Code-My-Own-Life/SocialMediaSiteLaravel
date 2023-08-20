<?php

use App\Http\Controllers\FriendRequestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
}); 


Route::get('/home', function () {
    return view('home');
})->name('home');

// Profile routes : 
Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create')->middleware('auth');

Route::post("/profile", [ProfileController::class, 'store'])->name('profile.store')->middleware(['auth']);

Route::get("/profile/{profile:username}", [ProfileController::class, 'show'])->name('profile.show')->middleware(['auth','complete.profile']);

// Friend request routes : 
Route::middleware(['auth'])->group(function (){
    Route::post('/friend-requests/send/{user}',[FriendRequestController::class,'sendRequest'])->name('friend-requests.send');
    Route::post('/friend-requests/accept/{user}', [FriendRequestController::class, 'acceptRequest'])->name('friend-requests.accept');
    Route::post('/friend-requests/reject/{user}', [FriendRequestController::class, 'rejectRequest'])->name('friend-requests.reject');
    
    // Friendships
    Route::post('/friends/remove/{friend}', [FriendshipController::class, 'removeFriend'])->name('friends.remove');
});

