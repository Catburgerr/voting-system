<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Voter;
use App\Models\Profile;
use Illuminate\Support\Facades\Session;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('results.finish');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }

    /**
     * Check if have already voted
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request, $vote_id)
    {
        $profile_user = auth()->user()->profile->id;
        $profile_id = $request->input('profile_id');

        $user_id = auth()->user()->id;

        $result = Result::
        where('profile_id',$profile_id)
        ->where('vote_id',$vote_id)
        ->first();

        $profile = Profile::
        where('id',$profile_id)
        ->first();    

        if ($profile_user == $profile_id){
            return redirect()->back()->withStatus(__('Error please contact the admin.'));
        } else {
            if (!empty($result)) {
                $result = Result::
                where('profile_id',$profile_id)
                ->where('vote_id',$vote_id)
                ->increment('count');
            } else {                
                $request->merge([
                    'vote_id'=>$vote_id,
                    'count'=>1,
                ]);    
                $result = Result::create($request->all());
            }
        }

        $data = [
            'user_id'=>$user_id,
            'vote_id'=>$vote_id,
        ];

        $voter = Voter::create($data);
        return view('results.finish');
    }

    /**
     * Show voting end
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function finish()
    {
        return view('results.finish');
    }
    
}
