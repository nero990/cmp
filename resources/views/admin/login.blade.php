<!DOCTYPE html>
<html>
<head>
    <title>Login | {{config('app.name')}}</title>
    <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/stylesheets/bootstrap.min.css")}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/stylesheets/font-awesome.min.css")}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/stylesheets/se7en-font.css")}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/stylesheets/style.css")}}" media="all" rel="stylesheet" type="text/css" />
    <link href="{{asset("admin/stylesheets/custom/final.css")}}" media="all" rel="stylesheet" type="text/css" />

    <script src="{{asset('admin/javascripts/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery.validate.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/jquery-ui.js')}}" type="text/javascript"></script>

    <script src="{{asset("admin/javascripts/bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{asset('admin/javascripts/custom/api-handler.js')}}" type="text/javascript"></script>
    <script src="{{asset("admin/javascripts/modernizr.custom.js")}}" type="text/javascript"></script>
    {{--<script src="{{asset("admin/javascripts/main.js")}}" type="text/javascript"></script>--}}
    <script src="{{asset("admin/javascripts/custom/final.js")}}" type="text/javascript"></script>
    <script src="{{asset("admin/javascripts/custom/login.js")}}" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
</head>
<body class="login2">
<!-- Login Screen -->
<div class="login-wrapper">
    <img src="{{asset('admin/images/loader-dark.gif')}}" class="loader-img">

    <a href="./"><img width="100" src="{{asset("admin/images/church-logo-22002303.jpg")}}" /></a>
    {!! Form::open(['id' => 'loginForm']) !!}
        <div id="message"></div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => "Username or Email"]) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => "Password"]) !!}

            </div>
        </div>
        <a class="pull-right" href="#">Forgot password?</a>
        <div class="text-left">
            <label class="checkbox"><input type="checkbox"><span>Keep me logged in</span></label>
        </div>

        {!! Form::submit("Login in", ['class' => 'btn btn-lg btn-primary btn-block']) !!}
    {!! Form::close() !!}

</div>
</body>
</html>