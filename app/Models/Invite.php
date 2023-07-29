<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = "invites";
    public $timestamps = true;

    public function invitedBy(){
        return $this->hasOne(User::class,'id','invited_by_id');
     }

     public function user(){
        return $this->hasOne(User::class,'id','user_id');
     }

}
