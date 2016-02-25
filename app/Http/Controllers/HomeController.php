<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new \App\User();

        $user->id = Auth::user()->id;

        $notes = $user->note;

        return view('home', compact('notes'));
    }

    /**
     * To save a note.
     *
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:1',
        ]);

        $note = new \App\Note();

        $note->user_id = Auth::user()->id;

        $note->title = request()->title;

        $note->save();

        return back();
    }

    /**
     * To delete a note.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(\App\Note $note)
    {
        $note->delete();

        return back();
    }
}
