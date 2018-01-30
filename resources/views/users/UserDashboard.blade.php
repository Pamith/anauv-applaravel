@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}'s Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                            {{ $status }}
                        </div>
                    @endif
                    <div align="center">
                    @if(!empty($interests)) 
                          <h2 align="center">These Are Your Interests</h2>

                        @foreach($interests as $interest)
                        <span class="btn btn-default filter-button interests" data-filter="{{$interest->id}}">{{$interest->name}}</span>
                        @endforeach
                    @endif    
                    </div>
                    <a href="{{url('user/interests')}}"><button class="btn btn-default">Update Your Interests</button></a>
                    <a href="{{url('user/edit')}}"><button class="btn btn-default">Update Your Profile</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection