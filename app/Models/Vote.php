<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'code',
        'is_active',
    ];

    public function profiles(){
        return $this->belongsToMany('App\Models\Profile', 'profile_vote')->withTimeStamps();
    }

    public function results(){
        return $this->belongsToMany('App\Models\Result', 'result_vote')->withTimeStamps();
    }
}
