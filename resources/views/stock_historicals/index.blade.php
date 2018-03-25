@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $title or 'Stock Historicals' }}</div>

                <div class="panel-body">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! $stock_chart !!}
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Value</th>
                                <th>SMA6</th>
                                <th>SMA70</th>
                                <th>SMA200</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($stock_historicals as $stock)
                            <tr>
                                <td>{{$stock->date->format('d/m/Y')}}</td>
                                <td>{{$stock->value}}</td>
                                <td>{{$stock->avg_6}}</td>
                                <td>{{$stock->avg_70}}</td>
                                <td>{{$stock->avg_200}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
