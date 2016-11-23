
        <ul class="nav navbar-nav navbar-left">
            @if(auth()->check())
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        @if(auth()->user()->gender=='1')
                            سلام آقای
                        @else
                            سلام سرکار خانوم
                        @endif
                        @if(auth()->user()->first_name)
                            {{ auth()->user()->first_name }}
                        @else
                            {{ auth()->user()->display_name }}
                        @endif

                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('complete_info',['id'=>auth()->user()->id])}}">
                                @if(auth()->user()->first_name)
                                    ویرایش اطلاعات
                                @else
                                    تکمیل اطلاعات
                                @endif
                            </a></li>
                        <li><a href="{{ route('logout') }}">خروج</a></li>

                    </ul>
                </div>
                <img src="{{auth()->user()->avatar }}" style="width: 50px" class="img-circle">


            @else
                <li><a class="login"
                       href="{{ auth()->check() ? route('logout') : route('user-get-login') }}">{{ auth()->check() ? "Logout" : 'Login' }}</a>
                </li>
            @endif
        </ul>
        <div class="navbar-header navbar-right">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><b>پیش بینی</b></a>
        </div>

        <ul class="nav navbar-nav navbar-right" style="padding-right: 15px">

            <li class="@yield('public_home')"><a href="/">خانه</a></li>
            <li class="@yield('public_week_game')"><a href="{{route('week_game')}}">بازی ها هفته</a></li>
            <li class="@yield('public_game_reserve')"><a href="{{route('game_reserve')}}">خرید بلیط</a></li>
            <li class="@yield('public_about')"><a href="#about">درباره ما</a></li>
            <li class="@yield('public_contact')"><a href="#contact">ارتباط با ما</a></li>
        </ul>

        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">

        </div><!-- /.nav-collapse -->


