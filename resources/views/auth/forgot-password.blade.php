@extends('layouts.web')

@section('title')
    @lang('auth.forgot_password.title')
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
                        <h4>@lang('auth.forgot_password.description')</h4>

                        @include('includes.messages')
                        @include('includes.errors')

                        <form method="post" action="{{ route('password.email') }}">
                            @csrf
                            <label>@lang('auth.forgot_password.form_email') *</label>
                            <input class="input" type="email" name="email" placeholder="@lang('auth.forgot_password.form_email')" value="{{ old('email') }}">
                            <br>
                            <button type="submit" class="main-button icon-button pull-right">@lang('auth.forgot_password.form_submit')</button>
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
