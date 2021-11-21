@extends('layouts.web')

@section('title')
    @lang('web.profile.change_password.title') - @lang('web.profile.title')
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
                        <li><a href="{{ route('profile.index') }}">@lang('web.profile.title')</a></li>
                        <li>@lang('web.profile.change_password.title')</li>
                    </ul>
                    <h1 class="white-text">@lang('web.profile.change_password.title')</h1>

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
                        <h4>@lang('web.profile.change_password.title')</h4>

                        @include('includes.messages')
                        @include('includes.errors')

                        <form method="post" action="{{ route('user-password.update') }}">
                            @method('put')
                            @csrf

                            <label>@lang('web.profile.change_password.form_current') *</label>
                            <input class="input" type="password" name="current_password">

                            <label>@lang('web.profile.change_password.form_password') *</label>
                            <input class="input" type="password" name="password">

                            <label>@lang('web.profile.change_password.form_password_confirmation') *</label>
                            <input class="input" type="password" name="password_confirmation">

                            <button type="submit" class="main-button icon-button pull-right">@lang('web.profile.change_password.form_submit')</button>
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
