@extends('layouts.app')

@section('content')
{{--<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or 'Stocks' }}</div>

                <div class="panel-body">
                    <ul class="list-group">
                    @foreach($stocks as $stock)

                        <li class="list-group-item row">
                            <div class="col-lg-6 col-xs-6">
                                {{$stock->id}} - {{$stock->name}} - {{$stock->acronym}}
                            </div>
                            <div class="col-lg-6 col-xs-6">
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>--}}
@endsection
