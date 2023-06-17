<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $attributes = [
        'user_id' => 0,
        'picture' => '',
    ];

    public function children()
    {
        return $this->belongsToMany('App\Models\Profile', 'relations', 'parent_id', 'child_id');
    }

    public function test()
    {
        return $this->hasMany(Relation::class);
    }

    public function secondProfile(){
       return $this->hasOne(SecondProfile::class);
    }
}
