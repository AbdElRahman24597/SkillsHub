@extends('layouts.web')

@section('title')
    {{ $exam->name }} - @lang('web.exams.title')
@endsection

@section('content')
    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url({{ web_asset('img/blog-post-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ route('home.index') }}">@lang('web.general.home')</a></li>
                        <li><a href="{{ route('categories.show', $exam->skill->category->id) }}">{{ $exam->skill->category->name }}</a></li>
                        <li><a href="{{ route('skills.show', $exam->skill->id) }}">{{ $exam->skill->name }}</a></li>
                        <li>{{ $exam->name }}</li>
                    </ul>
                    <h1 class="white-text">{{ $exam->name }}</h1>
                    <ul class="blog-post-meta">
                        <li>{{ convert_date($exam->created_at) }}</li>
                        <li class="blog-meta-comments"><a><i class="fa fa-users"></i> {{ $exam->users->count() }}</a></li>
                    </ul>
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
                <div id="main" class="col-md-9">

                @include('includes.messages')

                <!-- blog post -->
                    <div class="blog-post mb-5">
                        <p>
                            {{ $exam->description }}
                        </p>
                    </div>
                    <!-- /blog post -->

                    <div>
                        @if($canStartExam)
                            <form method="post" action="{{ route('exams.start', $exam->id) }}">
                                @csrf
                                <button type="submit" class="main-button icon-button pull-left">@lang('web.exams.start_exam')</button>
                            </form>
                        @else
                            <button class="main-button icon-button pull-left disabled btn">@lang('web.exams.start_exam')</button>
                        @endif
                    </div>
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">

                    <!-- exam details widget -->
                    <ul class="list-group">
                        <li class="list-group-item">@lang('web.exams.skill'): {{ $exam->skill->name }}</li>
                        <li class="list-group-item">@lang('web.exams.questions'): {{ $exam->questions_number }}</li>
                        <li class="list-group-item">@lang('web.exams.duration'): {{ $exam->duration }} @lang('web.exams.minutes')</li>
                        <li class="list-group-item">@lang('web.exams.difficulty'):
                            @for($i = 1; $i <= $exam->difficulty; $i++)
                                <i class="fa fa-star"></i>
                            @endfor

                            @for($i = 1; $i <= 5 - $exam->difficulty; $i++)
                                <i class="fa fa-star-o"></i>
                            @endfor
                        </li>
                    </ul>
                    <!-- /exam details widget -->

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
