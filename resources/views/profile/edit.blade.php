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
                  <div class="panel panel-heading">{{ Auth::user()->name }}</div>
                         <div class="panel-body">
                         <div class="col-sm-12 col-md-12">
                          <div class="thumbnail">
                          <h3 align="center">{{ Auth::user()->name }}</h3>
                                       <img src="{{url('../')}}/img/{{ Auth::user()->pic }}" align="center" width="120px" height="120px"></img>
                                       <p align="center">{{ $data->country }}</p>
                                       <p align="center"><a href="{{URL::to('changepic')}}"><button class="btn btn-success">Change Picture</button></a></p>
                          </div>
                          </div>
    <form class="form-horizontal" action="{{URL::to('updateprofile')}}" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="contact">Contact:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="{{$data->contact }}" name="contact">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="country">Country:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" value="{{$data->country}}" name="country">
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-2" for="address">Address:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="pwd" value="{{ $data->address }}" name="address">
      </div>
    </div>
        <div class="form-group">
      <label class="control-label col-sm-2" for="about">About:</label>
      <div class="col-sm-10">          
        <input type="text" class="form-control" id="pwd" value="{{ $data->about }}" name="about">
      </div>
    </div>
 
 
        <div class="form-group">        
      <label class="control-label col-sm-2" for="Education">Education</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" value="{{ $data->Education }}" name="Education"></input>
        </div>

    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
                         </div>
                  </div>
                  
@endsection
