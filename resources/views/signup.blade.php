{{--<a href="redirect/google"></a>--}}
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forecast Register</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bower_components/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/signin.css')}}" rel="stylesheet">

    <script src="{{asset('assets/bower_components/jquery/dist/jquery.js')}}"></script>


</head>
<body cz-shortcut-listen="true">

<div class="container">

    <form class="form-signin" id="login" method="post" action="{{ route('register') }}">
        {{csrf_field()}}
        <h2 class="form-signin-heading">Please register in</h2>
        <label for="inputName" class="sr-only">Name</label>
        <input type="email" name="name" id="inputName" class="form-control" placeholder="what is your name?" required=""
               autofocus="">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required=""
               autofocus="">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="radio" name="gender" value="1"> Male<br>
        <input type="radio" name="gender" value="0"> Female<br>
        <label for="inputRePassword" class="sr-only">Password</label>
        <input type="password" id="inputRePassword" name="" class="form-control" placeholder="Type your password Again"
               required=""><span id='message'></span>
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
        <button name="confirm" class="btn btn-lg btn-primary btn-block" id="submit" type="submit">Register</button>
    </form>

</div> <!-- /container -->

<script>
    $('#submit').attr('disabled','disabled');

    $('#inputRePassword').on('keyup', function () {
        if ($(this).val() == $('#inputPassword').val()) {
            $('#message').html('matching').css('color', 'green');
            $('#submit').removeAttr('disabled');
        } else $('#message').html('not matching').css('color', 'red');
    });
</script>


</body>
