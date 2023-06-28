<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Relation;
use App\Models\SecondProfile;
use Validator;
use Auth;
use Facade\FlareClient\Http\Response;
use Mail;
use Config;

class OrgController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $idarr = [];

    public function updatepicture(Request $request)
    {
        $node = Profile::find($request['node_id']);
        $node->picture = $request['node_picture'];
        $node->save();
        return json_encode(['code' => [$node->id]]);
    }

    public function addparent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('code', 0);

            return response()->json($validator->messages(), 200);
        }

        $node = new Profile();
        $node->profile_name = $request['node_name'];
        $node->designation = $request['designation'];
        $node->color_code = Config::get('color.' . $request['color']);
        $node->root_id = 0;
        $node->save();

        $oldroot = Profile::find($request['child_id']);
        $oldroot->root_id = $node->id;
        $oldroot->save();

        Profile::where('root_id', $oldroot->id)->update(['root_id' => $node->id]);

        $relation = new Relation();
        $relation->parent_id = $node->id;
        $relation->child_id = $oldroot->id;
        $relation->save();
        return json_encode(['code' => $node->id]);
    }

    public function multi_delete(Request $request)
    {
        if (!$request->node_ids) {
            return response()->json(['message' => 'Something went Wrong.'], 500);
        }

        foreach ($request->node_ids as $node_id) {
            $node = Profile::find($node_id);

            $this->deletenode($node);

            array_push($this->idarr, (int) $node_id);

            Relation::whereIn('child_id', $this->idarr)->delete();
            $this->removeImages($this->idarr);
            Profile::whereIn('id', $this->idarr)->delete();
        }
        return response()->json(['message' => 'Deleted Successfully'], 200);
    }

    public function delete(Request $request)
    {
        $node = Profile::find($request['node_id']);
        $this->deletenode($node);
        array_push($this->idarr, (int) $request['node_id']);
        Relation::whereIn('child_id', $this->idarr)->delete();
        
        $this->removeImages($this->idarr);
        Profile::whereIn('id', $this->idarr)->delete();
        return response()->json($this->idarr, 200);
    }


    public function removeImages($idsarray){
        foreach ($idsarray as $profile_id) {
            $profile = Profile::where('id', $profile_id)->first();
            if ($profile) {
                $this->removeProfileImage($profile);
                if ($profile->secondProfile) {
                    $this->removeProfileImage($profile->secondProfile);
                }
            }
        }
    }

    public function removeProfileImage($profile)
    {
        if (file_exists('profile_images/' . $profile->picture) && $profile->picture != null) {
            unlink('profile_images/' . $profile->picture);
        }
    }

    private function deletenode($node)
    {
        if ($node->children->count()) {
            foreach ($node->children as $child) {
                array_push($this->idarr, $child->id);

                $this->deletenode($child);
            }
        }
    }
    public function deleteproject(Request $request)
    {
        $project = Org::find($request['id']);
        $project->delete();

        return json_encode(['code' => [1]]);
    }
    public function exportchart($id)
    {
        $camp = Profile::find($id);

        $tree = view('tree2', ['root' => $camp]);

        $html = '<html lang="en"><head><meta charset="utf-8" /><title> Project' . $camp->profile_name . ' Chart</title>~~</head><body><div class="tree">' . $tree . '</div></body></html>';

        return view('export', ['tree' => $tree, 'html' => $html]);
    }

    public function deletemember(Request $request)
    {
        $deletedRows = Member::where('organisation_id', $request['campaign_id'])
            ->where('teamid', $request['team_id'])
            ->where('memberid', $request['member_id'])
            ->delete();

        return json_encode(['code' => [1]]);
    }

    public function savememdetails(Request $request)
    {
        $mem = Member::where('organisation_id', $request['campaign_id'])
            ->where('teamid', $request['team_id'])
            ->where('memberid', $request['member_id'])
            ->first();
        $mem->membername = $request['member_name'];
        $ret = $mem->save();

        return json_encode(['code' => [1]]);
    }

    public function addmember(Request $request)
    {
        $i = $request['team_id'];
        $j = $request['member_id'];

        $team = Team::where('organisation_id', $request['campaign_id'])
            ->where('teamid', 'team' . $i)
            ->first();

        $member = new Member();
        $member->organisation_id = $request['campaign_id'];
        $member->teamid = 'team' . $i;
        $member->memberid = 'member' . $j;
        $member->team_id = $team->id;
        $member->membername = 'Member ' . $j;
        $member->save();

        return json_encode(['code' => [1]]);
    }

    public function deleteteam(Request $request)
    {
        $deletedRows = Team::where('organisation_id', $request['campaign_id'])
            ->where('teamid', $request['team_id'])
            ->delete();

        return json_encode(['code' => [1]]);
    }

    public function saveteamdetails(Request $request)
    {
        $team = Team::where('organisation_id', $request['campaign_id'])
            ->where('teamid', $request['team_id'])
            ->first();
        $team->teamname = $request['team_name'];
        $ret = $team->save();

        return json_encode(['code' => [1]]);
    }

    public function savecampdetails(Request $request)
    {
        $camp = Org::find($request['campaign_id']);
        $camp->orgnisationname = $request['campaign_name'];
        $ret = $camp->save();

        return json_encode(['code' => [1]]);
    }

    public function addteam(Request $request)
    {
        $i = $request['team_id'];

        $team = new Team();
        $team->teamid = 'team' . $i;
        $team->organisation_id = $request['campaign_id'];
        $team->teamname = 'Team ' . $i;
        $team->save();

        for ($j = 1; $j <= 2; $j++) {
            $member = new Member();
            $member->organisation_id = $request['campaign_id'];
            $member->teamid = 'team' . $i;
            $member->memberid = 'member' . $j;
            $member->team_id = $team->id;
            $member->membername = 'Member ' . $j;
            $member->save();
        }

        return json_encode(['code' => [1]]);
    }
    public function getchart1(Request $request)
    {
        $camp = Org::find($request['id']);
        $teams = Team::where('organisation_id', $camp->id)->get();

        $camphtml = "<a class='campaign' data-id='" . $camp->id . "' id='campaign'>Project <span id='campaigntext'>" . $camp->orgnisationname . '</span></a>';
        $teamhtml = '';
        foreach ($teams as $team) {
            $members = Member::where('organisation_id', $camp->id)
                ->where('team_id', $team->id)
                ->get();
            $memberhtml = '';
            foreach ($members as $member) {
                $memberhtml .= "<li><a class='member " . $member->memberid . "' ><span class='membertext'>" . $member->membername . '</span></a></li>';
            }

            $teamhtml .= "<li><a class='team' id='" . $team->teamid . "' ><span class='teamtext'>" . $team->teamname . '</span></a><ul>' . $memberhtml . '</ul></li>';
        }

        $tree = '<ul><li>' . $camphtml . "<ul id='team'>" . $teamhtml . '</ul></li></ul>';

        return json_encode(['tree' => $tree]);
    }

    public function getproject_(Request $request)
    {
        $camp = Org::all();

        return response()->json($camp, 200);
    }
    public function getproject(Request $request)
    {
        $camp = Profile::where('root_id', 0)->get();

        return response()->json($camp, 200);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('code', 0);

            return response()->json($validator->messages(), 200);
        }

        $node = Profile::find($request['node_id']);
        $node->profile_name = $request['node_name'];
        $node->save();

        return json_encode(['code' => [$node->id]]);
    }

    public function getchart(Request $request)
    {
        $camp = Profile::find($request['id']);

        return view('tree2', ['root' => $camp]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'node_name' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('code', 0);

            return response()->json($validator->messages(), 200);
        }
        $colors_array = config::get('color');
        $keys = array_keys($colors_array);
        $a = rand(1, 36);
        $b = $keys[$a];
        $random_color = config::get('color.' . $b);

        $node = new Profile();
        $node->profile_name = $request['node_name'];
        $node->user_id = Auth::user() ? Auth::user()->id : null;
        $node->root_id = $request['root_id'];
        $node->designation = $request['designation'];
        if ($request['root_id'] != 0) {
            $node->color_code = Config::get('color.' . $request['color']);
        } else {
            $node->color_code = $random_color;
        }
        $node->save();

        if ($request['root_id'] != 0) {
            $relation = new Relation();
            $relation->parent_id = $request['parent_id'];
            $relation->child_id = $node->id;
            $relation->save();
        }

        return response()->json(['code' => [$node->id]], 200);
    }

    public function create1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'no_of_teams' => 'required',
            'no_of_members' => 'required',
        ]);

        if ($validator->fails()) {
            $validator->errors()->add('code', 0);

            return response()->json($validator->messages(), 200);
        }

        $camp = new Org();
        $camp->orgnisationname = $request['project_name'];
        $camp->save();

        for ($i = 1; $i <= intval($request['no_of_teams']); $i++) {
            $team = new Team();
            $team->teamid = 'team' . $i;
            $team->organisation_id = $camp->id;
            $team->teamname = 'Team ' . $i;
            $team->save();

            for ($j = 1; $j <= intval($request['no_of_members']); $j++) {
                $member = new Member();
                $member->organisation_id = $camp->id;
                $member->teamid = 'team' . $i;
                $member->memberid = 'member' . $j;
                $member->team_id = $team->id;
                $member->membername = 'Member ' . $j;
                $member->save();
            }
        }

        return json_encode(['code' => [$camp->id]]);
    }
}
