@extends('layouts.web')

@section('title')
    @lang('web.profile.edit.title') - @lang('web.profile.title')
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
                        <li>@lang('web.profile.edit.title')</li>
                    </ul>
                    <h1 class="white-text">@lang('web.profile.edit.title')</h1>

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
                        <h4>@lang('web.profile.edit.title')</h4>

                        @include('includes.messages')
                        @include('includes.errors')

                        <form method="post" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('web.profile.edit.form_username') *</label>
                                    <input class="input" type="text" name="username" placeholder="@lang('web.profile.edit.form_username')" value="{{ old('username', $user->username) }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('web.profile.edit.form_email') *</label>
                                    <input class="input" type="email" name="email" placeholder="@lang('web.profile.edit.form_email')" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('web.profile.edit.form_firstname') *</label>
                                    <input class="input" type="text" name="firstname" placeholder="@lang('web.profile.edit.form_firstname')" value="{{ old('firstname', $user->firstname) }}">
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('web.profile.edit.form_lastname') *</label>
                                    <input class="input" type="text" name="lastname" placeholder="@lang('web.profile.edit.form_lastname')" value="{{ old('lastname', $user->lastname) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label>@lang('web.profile.edit.form_avatar')</label>
                                    <input class="input" type="file" name="avatar">
                                </div>
                            </div>

                            <button type="submit" class="main-button icon-button pull-right">@lang('web.profile.edit.form_submit')</button>
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
