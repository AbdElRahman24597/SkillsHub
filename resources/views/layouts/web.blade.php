<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" {{--dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" Design doesn't support rtl--}}>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ web_asset('css/bootstrap.min.css') }}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ web_asset('css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ web_asset('css/style.css') }}"/>

    <!-- Toastr -->
    <link type="text/css" rel="stylesheet" href="{{ web_asset('css/toastr.min.css') }}"/>

@yield('styles')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- Header -->
<header id="header">
    <div class="container">

        <div class="navbar-header">
            <!-- Logo -->
            <div class="navbar-brand">
                <a class="logo" href="{{ route('home.index') }}">
                    <img src="{{ web_asset('img/logo.png') }}" alt="logo">
                </a>
            </div>
            <!-- /Logo -->

            <!-- Mobile toggle -->
            <button class="navbar-toggle">
                <span></span>
            </button>
            <!-- /Mobile toggle -->
        </div>

        <!-- Navigation -->
        <nav id="nav">
            <ul class="main-menu nav navbar-nav navbar-right">
                <li><a href="{{ route('home.index') }}">@lang('web.general.home')</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('web.general.categories') <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(navbar(\App\Models\Category::class) as $category)
                            <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('skills.index') }}">@lang('web.general.skills')</a></li>
                <li><a href="{{ route('contact.index') }}">@lang('web.general.contact')</a></li>
                @guest
                    <li><a href="{{ route('login') }}">@lang('web.general.login')</a></li>
                    <li><a href="{{ route('register') }}">@lang('web.general.register')</a></li>
                @endguest
                @auth
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->username }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.index') }}">@lang('web.general.profile')</a></li>
                            @role('admin|moderator')
                            <li><a href="{{ route('dashboard.home.index') }}">@lang('web.general.dashboard')</a></li>
                            @else
                                <li><a href="{{ route('profile.scoreboard') }}">@lang('web.general.scoreboard')</a></li>
                                @endrole
                                <li><a href="{{ route('profile.edit') }}">@lang('web.general.profile_edit')</a></li>
                                <li><a href="{{ route('profile.change-password') }}">@lang('web.general.change_password')</a></li>
                                <li>
                                    <form id="logoutForm" class="d-none" method="post" action="{{ route('logout') }}">
                                        @csrf
                                    </form>
                                    <a id="logoutBtn" href="#">@lang('web.general.logout')</a>
                                </li>
                        </ul>
                    </li>
                @endauth
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ LaravelLocalization::getCurrentLocale() }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /Navigation -->

    </div>
</header>
<!-- /Header -->

@yield('content')

<!-- Footer -->
<footer id="footer" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div id="bottom-footer" class="row">

            <!-- social -->
            <div class="col-md-4 col-md-push-8">
                <ul class="footer-social">
                    @if(!is_null(settings()->facebook))
                        <li><a href="{{ settings()->facebook }}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    @endif

                    @if(!is_null(settings()->twitter))
                        <li><a href="{{ settings()->twitter }}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    @endif

                    @if(!is_null(settings()->instagram))
                        <li><a href="{{ settings()->instagram }}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
                    @endif

                    @if(!is_null(settings()->youtube))
                        <li><a href="{{ settings()->youtube }}" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>
                    @endif

                    @if(!is_null(settings()->linkedin))
                        <li><a href="{{ settings()->linkedin }}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                    @endif
                </ul>
            </div>
            <!-- /social -->

            <!-- copyright -->
            <div class="col-md-8 col-md-pull-4">
                <div class="footer-copyright">
                    <span>@lang('web.general.copyright') <a href='{{ route('home.index') }}'>{{ env('APP_NAME') }}</a></span>
                </div>
            </div>
            <!-- /copyright -->

        </div>
        <!-- row -->

    </div>
    <!-- /container -->

</footer>
<!-- /Footer -->

<!-- preloader -->
{{--<div id='preloader'>
    <div class='preloader'></div>
</div>--}}
<!-- /preloader -->


<!-- jQuery Plugins -->
<script type="text/javascript" src="{{ web_asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ web_asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ web_asset('js/main.js') }}"></script>

<!-- Toastr -->
<script src="{{ web_asset('js/toastr.min.js') }}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "50000",
        "extendedTimeOut": "5000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>

<!-- Pusher -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('notifications');
    channel.bind('exam.added', function (data) {
        let examUrl = "{{ route('exams.show', ':id') }}";
        examUrl = examUrl.replace(':id', data.exam.id);

        toastr.info('<a href="' + examUrl + '">Click here</a> to visit the new exam.', 'New exam added');
    });
</script>

<script>
    $('#logoutBtn').click(function (e) {
        e.preventDefault();
        $('#logoutForm').submit();
    });
</script>

@yield('scripts')

</body>
</html>
