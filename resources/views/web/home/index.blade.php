@extends('layouts.web')

@section('title')
    @lang('web.general.home')
@endsection

@section('content')
    <!-- Home -->
    <div id="home" class="hero-area">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ web_asset('img/home-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="home-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="white-text">@lang('web.home.title')</h1>
                        <p class="lead white-text">@lang('web.home.description')</p>
                        <a class="main-button icon-button" href="{{ route('login') }}">@lang('web.home.get_started')</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /Home -->

    <!-- Courses -->
    <div id="courses" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>@lang('web.home.popular_exams')</h2>
                    <p class="lead">@lang('web.home.popular_exams_description')</p>
                </div>
            </div>
            <!-- /row -->

            <!-- courses -->
            <div id="courses-wrapper">

                <!-- row -->
                <div class="row">

                @foreach($popularExams as $popularExam)
                    <!-- single course -->
                        <div class="col-md-3 col-sm-6 col-xs-6">
                            <div class="course">
                                <a href="{{ route('exams.show', $popularExam->id) }}" class="course-img">
                                    <img src="{{ uploads($popularExam->image) }}" alt="{{ $popularExam->name }}">
                                    <i class="course-link-icon fa fa-link"></i>
                                </a>
                                <a class="course-title" href="{{ route('exams.show', $popularExam->id) }}">{{ $popularExam->name }}</a>
                                <div class="course-details">
                                    <span class="course-category">{{ $popularExam->skill->category->name }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- /single course -->
                    @endforeach

                </div>
                <!-- /row -->

            </div>
            <!-- /courses -->

            <div class="row">
                <div class="center-btn">
                    <a class="main-button icon-button" href="{{ route('exams.index') }}">@lang('web.home.more_exams')</a>
                </div>
            </div>

        </div>
        <!-- container -->

    </div>
    <!-- /Courses -->


    <!-- Contact CTA -->
    <div id="contact-cta" class="section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ web_asset('img/cta.jpg') }})"></div>
        <!-- Backgound Image -->

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="white-text">@lang('web.home.contact_us')</h2>
                    <p class="lead white-text">@lang('web.home.contact_us_description')</p>
                    <a class="main-button icon-button" href="{{ route('contact.index') }}">@lang('web.home.contact_us_now')</a>
                </div>

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact CTA -->
@endsection

