@extends('app')
@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media pull-left">
                <div class="media-left">
                    <a href="#">
                        <img src="{{ $discussion->user->avatar }}" alt="60x60" class="meida object img-circle" style="width:60px;height:60px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}
                </div>
            </div>
            @if(Auth::check() && Auth::user()->id == $discussion->user_id)
            <a class="btn btn-primary btn-lg pull-right" href="/discussion/{{ $discussion->id }}/edit" role="button">修改帖子</a>
            @endif
        </div>
    </div>
    <div class="container">
        <div class="row" id="post">
            <div class="col-md-9" role="main" style="margin-bottom: 50px;">
                <div class="blog-post">
                    {!! $html !!}
                </div>
                <hr>
                @foreach($discussion->comment as $comments)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img src="{{ $comments->user->avatar }}" alt="64x64" class="media-object img-circle" style="width:64px;height:64px;">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{ $comments->user->name }}
                            </h4>
                            {!! $comments->body !!}
                        </div>
                    </div>
                @endforeach
                <hr>
                @if(Auth::check())
                    @include('editor::head')
                {!! Form::open(['url' => '/comment', 'v-on:submit' => 'onSubmitForm']) !!}
                {!! Form::hidden('discussion_id', $discussion->id) !!}
                <div class="form-group">
                    <div class="editor">
                        {!! Form::textarea('body', null, ['class' => 'form-control','id'=>'myEditor', 'v-model' => 'newComment.body']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::submit('发表评论',['class' => 'btn btn-success pull-right']) !!}
                </div>
                {!! Form::close() !!}
                    @else
                    <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
                @endif
            </div>
        </div>
    </div>
    <script>
    </script>
@stop