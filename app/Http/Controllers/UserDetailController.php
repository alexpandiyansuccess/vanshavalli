<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    public function createprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'gender' => 'required',
            'relationship' => 'sometimes',
            'dob' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'door_number' => 'required',
            'street_name' => 'required',
            'pincode' => 'required',
            'area' => 'required',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required',
            'instagram_username' => 'sometimes',
            'facebook_username' => 'sometimes',
            'website_url' => 'sometimes',
            'github_url' => 'sometimes',
            'twitter_username' => 'sometimes'

        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $userTableObj = new UserDetail();
        $userTableObj->user_id = auth()->user()->id  ?? "";
        $userTableObj->full_name = $request->full_name ?? "";
        $userTableObj->gender = $request->gender ?? "";
        $userTableObj->relationship = $request->relationship ?? "";
        $userTableObj->dob = $request->dob ?? "";
        $userTableObj->age = $request->age ?? "";
        $userTableObj->email = $request->email ?? auth()->user()->email;
        $userTableObj->contact_number = $request->contact_number ?? "";

        $userTableObj->door_number = $request->door_number ?? "";
        $userTableObj->street_name = $request->street_name ?? "";
        $userTableObj->pincode = $request->pincode ?? "";
        $userTableObj->area = $request->area ?? "";
        $userTableObj->district = $request->district ?? "";
        $userTableObj->state = $request->state ?? "";
        $userTableObj->country = $request->country ?? "";

        $userTableObj->instagram_username = $request->instagram_username ?? "";
        $userTableObj->facebook_username = $request->facebook_username ?? "";
        $userTableObj->website_url = $request->website_url ?? "";
        $userTableObj->twitter_username = $request->twitter_username ?? "";
        $userTableObj->github_url = $request->github_url ?? "";

        $userTableObj->save();

        return redirect('dashboard')->withSuccess('profile created successfully !');
    }

    public function editprofile(){
      $getUserId = auth()->user()->id;
      $userProfile = UserDetail::where("user_id",$getUserId)->first();
      return view('custom.profile.editprofile',compact('userProfile'));
    }

    public function updateprofile(Request $request){
        $getUserId = auth()->user()->id;
      
        $getUserData = [
            "full_name" => $request->full_name ?? "",
            "gender" => $request->gender ?? "",
            "relationship" => $request->relationship ?? "",
            "dob" => $request->dob ?? "",
            "age" => $request->age ?? "",
            "email" => $request->email ?? auth()->user()->email,
            "contact_number" => $request->contact_number ?? "",
            "door_number" => $request->door_number ?? "",
            "street_name" => $request->street_name ?? "",
            "pincode" => $request->pincode ?? "",
            "area" => $request->area ?? "",
            "district" => $request->district ?? "",
            "state" => $request->state ?? "",
            "country" => $request->country ?? "",
            "instagram_username" => $request->instagram_username ?? "",
            "facebook_username" => $request->facebook_username ?? "",
            "website_url" => $request->website_url ?? "",
            "twitter_username" => $request->twitter_username ?? "",
            "github_url" => $request->github_url ?? ""
        ];

        $userProfile = UserDetail::where("user_id",$getUserId)->update($getUserData);
        return redirect('dashboard')->withSuccess('updated created successfully !');
      }


    public function addprofile(){
        return view('custom.profile.create-profile');
      }
    

}
