<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequest;
use Auth;
use \App\Friend as Friend;

class UserController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function acceptFriendRequest($friendshipid) {

		$friendRequest = Friend::find($friendshipid);
		$friendRequest->accepted = 1;
		$friendRequest->save();

		$friend = \App\User::find($friendRequest->user_id);

		$friend->notify(new FriendRequest($friend->id, $friendRequest->id, true));

		flash('You are now friends with ' . $friend->name, 'success');
		return redirect('/home');
	}

	public function addFriendRequest($friendid) {
		$friendRequest = new Friend;
		$friendRequest->user_id = Auth::id();
		$friendRequest->friend_id = $friendid;
		$friendRequest->save();

		$friend = \App\User::find($friendid);
		$friend->notify(new FriendRequest($friendid, $friendRequest->id, false));
	}

	public function inviteFriendsForm() {
		return view('users/friends/invite');
	}
}
