@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or 'Stocks' }}</div>

                <div class="panel-body">

                    @if (Session::has('status_message'))
                        <p class="alert alert-success">{{ Session::get('status_message') }}</p>
                    @endif

                    @if (Session::has('error_message'))
                        <p class="alert alert-danger">{{ Session::get('error_message') }}</p>
                    @endif

                    @if (!Auth::check())
                        <p class="alert alert-info">To be able to subscribe to a stock, please <a href="/login">login</a></p>
                    @endif

                    <ul class="list-group">
                    @foreach($stocks as $stock)

                        <li class="list-group-item row">
                            <div class="col-lg-6 col-xs-6">
                                {{$stock->id}} - {{$stock->name}} - {{$stock->acronym}}
                            </div>
                            <div class="col-lg-6 col-xs-6">
                                <div class="pull-right">
                                    <div class="btn-group">
                                        @if (Auth::check())
                                            <form action="{{route('user_stocks.create')}}" method="post">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="stock_id" id="stock_id" value="{{$stock->id}}">
                                                <button type="submit" class="btn btn-primary">Subscribe</button>

                                            </form>
                                        @endif
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('stock_historicals_chart',$stock->id) }}" class="btn btn-info">View</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
