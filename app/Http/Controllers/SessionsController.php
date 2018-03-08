<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
	return view('sessions.create');
    }
    
    public function store(Request $request)
    {
	$credentials = $this -> validate($request, [
		'email' => 'required|email|max:255',
		'password' => 'required',
	]);
	
	if (Auth::attempt($credentials, $request->has('has'))){
		session()->flash('success', 'Welcome back!!!');
		return redirect()->route('users.show', [Auth::user()]);	
	} else {
		session()->flash('danger', 'Sorry, email or password is incorrect');
		return redirect()->back();
	}
    }

    public function destroy()
    {
	Auth::logout();
	session()->flash('success', 'Logout Successfully!!!');
	return redirect('login');
    }
}
