<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('profile_id');
        $id = auth()->user()->id;
        $user_id = Session::put('user_id',$id);
        $user = User::find($id);
        if (!empty($user->profile)) {
            $profile = $user->profile->id;
            $profile_id = Session::put('profile_id',$profile);
        }
        return view('dashboard', compact('user'));
    }
}
