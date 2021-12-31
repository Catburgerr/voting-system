<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'vote_id',
        'count',
    ];

    public function profiles(){
        return $this->belongsToMany('App\Models\Profile', 'profile_id');
    }

    public function votes(){
        return $this->belongsToMany('App\Models\Vote', 'vote_id');
    }

    public function profile(){
        return $this->belongsTo('App\Models\Profile', 'profile_id', 'id');
    }
}
