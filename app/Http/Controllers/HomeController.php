<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            return view('custom.profile.dashboard');
        }else{
            return redirect('/');
        }
    }

    public function export(){
        return view("export");
    }
}
