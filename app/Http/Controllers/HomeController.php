<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserDetail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        if(auth()->user()){
            $getUserId = auth()->user()->id;
            $userProfile = UserDetail::where("user_id",$getUserId)->first();
            return view('custom.profile.dashboard',compact('userProfile'));
        }else{
            return redirect('/');
        }
    }

    public function export(){
        return view("export");
    }
}
