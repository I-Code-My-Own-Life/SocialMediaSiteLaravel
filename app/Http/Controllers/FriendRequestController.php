<?php

namespace App\Http\Controllers;

use Pusher;
use App\Models\User;

use App\Models\Friendship;

use Illuminate\Http\Request;
use App\Models\FriendshipRequest;
use App\Events\NewNotificationEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\FriendRequestNotification;
use App\Notifications\FriendRequestAcceptNotification;
use App\Notifications\FriendRequestRejectNotification;
use BeyondCode\LaravelWebSockets\Dashboard\Http\Controllers\SendMessage;

class FriendRequestController extends Controller
{
    public function sendRequest(User $user)
    {
        // Ensure the user is not sending a request to themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot send a friend request to yourself.');
        }

        // Check if a friend request has already been sent :
        $existingRequest = FriendshipRequest::where('user_id', auth()->user()->id)->where('receiver_id', $user->id)->exists();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You have already sent a friend request to this user.');
        }

        // Create a new friendship request record
        FriendshipRequest::create([
            // Sender : 
            'user_id' => auth()->user()->id,
            // Receiver : 
            'receiver_id' => $user->id,
        ]);

        // Send notification here : 
        Notification::send($user, new FriendRequestNotification());

        $notificationData = ['message' => 'Dear user, ' . $user->name . ', your friend request to' . auth()->user()->name . 'has been sent successfully.'];

        $broadcast = broadcast(new NewNotificationEvent($notificationData, $user->id))->toOthers();

        dd($broadcast);

        return redirect()->back()->with('success', 'Friend request sent successfully.');
    }

    public function acceptRequest(Request $request, User $user)
    {
        $friendRequest = FriendshipRequest::where([
            'user_id' => $user->id, // the person who has sent the request and is waiting for the response : 
            'receiver_id' => auth()->user()->id, // the person who received the request and is accepting it
        ])->first();

        if ($friendRequest) {
            $friendRequest->update(['accepted' => true]);

            // Create a friendship record in the 'friendships' table
            Friendship::create([
                'user_id' => auth()->user()->id,
                'friend_id' => $user->id,
            ]);
            Friendship::create([
                'user_id' => $user->id,
                'friend_id' => auth()->user()->id,
            ]);

            // Sending notification to the user who sent the request :
            Notification::send($user, new FriendRequestAcceptNotification());

            $notificationData = ['message' => 'Dear user ' . $user->name . ', your friend request to ' . auth()->user()->name . ' has been accepted.'];

            // Broadcasing means real time messaging to the user : 
            broadcast(new NewNotificationEvent($notificationData, $user->id))->toOthers();

            return redirect()->back()->with('success', 'Friend request accepted.');
        }

        return redirect()->back()->with('error', 'Friend request not found.');
    }

    public function rejectRequest(User $user)
    {
        $friendRequest = FriendshipRequest::where([
            'user_id' => $user->id,
            'receiver_id' => auth()->id(),
        ])->first();

        if ($friendRequest) {
            $friendRequest->delete(); // Delete the friend request
        }

        // Sending notification to the user who sent the request :
        Notification::send($user, new FriendRequestRejectNotification());

        $notificationData = ['message' => 'Your friend request to ' . auth()->user()->name . ' has been rejected. '];

        broadcast(new NewNotificationEvent($notificationData, $user))->toOthers();

        // dd(broadcast(new NewNotificationEvent($notificationData))->toOthers());

        // Redirect back or to any other page
        return redirect()->back()->with('error', 'Friend request rejected.');
    }
}
