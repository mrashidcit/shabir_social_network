<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\AUTH;
use Illuminate\Support\Facades\HASH;
use Illuminate\Support\Facades\input;
use App\Http\Requests;
use App\friendships;
use App\notifcations;
use Illuminate\Http\Request;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
    $userData = DB::table('users')
    ->leftJoin('profiles', 'profiles.user_id','users.id')
    ->where('slug', $slug)
    ->get();
        return view('profile.index', compact('userData'))->with('data', Auth::user()->profile);
       
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
    public function update(Request $request,$id)
    {
 //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function uploadimg(Request $request) {
        $file = $request->file('pic');
        $filename = $file->getClientOriginalName();
        $path = 'img';
        $user_id = Auth::user()->id;
        $file->move($path,$filename);
        DB::table('users')->where('id',$user_id)->update(['pic'=>$filename]);
        return view('profile.edit')->with('data', Auth::user()->profile);
    }
    public function Findfriends() {
            $uid = Auth::user()->id;
    $allUsers = DB::table('users')->leftJoin('profiles','users.id', '=' , 'profiles.user_id')->where('users.id', '!=', $uid)->get();
      
     return view('profile.findFriends', compact('allUsers'));
    }

     public function sendRequest($id) {
        Auth::user()->addFriend($id);
        return back();
    }

  public function request() {
        $uid = Auth::user()->id;
        $FriendRequests = DB::table('friendships')
                        ->rightJoin('users', 'users.id', '=', 'friendships.requester')
                        ->where('status', '=', Null)
                        ->where('friendships.user_requested', '=', $uid)->get();
        return view('profile.requestes', compact('FriendRequests'));
    }
  public function accept($name, $id) {
        $uid = Auth::user()->id;
        $checkRequest = friendships::where('requester', $id)
                ->where('user_requested', $uid)
                ->first();
        if ($checkRequest) {
            // echo "yes, update here";
            $updateFriendship = DB::table('friendships')
                    ->where('user_requested', $uid)
                    ->where('requester', $id)
                    ->update(['status' => 1]);

                  $notifcations = new notifcations;
                  $notifcations->note = 'accepted your friend request';
                  $notifcations->user_hero = $id;  
                  $notifcations->user_logged = Auth::user()->id;
                  $notifcations->status = '1';
                  $notifcations->save();    
            
                return back()->with('msg', 'You are now Friend with ' . $name);
            
        } else {
            return back()->with('msg', 'You are now Friend with this user');
        }
    }
  public function friends() {
        $uid = Auth::user()->id;
        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();
        //dd($friends1);
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1) 
                ->where('user_requested', $uid)
                ->get();
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('profile.friends', compact('friends'));
    }
    public function requestRemove($id) {
          DB::table('friendships')
                ->where('user_requested', Auth::user()->id)
                ->where('requester', $id)
                ->delete();
        return back()->with('msg', 'Request has been deleted');
    
    }
    public function friendRemove($name,$id) {
          DB::table('friendships')
                ->where('user_requested', Auth::user()->id)
                ->where('requester', $id)
                ->delete();
        return back()->with('msg', $name.' has been Unfriend');
    
    }
    public function notifications($id) {
         $uid = Auth::user()->id;
        $notes = DB::table('notifcations')
                ->leftJoin('users', 'users.id', 'notifcations.user_logged')
                ->where('notifcations.id', $id)
                ->where('user_hero', $uid)
                ->orderBy('notifcations.created_at', 'desc')
                ->get();
        $updateNoti = DB::table('notifcations')
                     ->where('notifcations.id', $id)
                    ->update(['status' => 0]);
       return view('profile.notifications', compact('notes'));
    }

    public function updateProfile(Request $request) {
        $user_id = Auth::user()->id;

        DB::table('profiles')->where('user_id',$user_id)->update($request->except('_token'));
       return view('profile.edit')->with('data', Auth::user()->profile);
       
    }
    
}