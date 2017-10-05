<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\AUTH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\input;

use App\post;
use App\like;
use App\comment;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
     $postData =  DB::table('posts')
     ->leftJoin('users','users.id','u_id')
     ->get();
     return view('home',compact('postData'));
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
    public function store(Request $request,$id)
    {
        $s = new POST;
        $id = Auth::user()->id; 
        $s->u_id=$id;
        $s->p_note=input::get('p_note');
    $file = input::file('p_image');
       $file->move('img',$file->getClientOriginalName());
        $s->p_image=$file->getClientOriginalName();;
        $s->save();
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
     $id = Auth::user()->id;
     echo $id;
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

/* load comment */




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$p_note)
    {
        $name = Auth::user()->name;
        $s = new like;
        $s->u_id = Auth::user()->id;
        $s->p_id = $id;
        $s->l_note = $name.' Likes Your Post '.$p_note;
        $s->p_status = '1';
        $s->save();
        return back();
    }  
    public function Unlike(Request $request, $id) {
        DB::table('likes')
        ->where('u_id',Auth::user()->id)
        ->where('p_id',$id)
        ->update(['p_status' => 0]);
        return back();
    }






    public function Comments(Request $request, $post_id) {

    // return response()->json([
    //     'name' => 'hello',
    //     'state' => 'CA'
    // ], 200);

    $user_id = Auth::user()->id;

    // dd($user_id);

    $comment = comment::CREATE([
        'u_id' => $user_id,
        'c_id' => $post_id,
        'comment' => $request->comment
        
    ]);

    return response()->json([
        'comment' => $comment
    ], 200);


    // if($request->ajax()) {  
    //     $c = new Comment;
    //     $c->u_id = Auth::user()->id;
    //     $c->c_id = $id;
    //     $c->comment=input::get('comment');
    //     $c->save();
    //     response($comments);
    //     return back();

    // }
    
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
}
