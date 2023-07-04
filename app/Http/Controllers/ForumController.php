<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Like;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;
use Illuminate\Support\Facades\Log;


class ForumController extends Controller
{
    
    public function forum(){
       if(auth()->user()){
        $getAllForm = Forum::where("is_active","1")->orderByDesc('created_at')->with('user','likeForum')->paginate(2);
        foreach($getAllForm as $getForm){
            $timeElapsed = $getForm->created_at->diffForHumans();
            $getForm->posted_at =  $timeElapsed;
            $getForm->likes_by_user =  $getForm->likeForum->count();
            $getAllForumLikes = $getForm->likeForum;
            foreach($getAllForumLikes as $getFormLike){
               if($getFormLike->user_id == auth()->user()->id){
                  $getForm->user_liked = 1;
               }
            }
        }
        return view('custom.profile.forum',compact('getAllForm'));
       }else{
        return redirect('/');
       }
    }

    public function createForum(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

       
        $forumObj = new Forum();
        $forumObj->user_id = auth()->user()->id  ?? "";
        $forumObj->description = $request->description ?? "";
        $forumObj->is_active = 1;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $mimeType = $image->getMimeType();
            if (strpos($mimeType, 'image/') === 0) {
                $forumObj->file_type = "image";
            }
        
            if (strpos($mimeType, 'video/') === 0) {
                $forumObj->file_type = "video";
            }

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('post_images'), $imageName);
            $forumObj->image_link = $imageName;
        }

        $forumObj->save();
        return redirect('forum')->withSuccess('Posted Successfully !');
    }
    
    public function deletePost($id){
        $updateData = [
            "is_active" => 0,
        ];
        $userProfile = Forum::where("id",$id)->update($updateData);
        return redirect('forum')->withSuccess('Deleted successfully post !');    

    }

    public function like($id){
        $forumLikeObj = new Like();
        $forumLikeObj->user_id = auth()->user()->id  ?? "";
        $forumLikeObj->post_id = $id ?? "";
        $forumLikeObj->save();
        return "liked successfully post !";    
    }

}
