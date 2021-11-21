@extends('layouts.web')

@section('title')
    @lang('auth.register.title')
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
                        <li>@lang('auth.register.title')</li>
                    </ul>
                    <h1 class="white-text">@lang('auth.register.description')</h1>

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
                        <h4>@lang('auth.register.title')</h4>

                        @include('includes.errors')

                        <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_username') *</label>
                                    <input class="input" type="text" name="username" placeholder="@lang('auth.register.form_username')" value="{{ old('username') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_email') *</label>
                                    <input class="input" type="email" name="email" placeholder="@lang('auth.register.form_email')" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_firstname') *</label>
                                    <input class="input" type="text" name="firstname" placeholder="@lang('auth.register.form_firstname')" value="{{ old('firstname') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_lastname') *</label>
                                    <input class="input" type="text" name="lastname" placeholder="@lang('auth.register.form_lastname')" value="{{ old('lastname') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>@lang('auth.register.form_avatar')</label>
                                    <input class="input" type="file" name="avatar">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_password') *</label>
                                    <input class="input" type="password" name="password" placeholder="@lang('auth.register.form_password')">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('auth.register.form_confirm_password') *</label>
                                    <input class="input" type="password" name="password_confirmation" placeholder="@lang('auth.register.form_confirm_password')">
                                </div>
                            </div>

                            <button type="submit" class="main-button icon-button pull-right">@lang('auth.register.form_submit')</button>
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
