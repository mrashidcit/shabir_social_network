@extends('profile.master')

@section('content')
<div class="container">
<ol class="breadcrumb">
        <li><a href="{{url('/home')}}">Home</a></li>
        <li><a href="{{url('/profile')}}/{{Auth::user()->slug}}">Profile</a></li>
        <li><a href="{{url('request')}}">Friend requests</a></li>
    </ol>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}</div>

                <div class="panel-body">
                <div class="col-md-4">
                    Wellcome {{ Auth::user()->name }} Into Your Profile
                     
                    <img src="{{url('../')}}/img/{{ Auth::user()->pic }}" width="100px" height="100px"/>
                     
                     <form method="post" action="{{url('upload')}}" enctype="multipart/form-data">
                      
                      <input type="file" name="pic" class="from-control"/>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                      <input type="submit" class="btn btn-success">
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
