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
            'relationship' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'pincode' => 'required',
            'area' => 'required',
            'district' => 'required',
            'state' => 'required',
            'country' => 'required'
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
        $userTableObj->pincode = $request->pincode ?? "";
        $userTableObj->area = $request->area ?? "";
        $userTableObj->district = $request->district ?? "";
        $userTableObj->state = $request->state ?? "";
        $userTableObj->country = $request->country ?? "";
        $userTableObj->save();

        return redirect('dashboard')->withSuccess('profile created successfully !');
    }

}
