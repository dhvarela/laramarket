@extends('layouts.app')

@section('content')
    <div class="container">
        <p>{{ $market->name }} - {{ $market->description }} - {{ $market->active }}</p>
    </div>
@endsection