@extends('layouts.web')

@section('title')
    @lang('web.contact.title')
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
                        <li>@lang('web.general.contact')</li>
                    </ul>
                    <h1 class="white-text">@lang('web.contact.get_in_touch')</h1>

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

                <!-- contact form -->
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4>@lang('web.contact.send_a_msg')</h4>

                        @include('includes.messages')
                        @include('includes.errors')

                        <form method="post" action="{{ route('contact.store') }}">
                            @csrf
                            <input class="input" type="text" name="name" placeholder="@lang('web.contact.form_name')" value="{{ old('name', auth()->check() ? auth()->user()->username : '') }}">
                            <input class="input" type="email" name="email" placeholder="@lang('web.contact.form_email')" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}">
                            <input class="input" type="text" name="subject" placeholder="@lang('web.contact.form_subject')" value="{{ old('subject') }}">
                            <textarea class="input" name="message" placeholder="@lang('web.contact.form_message')">{{ old('message') }}</textarea>
                            <button type="submit" class="main-button icon-button pull-right">@lang('web.contact.form_send')</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->

                <!-- contact information -->
                <div class="col-md-5 col-md-offset-1">
                    <h4>@lang('web.contact.contact_info')</h4>
                    <ul class="contact-details">
                        <li><i class="fa fa-envelope"></i><a href="mailto:{{ $contactInfo->email }}">{{ $contactInfo->email }}</a></li>
                        <li><i class="fa fa-phone"></i><a href="tel:{{ $contactInfo->phone }}">{{ $contactInfo->phone }}</a></li>
                    </ul>

                </div>
                <!-- contact information -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->
@endsection
