@extends('web.layouts.master')
@section('title', __('navbar_news'))

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="website">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $news->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($news->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}"/>
    <meta property='og:image' content="{{ asset('uploads/news/'.$news->attach) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}" />
    <meta name="twitter:title" content="{{ $news->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($news->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/news/'.$news->attach) }}" />
    @endif
@endsection

@section('content')

    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex  p-relative align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 col-lg-12">
                        <div class="breadcrumb-wrap text-left">
                            <div class="breadcrumb-title">
                                <h2>{{ __('navbar_news') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('navbar_news') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->
          
        <!-- inner-blog -->
        <section class="inner-blog b-details-p pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-details-wrap">
                            <div class="details__content pb-30">
                                <h2>{{ $news->title }}</h2>

                                <div class="meta-info">
                                    <ul>
                                        <li><i class="fal fa-calendar-alt"></i> 
                                            {{ date("d F, Y", strtotime($news->date)) }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="details__content-img">
                                    <img src="{{ asset('uploads/news/'.$news->attach) }}" alt="News">
                                </div>

                                <p>{!! $news->description !!}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- inner-blog-end -->
     
    </main>
    <!-- main-area-end -->

@endsection