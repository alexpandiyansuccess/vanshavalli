<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Models\User;
use App\Models\Nodes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\Log;

class UserDetailController extends Controller
{
    public function createprofile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'pincode' => 'required',
            'district' => 'required',
            'state' => 'required',
            'about_me' => 'required',
            'occupation' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $userTableObj = new UserDetail();
        $userTableObj->user_id = auth()->user()->id  ?? "";
        $userTableObj->first_name = $request->first_name ?? "";
        $userTableObj->last_name = $request->last_name ?? "";

        $userTableObj->gender = $request->gender ?? "";
        $userTableObj->email = $request->email ?? auth()->user()->email;
        $userTableObj->contact_number = $request->contact_number ?? "";

        $userTableObj->pincode = $request->pincode ?? "";
        $userTableObj->district = $request->district ?? "";
        $userTableObj->state = $request->state ?? "";

        $userTableObj->occupation = $request->occupation ?? "";
        $userTableObj->about_me = $request->about_me ?? "";

        $userTableObj->save();

        return redirect('dashboard')->withSuccess('profile created successfully !');
    }

    public function editprofile(){
        if(auth()->user()){
            $getUserId = auth()->user()->id;
            $userProfile = UserDetail::where("user_id",$getUserId)->first();
            if($userProfile){
              return view('custom.profile.editprofile',compact('userProfile'));
            }else{
              return redirect('dashboard')->withSuccess('create profile then proceed successfully !');
            }
        }else{
            return redirect('/');
        }
     
    }

    public function updateprofile(Request $request){
        $getUserId = auth()->user()->id;
      
        $getUserData = [
            "first_name" => $request->first_name ?? "",
            "last_name" => $request->last_name ?? "",
            "gender" => $request->gender ?? "",
            "email" => $request->email ?? auth()->user()->email,
            "contact_number" => $request->contact_number ?? "",
            "pincode" => $request->pincode ?? "",
            "district" => $request->district ?? "",
            "state" => $request->state ?? "",
            "about_me" => $request->about_me ?? "",
            "occupation" => $request->occupation ?? ""
        ];
        

        $userProfile = UserDetail::where("user_id",$getUserId)->update($getUserData);
        return redirect('dashboard')->withSuccess('updated created successfully !');
      }


    public function addprofile(){
        if(auth()->user()){
            return view('custom.profile.create-profile');
           }else{
            return redirect('/');
           }

      }

      public function familyTree(){
        if(!auth()->user()){
            return redirect('/');
        }
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
            if($request->input('removeNodeId')){
                $nodeArray = $request->input('updateNodesData');
            }else{
                if($jsonData == "[]"){
                    $nodeArray =  $request->input('updateNodesData');
                }else{
                    $nodeArray = $jsonData;
                }
            }
            Nodes::where("user_id",$getUserId)->update([
                "node_array"=>$nodeArray
            ]);
        }

        $getData = Nodes::where("user_id",$getUserId)->first();

        return response()->json($getData->node_array);
    }



    public function manageTree(){
        if(auth()->user()){
            return view('custom.profile.create-profile');
           }else{
            return redirect('/');
           }
      }

      public function deletetree(){
        $getUserId = auth()->user()->id;
         Nodes::where('user_id',$getUserId)->delete();
        return redirect('create-chart')->withSuccess('Deleted successfully.Kindly create node then proceed !');    

      }

      public function invite($id){
        $getUserId = $id;
        $fileContents = Nodes::where("user_id",$getUserId)->first();
        if($fileContents){
            if($fileContents){
                $jsonData = json_decode($fileContents->node_array);
                return view('custom.profile.famil-tree-invite',compact('jsonData'));
            }else{
                return redirect('create-chart')->withSuccess('Kindly create node then proceed !');
            }
        }else{
            return redirect('/');
        }


      }

      public function onUpdateNodeDataInvite(Request $request)
      {

        $headers = $request->headers->all();
        $userId = $request->header('user_id');
   
          $jsonFilePath = public_path('json/file.json');
  
          // Read the JSON file
  
          $getUserId = $userId;
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
  
          $getUserId = $userId;
          $checkIfExist = Nodes::where("user_id",$getUserId)->first();
          
          if($checkIfExist){
              if($request->input('removeNodeId')){
                  $nodeArray = $request->input('updateNodesData');
              }else{
                  if($jsonData == "[]"){
                      $nodeArray =  $request->input('updateNodesData');
                  }else{
                      $nodeArray = $jsonData;
                  }
              }
              Nodes::where("user_id",$getUserId)->update([
                  "node_array"=>$nodeArray
              ]);
          }
  
          $getData = Nodes::where("user_id",$getUserId)->first();
  
          return response()->json($getData->node_array);
      }

      public function uploadImage(Request $request)
      {
          if ($request->hasFile('image')) {
              // Validate the uploaded file (optional)
              $request->validate([
                  'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
              ]);
  
              // Save the image to the desired location
              $image = $request->file('image');

              $imageName = time() . '.' . $image->getClientOriginalExtension();
              $image->move(public_path('user_images'), $imageName);

               $getUserId = auth()->user()->id;
      
                $getUserData = [
                    "remember_token" => $imageName ?? "",
                ];
        

             $userProfile = User::where("id",$getUserId)->update($getUserData);

              return back()->with('success', 'Image uploaded successfully!');
          }
  
          return back()->with('error', 'Please select an image to upload.');
      }
  

}
