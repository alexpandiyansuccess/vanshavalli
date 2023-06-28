<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SecondProfile;
use Illuminate\Http\Request;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ManagechartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $profile = Profile::find(1);
        // return $profile->secondProfile;
        if(auth()->user()){
            $getUserId =  Auth::user()->id;
            $profiles = Profile::where('root_id', 0)->where("user_id",$getUserId)->paginate(4);

            return view('manage.index', compact('profiles'));
        }else{
            return redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
    {
        $message ="";
        $data = "";
        $button_id = $request->button_id;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Storage::disk('public')->put('images/'.$filename, $file);
            $profile = Profile::find($id);
            if ($profile && $button_id == 1) {
                $this->removeProfileImage($profile);
                $file->move('profile_images/', $filename);
                $profile->picture = $filename;
                $profile->save();
                $message = 'Profile Image Updated';
                $data =  $filename;
            }
        }
        if ($request->file('second_profile_image')) {
            $file = $request->file('second_profile_image');
            $second_profile_image_name = time() . '.' . $file->getClientOriginalExtension();
            // Storage::disk('public')->put('images', $file);
            $second_profile = SecondProfile::where('profile_id', $id)->first();
            if ($second_profile && $button_id == 2) {
                $this->removeProfileImage($second_profile);
                $file->move('profile_images/', $second_profile_image_name);
                $second_profile->picture = $second_profile_image_name;
                $second_profile->save();
                $message = 'Second Profile Image Updated';
                $data = $second_profile_image_name;
            }
        }
        return ['message' => $message, 'data' => $data];
    }

    public function removeProfileImage($profile)
    {
        if (file_exists('profile_images/' . $profile->picture) && $profile->picture != null) {
            unlink('profile_images/' . $profile->picture);
        }
    }

    public function update2(Request $request, $id)
    {
        $profile = Profile::find($id);
        $profile2 = $profile->secondprofile;
        if ($profile2) {
            $status = 'Profile Updated';
        } else {
            $profile2 = new Profile();
            $status = 'Profile Created';
        }
        $profile2->designation = $request->designation;
        $profile2->save();
        return $status;
    }

    public function update_second_profile($id, Request $request)
    {
        return $id;
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::find($id);
        $message = [];
        if ($profile) {
            $profile->profile_name = $request->profile_name;
            $profile->user_id = Auth::user() ? Auth::user()->id : null;
            $profile->designation = $request->designation;
            $profile->color_code = Config::get('color.' . $request['color']);
            $profile->save();
            $message[] = 'Profile Updated';

            //updating or adding second profile.
            $exist_second_profile = SecondProfile::where('profile_id', $id)->first();
            if ($exist_second_profile) {
                $exist_second_profile->user_id = Auth::user() ? Auth::user()->id : null;
                $exist_second_profile->profile_id = $id;
                $exist_second_profile->root_id = null;
                $exist_second_profile->designation = $request->designation2;
                $exist_second_profile->picture = null;
                $exist_second_profile->save();
                $message[] = 'Second Profile Updated';
            } else {
                $second_profile = new SecondProfile();
                $second_profile->user_id = Auth::user() ? Auth::user()->id : null;
                $second_profile->profile_id = $id;
                $second_profile->root_id = null;
                $second_profile->designation = $request->designation2;
                $second_profile->picture = null;
                $second_profile->save();
                $message[] = 'Second Profile Created';
            }
        }
        return $message;
    }

    public function addParent(Request $request)
    {
        return 'Yeahh';
    }

    public function destroy($id)
    {
        //
    }
}
