<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	public function index()
	{
		return view('message');
	}

	public function store(Request $request)
	{
		$message = Message::create([
			'user_from' => auth()->id(),
			'user_to' => $request->input('userTo'),
			'message' => $request->input('message')
		]);

		event(new NewMessage($message));

		return response()->json($message);
	}

	public function fetchMessages()
	{
		// $messages = Message::where(function ($query) {
		// 	$query->where('user_from', 5)
		// 		->where('user_to', 3);
		// })->orWhere(function ($query) {
		// 	$query->where('user_from', 3)
		// 		->where('user_to', 5);
		// })->orderBy('created_at', 'asc')->get();

		// return response()->json($messages);
	}

	public function show($receiverId)
	{
		$messages = Message::where(function ($query) use($receiverId) {
			$query->where('user_from', auth()->id())
				->where('user_to', $receiverId);
		})->orWhere(function ($query) use($receiverId) {
			$query->where('user_from', $receiverId)
				->where('user_to', auth()->id());
		})->orderBy('created_at', 'asc')->get();

		return response()->json($messages);
	}

	public function fetchUsers()
	{
		$receiverId = Message::where('user_from',auth()->id())->distinct()->pluck('user_to');
		
		return User::whereIn('id', $receiverId)->get();
	}
}
