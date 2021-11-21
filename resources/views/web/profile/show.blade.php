@extends('layouts.web')

@section('title')
    @lang('web.profile.title')
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
                        <li>@lang('web.profile.title')</li>
                    </ul>
                    <h1 class="white-text">{{ $user->username }}</h1>

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
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <div class="row">
                                    <div class="col-3"></div>
                                </div>
                                <img src="{{ uploads($user->avatar) }}" alt="{{ $user->username }}">
                                <div class="caption">
                                    <h3>{{ $user->firstname }} {{ $user->lastname }}</h3>
                                    <table class="table">
                                        <tr>
                                            <th>@lang('web.profile.username')</th>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('web.profile.email')</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>@lang('web.profile.joined')</th>
                                            <td>{{ convert_date($user->created_at) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
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
