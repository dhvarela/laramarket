@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Market</div>
                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <b>An error occurred</b>
                                <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form-horizontal" action="{{route('markets.edit', $market->id)}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <div class="input">
                                    <label for="name" class="col-md-4 control-label">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="market-name" required value="{{old('name', $market->name)}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <div class="input">
                                    <label for="name" class="col-md-4 control-label">Description</label>
                                    <div class="col-md-6">
                                        <input type="text" name="description" id="market-description" required value="{{old('description', $market->description)}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                                <div class="input">
                                    <div class="col-md-6 col-md-offset-4">
                                        <label>
                                            <input type="checkbox" name="active" id="market-active"
                                                   {{ old('active', $market->active) ? 'checked' : '' }} value="1"/> Active
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection