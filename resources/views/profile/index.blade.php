@extends('profile.master')

@section('content')
<div class="container">
 <ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="{{url('friends')}}">Find Friends</a></li>
        <li><a href="{{url('friendlist')}}">Friends</a></li>
    </ol>
    <div class="row">
        <div class="col-sm-3">
        <div class="panel panel-default">
        <div class="panel panel-heading">Quick Links</div>
            <div class="panel-body">




            </div>
       </div>
  </div>
  @foreach($userData as $uData)
        <div class="col-md-9">
         
            <div class="panel panel-default">
              <div class="panel panel-heading">{{ $uData->name }}</div>
              <div class="panel-body">
                    <div class="col-sm-4">
                          <div class="thumbnail">
                          <h3 align="center">{{ $uData->name }}</h3>
                                       <img src="{{url('../')}}/img/{{ $uData->pic }}" align="center" width="120px" height="120px"></img>
                                       <p align="center">{{ $uData->country }}</p>
                                       @if ($uData->user_id == Auth::user()->id)
                                        <p align="center"><a href="{{URL::to('editprofile')}}/{{$uData->slug}}"><button class="btn btn-success">Edit Profile</button></a></p>
                                             @endif                       
                          </div>
                          </div>
                          </div>
                          
                       @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
