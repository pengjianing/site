<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>如此.</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- 自定义样式 -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- 图片 -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home-template">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="position:absolute;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="{{ asset(env('logo')) }}" alt="logo" class="media-object" width="60px"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">主页</a></li>
                {{--<li><a href="#about">About</a></li>--}}
                {{--<li><a href="#contact">Contact</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li><a href="#">Action</a></li>--}}
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li class="divider"></li>--}}
                        {{--<li class="dropdown-header">Nav header</li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a id="dLabel" type="button" data-toggle="dropdown">
                             {{ Auth::user()->name }}
                        </a>
                        <!--下拉菜单 -->
                        <ul class="dropdown-menu" aria-labelledby="dLabel" role="menu">
                            <li><a href="/user/avatar"> <i class="glyphicon glyphicon-edit"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="glyphicon glyphicon-user"></i> 更换密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/logout"><i class="glyphicon glyphicon-hand-right"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <img src="{{ Auth::user()->avatar }}" alt="" class="img-circle">
                    {{--<li><a href="/logout">退出登录</a></li>--}}
                @else
                    <li><a href="/user/register">注册</a></li>
                    <li><a href="javascript:void(0);" id="login">登录</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
<!--登录弹出层-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    <script>
                        $(document).ready(function () {
                            $('#myModal').modal();
                        });
                    </script>
                @endif
                @if(Session::has('user_login_failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('user_login_failed') }}
                    </div>
                        <script>
                            $(document).ready(function () {
                                $('#myModal').modal();
                            });
                        </script>
                @endif
                {!! Form::open(['url'=>'/user/login', 'id' => 'form']) !!}


                <div class="form-group">
                    {!! Form::label('email', '邮箱:') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', '密码:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                    {!! Form::submit('登录', ['class' => 'btn btn-success form-control']) !!}
                    {!! Form::close() !!}
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>--}}
                {{--<button type="button" id="btn_submit" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>保存</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<hr>
<footer>
    <div class="container" style="text-align: center;">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
                <p class="copyright">Copyright © ning</p>
            </div>
        </div>
    </div>
</footer>
<script>
    $('#login').click(function(){
      // $('#myModalLabel').text('登录')
        $('#myModal').modal();
    });

</script>
</body>
</html>