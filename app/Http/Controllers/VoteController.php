<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\User;
use App\Models\Profile;
use App\Models\Voter;
use App\Models\Result;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\VoteCollection;
use App\Http\Resources\VoterCollection;

class VoteController extends Controller
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
        return view('votes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code = $this->generateCode();
        $request->merge([
           'code'=>$code 
        ]);
        $vote = Vote::create($request->all());
        $vote_id = $vote->id;
        Session::put('vote_id',$vote_id);
        return redirect()->route('nominee.create', $vote_id )->withStatus(__('Vote successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $vote_id)
    {
        $vote = Vote::with('profiles')
        ->with('profiles.result', function($query) use($vote_id) {
            $query->Where('vote_id',$vote_id);
        })
        ->find($vote_id);
        $count = NULL;
        foreach ($vote->profiles as $profile) {
            if (!empty($profile->result->count)) {
                $count = $profile->result->count + $count;
            }
        }
        return view('votes.show', compact('vote', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vote_id)
    {
        $vote = Vote::with('profiles')->find($vote_id);
        
        return view('votes.edit', compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vote_id)
    {
        $vote = Vote::with('profiles')->find($vote_id);
        $vote->update($request->all());
        return back()->withStatus(__('Vote successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * List all votes.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $votes = Vote::with('profiles')->get();
        return view('votes.list', compact(
            'votes'
        ));
    }

    /**
     * Call voting session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function start(Request $request)
    {
        return view('votes.start');
    }

    public function check(Request $request)
    {
        $code = $request->input('code');
        $vote = Vote::with('profiles')
        ->where('code',$code)
        ->first();
        
        $vote_id = $vote->id;        
        $user_id = auth()->user()->id;

        $voters = Voter::where('user_id',$user_id)
        ->where('vote_id',$vote_id)
        ->first();

        if ($vote->is_active) {
            if(empty($voters)) {   
                return view('votes.start', compact('vote'));
            } else {
                return back()->withStatus(__('You have submitted your vote this election.'));  
            }

        } else { 
            return back()->withStatus(__('Vote is not active.'));       
        } 
    }

    public function generateCode() {
        $alphabet     = substr(str_shuffle("ABCDEFGHJKLAMNPQRSTUVWXYZ"), 0, 1);
        $alphanumeric = substr(str_shuffle("ABCDEFGHJKLAMNPQRSTUVWXYZ123456789"), 0, 6);
        $number       = substr(str_shuffle("123456789"), 0, 1);
        $code         = str_shuffle($alphabet . $alphanumeric . $number);
        if (Vote::where('code', $code)->exists()) {
            $code = $this->generateCode();
        }
        return $code;
    }   
}
