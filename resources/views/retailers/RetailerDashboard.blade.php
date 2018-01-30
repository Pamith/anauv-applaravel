@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ Auth::user()->name }}'s Dashboard</div>
                <div class="panel-body">
                    <div class="alert alert-success">
                    @if ($msg)
                     <a href="{{$msg['url']}}">{{$msg['msg']}}</a>
                    @endif
                    </div>
                    @if ($offers)
                      @foreach($offers as $offer)
                        <div class='col-md-4'>
                            <h3>{{$offer->short_desc}}</h3></br>                           
                            <label class="control-label">Shop Name:</label>{{ $offer->ShopName }}</br>
                            <label class="control-label">Offer Description:</label>{{ $offer->offer_desc}}</br>
                            <label class="control-label">Code Prefix:</label>{{$offer->offer}}</br>
                            <label class="control-label">Start Date:</label>{{$offer->offer_start}}</br>
                            <label class="control-label">End Date:</label>{{$offer->offer_end}}</br>
                            <label class="control-label">Address:</label>{{$offer->address}}</br>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
