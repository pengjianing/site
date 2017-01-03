@extends('app')
@section('content')
    @include('editor::head')
    <div class="container" style="margin-top: 100px;">
        <div class="row">
            <div class="col-md-9 col-md-offset-1" role="main">
                {!! Form::open(['url' => '/discussion']) !!}

                 @include('forum.form')
                <div class="form-group">
                    {!! Form::submit('发表帖子', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop