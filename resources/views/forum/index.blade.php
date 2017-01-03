@extends('app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="pull-left">Write the code the way you speak it.</h2>
            <a class="btn btn-danger btn-lg pull-right" href="/discussion/create" role="button" style="margin-top:10px;">发布新帖子</a></p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <main class="col-md-8">
                {{--@foreach($discussions as $discussion)--}}
                    {{--<div class="post media">--}}
                        {{--<div style="margin-top: 25px;">--}}
                            {{--<div class="home-media-left media-left">--}}
                                {{--<a href="#">--}}
                                    {{--<img src="{{ $discussion->user->avatar }}" alt="60x60" class="media-object img-circle" style="width:60px;height:60px;">--}}
                                {{--</a>--}}
                            {{--</div>--}}
                            {{--<div class="home-media-body media-body">--}}
                                {{--<h4 class="media-heading">--}}
                                    {{--<a href="{{ url('/discussion/'.$discussion->id) }}">{{ $discussion->title }}</a>--}}
                                {{--</h4>--}}
                                {{--{{ $discussion->user->name }}--}}
                            {{--</div>--}}
                            {{--<div class="media-conversation-meta">--}}
                                {{--<span class="media-conversation-replies">--}}
                                {{--<a href="/discussion">{{ count($discussion->comment) }}</a>--}}
                                {{--回复--}}
                                {{--</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endforeach--}}
                @foreach($discussions as $discussion)
                    <article class="post">

                        <div class="post-head">
                            <h1 class="post-title"><a href="{{ url('/discussion/'.$discussion->id) }}">{{ $discussion->title }}</a></h1>
                            <div class="post-meta">
                                <span class="author">作者：{{ $discussion->user->name }}</span> •
                                <time class="post-date" datetime="{{ $discussion->created_at->diffForHumans() }}" title="{{ $discussion->created_at->diffForHumans() }}">{{ $discussion->created_at->diffForHumans() }}</time>
                            </div>
                        </div>

                        <div class="post-content">
                            {!! $discussion->body !!}
                        </div>
                        <div class="post-permalink">
                            <a href="{{ url('/discussion/'.$discussion->id) }}" class="btn btn-default">阅读全文</a>
                        </div>

                        {{--<footer class="post-footer clearfix">--}}
                            {{--<div class="pull-left tag-list">--}}
                                {{--<i class="fa fa-folder-open-o"></i>--}}

                            {{--</div>--}}
                            {{--<div class="pull-right share">--}}
                            {{--</div>--}}
                        {{--</footer>--}}
                    </article>
                @endforeach
                {{--分頁--}}
                <div class="pull-right">
                    {!! $discussions->render() !!}
                </div>
            </main>
                {{--about me--}}
            <aside class="col-md-4 sidebar text-center">
                <div class="widget">
                    <h4 class="title">关于我</h4>
                    <div class="content community">
                        <p style="margin-bottom: 20px;"><img src="{{ asset('images/coco.png') }}" alt="about me" class="media-object img-circle" style="width:80px; height:80px;"></p>
                        <p><a href="javascript:void(0)" title="a happy geek" target="_blank"><i class="fa fa-comments"></i> a happy geek</a></p>
                    </div>

                </div>
            </aside>

        </div>
    </div>
@stop