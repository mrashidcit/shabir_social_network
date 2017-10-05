@extends('profile.master')
@section('content')   
 
<div class="row">
<div class="col-sm-3" id="left-side-bar">
<div class="panel panel-default">
<div class="panel panel-heading">Quick Links</div>
<div class="panel-body">




            </div>
       </div>
  </div> 
</div>
 <div class="post">
<div class="col-md-8 col-md-offset-3">
<div class="panel panel-default">
<div class="panel-heading">{{Auth::user()->name}}</div>
<div class="panel-body">
<form method="post" action="/postsend/{{Auth::user()->id}}" enctype="multipart/form-data">
<div class="form-group">
  <textarea class="form-control" id="post_status" name="p_note" style="border-radius:15px; border-opacity:0; border:1px solid white;"  rows="3" placeholder="Whats in Your Mind!" id="comment"></textarea>
<input type="file" name="p_image"  class="col-xm-4"></input>
<input type="hidden" name="_token" value="{{csrf_token() }}">
<input type="submit" value="Send" class="btn btn-success pull-right" name="submit"  ></input>
</div>
</form>
</div>
</div>
</div>

     <div class="container" id="container">
     <script type="text/javascript">
   

</script>
      
             @foreach($postData as $pd)
             <div id="post_body">
                  <div class="panel panel-default">
                <div class="panel-heading"><h3 style="display:inline-block; color:blue;">{{$pd->name}}</h3> <h4 style="display:inline-block">Updated Post at {{$pd->updated_at}}</h4></div>
                   <div class="panel-body">
                   <p>{{$pd->p_note}}</p>
                <div style="height:500px; width:500px;overflow:hidden;">
                  <img class="img-responsive" src="{{url('../')}}/img/{{ $pd->p_image }}" align="center"  margin-left="10%" margin-right="10%"></img>

                </div>
             
            <hr>    
            <?php 
           $check = DB::table('likes')
                                        ->where('p_id', '=', $pd->id)
                                        ->where('u_id', '=', Auth::user()->id)
                                        ->where('p_status', '=' , 1)
                                        ->first();
                                if($check ==''){
            ?>
            <a href="{{URL::to('likes')}}/{{$pd->id}}/{{$pd->p_note}}"><p style="display:inline-block; color:black;">Like</p></a>
                   {{App\like::where('p_status', 1)
                                    
                                     ->where('p_id',$pd->id)
                                      ->count()}}
            <?php } else { ?>
                  <a href="{{URL::to('Unlikes')}}/{{$pd->id}}/{{$pd->p_note}}"><p style="display:inline-block; color:blue;">Like</p></a>
                {{App\like::where('p_status', 1)
                                    
                                     ->where('p_id',$pd->id)
                                      ->count()}}
            <?php } ?>
            
                 <button class="col-sm-2" id="btn_comment" onclick="show()" class="btn btn-success"><p style="display:inline-block;">{{App\comment::where('c_id', '=' , $pd->id)->count()}}</p>Comments</button>
                 <div id="comment">
                                    <form method="post" class="comment_insert" action="{{URL::to('comment')}}/{{$pd->id}}">
                                      {{ csrf_field() }}
                                      <div class="form-group">
                                        <div class="col-sm-4">
                                          <input type="text" name="comment" id="com_val" class="form-control" placeholder="Enter Your Comment Here" autofocus></input>

                                         
                                           <input type="submit" name="submit" value="submit"></input>
                                        </div>
                                      </div>
                                    </form>
                                    {{--  <button class="save_comment" >Save</button>  --}}
                                    
                                    <br>
                                    <br>
                                     <?php $comment = DB::table('comments')
                                      ->leftJoin('users', 'users.id', 'comments.u_id')
                                    
                                    ->where('c_id', $pd->id)
                                       ->orderBy('comments.created_at', 'desc')
                                       ->limit('2')
                                    ->get(); ?>
                                      <ul>
                                      @foreach($comment as $com)
                                        
                                <li>
                                    <p><a href="{{url('/profile')}}/{{$com->slug}}" style="font-weight: bold; color:green">
                                            <img src="{{URL('../')}}/img/{{$com->pic}}" with="50px" height="50px"></img>{{$com->name}}</a> {{$com->comment}}</p> <p style="display:inline-block; float:right;">{{$com->updated_at}}</p>
                                </li><hr>
                                
                                      @endforeach
                                       <button type="btn" name="load" value="Load More" class="btn btn-success">Load More</button>
                                      </ul>
                                    </div>
                                    
                                    
                                    
                           </div>
                        </div>
                        </div>
                        @endforeach
             </div>

              {{--  <script src="{{ asset('js/home.js') }}"></script>     --}}
@endsection