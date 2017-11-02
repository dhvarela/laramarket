@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title or 'Markets' }}</div>
                    <div class="panel-body">

                        @if(Session::has('status_message'))
                            <p class="alert alert-success">{{ Session::get('status_message') }}</p>
                        @endif

                        @foreach($markets as $market)
                            <p>{{$market->name}} - {{$market->description}} - {{$market->active}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection