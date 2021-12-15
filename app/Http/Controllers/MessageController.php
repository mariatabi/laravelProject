<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class MessageController extends Controller
{
	public function create(Request $request){

		$message = new Message();
		$validatedData = $request -> validate([
			'title' => ['required', 'max:150'], 
			'content' => ['required', 'max:255'],
		]);
		$message -> title = $request -> title;
		$message -> content = $request -> content;

		$request-> user()->posts() -> save($message);

		return redirect('')->with('message', 'Message has been posted!');
	} 

	public function view($id){
		$message = Message::findOrFail($id);

		return view('message', [
			'message' => $message
		]);
	}
}