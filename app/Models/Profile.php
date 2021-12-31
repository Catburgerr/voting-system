<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'job_role',
        'user_id',
        'email',
        'dob',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function votes(){
        return $this->belongsToMany('App\Models\Vote', 'profile_vote')->withTimeStamps();
    }

    public function result(){
        return $this->hasOne('App\Models\Result', 'profile_id', 'id');
    }
}
