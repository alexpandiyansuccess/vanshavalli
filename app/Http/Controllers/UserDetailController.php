<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\Nodes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;

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

      public function familyTree(){
        $getUserId = auth()->user()->id;
        $fileContents = Nodes::where("user_id",$getUserId)->first();
        if($fileContents){
            $jsonData = json_decode($fileContents->node_array);
            return view('custom.profile.family-tree',compact('jsonData'));
        }else{
            return redirect('create-chart')->withSuccess('Kindly create node then proceed !');
            
        }

      }
    
      
    public function createNode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
            'node_gender' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('code', 0);

            return response()->json($validator->messages(), 200);
        }

        $createJson = [
                        [
                            "gender" => $request->node_gender,
                            "id" => "1",
                            "name" => $request->node_name
                        ]
                    ];
        $fileContents = json_encode($createJson);
        $getUserId = auth()->user()->id;
        $checkIfExist = Nodes::where("user_id",$getUserId)->exists();
        if($checkIfExist == false){
            $createNode = new Nodes;
            $createNode->user_id = auth()->user()->id  ?? "";
            $createNode->node_array = $fileContents;
            $createNode->save();
            return redirect('familyTree')->withSuccess('Node created successfully !');
        }else{
            return redirect('familyTree')->withSuccess('Node already created successfully !');
        }
        
    }

    public function onUpdateNodeData(Request $request)
    {
 
        $jsonFilePath = public_path('json/file.json');

        // Read the JSON file

        $getUserId = auth()->user()->id;
        $checkIfExist = Nodes::where("user_id",$getUserId)->first();
        $jsonData = $checkIfExist->node_array;

        // Parse the JSON data into an array
        $nodes = json_decode($jsonData, true);


        // Add nodes from the request
        foreach ($request->input('addNodesData', []) as $node) {
            $nodes[] = $node;
        }

        // Update nodes from the request
        foreach ($request->input('updateNodesData', []) as $node) {
            $index = array_search($node['id'], array_column($nodes, 'id'));

            if ($index !== false) {
                $nodes[$index] = $node;
            }
        }

        // Remove nodes based on the condition
        $removeNodeId = $request->input('removeNodeId');
        $nodes = array_filter($nodes, function ($node) use ($removeNodeId) {
            return $node['id'] !== $removeNodeId;
        });

        // Convert the array back to JSON
        $jsonData = json_encode($nodes);

        $getUserId = auth()->user()->id;
        $checkIfExist = Nodes::where("user_id",$getUserId)->first();
        
        if($checkIfExist){
            Nodes::where("user_id",$getUserId)->update([
                "node_array"=>$jsonData
            ]);
        }

        $getData = Nodes::where("user_id",$getUserId)->first();
        // Write the JSON data back to the file
        // File::put($jsonFilePath, $jsonData);

        return response()->json($getData->node_array);
    }

    public function manageTree(){
        return view('custom.profile.create-profile');
      }
}
