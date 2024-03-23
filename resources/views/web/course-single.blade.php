@extends('web.layouts.master')
@section('title', __('navbar_course'))

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="website">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $course->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($course->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('course.single', ['slug' => $course->slug]) }}"/>
    <meta property='og:image' content="{{ asset('uploads/course/'.$course->attach) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('course.single', ['slug' => $course->slug]) }}" />
    <meta name="twitter:title" content="{{ $course->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($course->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/course/'.$course->attach) }}" />
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
                                <h2>{{ __('navbar_course') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('navbar_course') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->
        
        <!-- course Detail -->
        <section class="project-detail">
            <div class="container">
                <!-- Lower Content -->
                <div class="lower-content">
                    <div class="row">
                        <div class="text-column col-lg-9 col-md-9 col-sm-12">
                            <h2>{{ $course->title }}</h2>
                            
                            <div class="upper-box">
                                <div class="single-item-carousel owl-carousel owl-theme">
                                    <figure class="image"><img src="{{ asset('uploads/course/'.$course->attach) }}" alt="Course"></figure>
                                </div>
                            </div>
                            <div class="inner-column">
                                <p>{!! $course->description !!}</p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <aside class="sidebar-widget info-column">
                                <div class="inner-column3">
                                    <h3>{{ __('sidebar_course') }}</h3>
                                    
                                    <ul class="project-info clearfix">
                                        @if(!empty($course->faculty))
                                        <li>
                                            <strong>{{ __('field_faculty') }}: </strong> 
                                            <span>{{ $course->faculty }}</span>
                                        </li>
                                        @endif
                                        @if(!empty($course->semesters))
                                        <li>
                                            <strong>{{ __('field_total') }} {{ __('field_semester') }}: </strong> 
                                            <span>{{ $course->semesters }}</span>
                                        </li>
                                        @endif
                                        @if(!empty($course->credits))
                                        <li>
                                            <strong>{{ __('field_total_credit_hour') }}: </strong> 
                                            <span>{{ $course->credits }}</span>
                                        </li>
                                        @endif
                                        @if(!empty($course->courses))
                                        <li>
                                            <strong>{{ __('field_total') }} {{ __('field_subject') }}: </strong> 
                                            <span>{{ $course->courses }}</span>
                                        </li>
                                        @endif
                                        @if(!empty($course->duration))
                                        <li>
                                            <strong>{{ __('field_duration') }}: </strong> 
                                            <span>{{ $course->duration }}</span>
                                        </li>
                                        @endif
                                        @if(!empty($course->fee))
                                        <li>
                                            <strong>{{ __('field_total') }} {{ __('field_fee') }}: </strong> 
                                            <span>{{ round($course->fee, $setting->decimal_place ?? 2) }} {!! $setting->currency_symbol !!}</span>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End course Detail -->
               
    </main>
    <!-- main-area-end -->

@endsection