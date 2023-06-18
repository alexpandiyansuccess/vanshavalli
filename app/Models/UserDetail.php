<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = "user_details";

    // public function children()
    // {
    //     return $this->belongsToMany('App\Models\Profile', 'relations', 'parent_id', 'child_id');
    // }


    // public function secondProfile(){
    //    return $this->hasOne(SecondProfile::class);
    // }
}
