@extends('layouts.web')

@section('title')
    {{ $skill->name }} - @lang('web.skills.title')
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
                        <li><a href="{{ route('categories.show', $skill->category->id) }}">{{ $skill->category->name }}</a></li>
                        <li>{{ $skill->name }}</li>
                    </ul>
                    <h1 class="white-text">{{ $skill->name }}</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Blog -->
    <div id="blog" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- main blog -->
                <div id="main" class="col-md-12">

                    <!-- row -->
                    <div class="row">

                    @foreach($exams as $exam)
                        <!-- single exam -->
                            <div class="col-md-3">
                                <div class="single-blog">
                                    <div class="blog-img">
                                        <a href="{{ route('exams.show', $exam->id) }}">
                                            <img src="{{ uploads($exam->image) }}" alt="">
                                        </a>
                                    </div>
                                    <h4><a href="{{ route('exams.show', $exam->id) }}">{{ $exam->name }}</a></h4>
                                    <div class="blog-meta">
                                        <span>{{ convert_date($exam->created_at) }}</span>
                                        <div class="pull-right">
                                            <span class="blog-meta-comments"><a><i class="fa fa-users"></i> {{ $exam->users->count() }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /single exam -->
                        @endforeach

                    </div>
                    <!-- /row -->
                </div>
                <!-- /main blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
