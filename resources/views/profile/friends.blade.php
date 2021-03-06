@extends('profile.master')

@section('content')
<div class="container">
<ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="{{url('request')}}">Friend requests</a></li>
    </ol>
    <div class="row">
        <div class="col-sm-3">
        <div class="panel panel-default">
        <div class="panel panel-heading">Quick Links</div>
            <div class="panel-body">




            </div>
       </div>
  </div>


        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">{{Auth::user()->name}}</div>

                <div class="panel-body">
                    <div class="col-sm-12 col-md-12">
                         @if ( session()->has('msg') )
                         <p class="alert alert-success">
                                      {{ session()->get('msg') }}
                                   </p>
                                @endif
                        @foreach($friends as $uList)

                        <div class="row" style="border-bottom:1px solid #ccc; margin-bottom:15px">
                            <div class="col-md-2 pull-left">
                                <img src="{{url('../')}}/img/{{$uList->pic}}" width="80px" height="80px" class="img-rounded"/>
                            </div>

                            <div class="col-md-7 pull-left">
                                <h3 style="margin:0px;"><a href="{{URL::to('profile')}}/{{$uList->slug}}">{{ucwords($uList->name)}}</a></h3>

                                <p><b>Gender:</b> {{$uList->gender}}</p>
                                   <p><b>Email:</b> {{$uList->email}}</p>

                            </div>

                            <div class="col-md-3 pull-right">
                          
                                     

                        <a href="{{url('/friendRemove')}}/{{ $uList->name }}/{{$uList->id}}"  class="btn btn-default btn-sm">UnFriend</a></p>
                                    
                            </div>

                        </div>
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection