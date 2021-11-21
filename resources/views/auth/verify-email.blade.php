@extends('layouts.web')

@section('title')
    @lang('auth.verify_email.title')
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
                        <div class="alert alert-danger">
                            @lang('auth.verify_email.must_verify')
                        </div>
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success">
                                @lang('auth.verify_email.status')
                            </div>
                        @endif

                        <form action="{{ route('verification.send') }}" method="post">
                            @csrf
                            <button type="submit" class="main-button icon-button">@lang('auth.verify_email.resend')</button>
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
