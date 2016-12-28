{{--<a href="redirect/google"></a>--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forecast Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/signin.css')}}" rel="stylesheet">



</head>
<body cz-shortcut-listen="true" style="background-color: black">

<div class="container">

    <form class="form-signin" id="login" method="post" action="{{ route('user-login') }}">
        {{csrf_field()}}
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>

                <p>{{ Session::get('error') }}</p>
            </div>
        @endif
        <button name="confirm" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
{{--        <a href="{{ route('social.login', ['google']) }}" class="btn btn-lg btn-danger btn-block"><i class="fa fa-google-plus"></i></a>--}}
        {{--<a href="{{ route('social.login', ['google']) }}">G+ Login</a><br>--}}
    </form>

</div> <!-- /container -->




</body>
