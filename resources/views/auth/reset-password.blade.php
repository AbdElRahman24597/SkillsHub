@extends('layouts.web')

@section('title')
    @lang('auth.reset_password.title')
@endsection

@section('content')
    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>@lang('auth.reset_password.description')</h4>

                        @include('includes.messages')
                        @include('includes.errors')

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            <label>@lang('auth.reset_password.form_email')</label>
                            <input class="input" type="email" name="email" placeholder="@lang('auth.reset_password.form_email')" value="{{ old('email', request()->query('email')) }}">

                            <label>@lang('auth.reset_password.form_password')</label>
                            <input class="input" type="password" name="password" placeholder="@lang('auth.reset_password.form_password')">

                            <label>@lang('auth.reset_password.form_confirm_password')</label>
                            <input class="input" type="password" name="password_confirmation" placeholder="@lang('auth.reset_password.form_confirm_password')">

                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <button type="submit" class="main-button icon-button pull-right">@lang('auth.reset_password.form_submit')</button>
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
