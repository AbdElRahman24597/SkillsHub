@extends('layouts.web')

@section('title')
    {{ $exam->name }} @lang('web.exams.questions') - @lang('web.exams.title')
@endsection

@section('styles')
    <link href="{{ web_asset('css/TimeCircles.css') }}" rel="stylesheet">
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

                @include('includes.errors')

                <!-- blog post -->
                    <form id="examForm" method="post" action="{{ route('exams.store', $exam->id) }}">
                        @csrf
                        <div class="blog-post mb-5">
                            @foreach($exam->questions as $question)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{ $loop->iteration }}- {{ $question->title }}</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="1">
                                                {{ $question->option_1 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="2">
                                                {{ $question->option_2 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="3">
                                                {{ $question->option_3 }}
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="answers[{{ $question->id }}]" value="4">
                                                {{ $question->option_4 }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /blog post -->

                        <div>
                            <button type="submit" class="main-button icon-button pull-left">@lang('web.exams.submit')</button>
                            <a href="{{ url()->previous() }}" class="main-button icon-button btn-danger pull-left ml-sm">@lang('web.exams.cancel')</a>
                        </div>
                    </form>
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

                    <div id="durationCountdown" data-timer="{{ $exam->duration * 60 }}"></div>

                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ web_asset('js/TimeCircles.js') }}"></script>
    <script>
        $('#durationCountdown').TimeCircles({
            time: {
                Days: {
                    show: false,
                },
            },

            count_past_zero: false,
        }).addListener(function (unit, value, total) {
            if (total <= 0) {
                $('#examForm').submit();
            }
        });
    </script>
@endsection
