@extends('layouts.web')

@section('title')
    @lang('auth.login.title')
@endsection

@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ web_asset('img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ route('home.index') }}">@lang('web.general.home')</a></li>
                        <li>@lang('auth.login.title')</li>
                    </ul>
                    <h1 class="white-text">@lang('auth.login.description')</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>@lang('auth.login.title')</h4>

                        @include('includes.errors')

                        <form method="post" action="{{ route('login') }}">
                            @csrf

                            <label>@lang('auth.login.form_username') *</label>
                            <input class="input" type="text" name="username" placeholder="@lang('auth.login.form_username')" value="{{ old('username') }}">

                            <label>@lang('auth.login.form_password') *</label>
                            <input class="input" type="password" name="password" placeholder="@lang('auth.login.form_password')">

                            <div class="row">
                                <div class="col-md-6">
                                    <input id="rememberMe" type="checkbox" name="remember">
                                    <label for="rememberMe">@lang('auth.login.form_remember')</label>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="main-button icon-button pull-right">@lang('auth.login.form_submit')</button>
                                </div>
                            </div>

                            <div class="mb-5">
                                <a href="{{ route('password.request') }}">@lang('auth.login.forgot_password')</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /login form -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
