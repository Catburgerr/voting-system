<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $profile = Profile::
        with('user')
        ->when($request->user_id, function($query) use($request){
            $query->where('user_id', $request->user_id);
        })
        ->when($request->name, function($query) use($request){
            $query->where('name', 'like' , '%' .$request->name. '%');
        })
        ->get();

        return new ProfileCollection($profile);
    }
    
    public function create()
    {
        return view('profile.create');
    }
    
    public function store(ProfileRequest $request)
    {
        $user_id = auth()->user()->id;
        $request->merge([
            'user_id'=>$user_id
        ]);
        $profile = Profile::create($request->all());
        return redirect()->route('profile.edit',$profile->id)->withStatus(__('Profile successfully created.'));
    }
    
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $profile = Profile::find($id);
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile->update($request->all());

        //auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
