@extends('layouts.web')

@section('title')
    {{ $category->name }} - @lang('web.categories.title')
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
                        <li>{{ $category->name }}</li>
                    </ul>
                    <h1 class="white-text">{{ $category->name }}</h1>

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

                    <!-- row -->
                    <div class="row">

                    @foreach($skills as $skill)
                        <!-- single skill -->
                            <div class="col-md-4">
                                <div class="single-blog">
                                    <div class="blog-img">
                                        <a href="{{ route('skills.show', $skill->id) }}">
                                            <img src="{{ uploads($skill->image) }}" alt="">
                                        </a>
                                    </div>
                                    <h4><a href="{{ route('skills.show', $skill->id) }}">{{ $skill->name }}</a></h4>
                                    <div class="blog-meta">
                                        <span>{{ convert_date($skill->created_at) }}</span>
                                        <div class="pull-right">
                                            <span class="blog-meta-comments"><a><i class="fa fa-users"></i> {{ $skill->countStudents() }}</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /single skill -->
                        @endforeach

                    </div>
                    <!-- /row -->

                    <!-- row -->
                    <div class="row">

                        <!-- pagination -->
                    {{ $skills->links('includes.paginator.web') }}
                    <!-- pagination -->

                    </div>
                    <!-- /row -->
                </div>
                <!-- /main blog -->

                <!-- aside blog -->
                <div id="aside" class="col-md-3">
                    <!-- category widget -->
                    <div class="widget category-widget">
                        <h3>@lang('web.general.categories')</h3>
                        @foreach($categories as $oneCategory)
                            <a class="category" href="{{ route('categories.show', $oneCategory->id) }}">{{ $oneCategory->name }} <span>{{ $oneCategory->skills->count() }}</span></a>
                        @endforeach
                    </div>
                    <!-- /category widget -->
                </div>
                <!-- /aside blog -->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </div>
    <!-- /Blog -->
@endsection
