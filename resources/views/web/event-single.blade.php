@extends('web.layouts.master')
@section('title', __('navbar_event'))

@section('social_meta_tags')
    @if(isset($setting))
    <meta property="og:type" content="website">
    <meta property='og:site_name' content="{{ $setting->title }}"/>
    <meta property='og:title' content="{{ $event->title }}"/>
    <meta property='og:description' content="{!! str_limit(strip_tags($event->description), 160, ' ...') !!}"/>
    <meta property='og:url' content="{{ route('event.single', ['id' => $event->id, 'slug' => $event->slug]) }}"/>
    <meta property='og:image' content="{{ asset('uploads/web-event/'.$event->attach) }}"/>


    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{!! '@'.str_replace(' ', '', $setting->title) !!}" />
    <meta name="twitter:creator" content="@HiTechParks" />
    <meta name="twitter:url" content="{{ route('event.single', ['id' => $event->id, 'slug' => $event->slug]) }}" />
    <meta name="twitter:title" content="{{ $event->title }}" />
    <meta name="twitter:description" content="{!! str_limit(strip_tags($event->description), 160, ' ...') !!}" />
    <meta name="twitter:image" content="{{ asset('uploads/web-event/'.$event->attach) }}" />
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
                                <h2>{{ __('navbar_event') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('navbar_event') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->
                   
        <!-- Event Detail -->
        <section class="project-detail">
            <div class="container">
                <!-- Upper Box -->
                <div class="upper-box">
                    <div class="single-item-carousel owl-carousel owl-theme">
                        <figure class="image"><img src="{{ asset('uploads/web-event/'.$event->attach) }}" alt="Event"></figure>
                    </div>
                </div>

                <!-- Lower Content -->
                <div class="lower-content2">
                    <div class="row">
                        <div class="text-column col-lg-9 col-md-12 col-sm-12">
                            <div class="s-about-content wow fadeInRight" data-animation="fadeInRight" data-delay=".2s">  

                                <h2>{{ $event->title }}</h2>
                                <p>{!! $event->description !!}</p>


                                <div countdown class="conterdown wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s" data-date="{{ date("M d Y", strtotime($event->date)) }} {{ date("h:i:s", strtotime($event->time)) }}">
                                     <div class="timer">                                         
                                        <div class="timer-outer bdr1">
                                           <span class="days" data-days>0</span> 
                                           <div class="smalltext">{{ __('Days') }}</div>
                                           <div class="value-bar"></div>
                                        </div>
                                        <div class="timer-outer bdr2">
                                           <span class="hours" data-hours>0</span> 
                                           <div class="smalltext">{{ __('Hours') }}</div>
                                        </div>
                                        <div class="timer-outer bdr3">
                                           <span class="minutes" data-minutes>0</span> 
                                           <div class="smalltext">{{ __('Minutes') }}</div>
                                        </div>
                                        <div class="timer-outer bdr4">
                                           <span class="seconds" data-seconds>0</span> 
                                           <div class="smalltext">{{ __('Seconds') }}</div>
                                        </div>
                                        <p id="time-up"></p>
                                     </div>
                                </div>

                                <div class="two-column mt-30">
                                    <div class="row aling-items-center">
                                         <div class="image-column col-xl-6 col-lg-12 col-md-12">
                                            <div class="footer-social mt-10">
                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('event.single', ['id' => $event->id, 'slug' => $event->slug]) }}">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                                
                                                <a target="_blank" href="https://twitter.com/intent/tweet?text={{ str_limit(strip_tags($event->title), 100, ' ...') }}&url={{ route('event.single', ['id' => $event->id, 'slug' => $event->slug]) }}">
                                                    <i class="fab fa-twitter"></i>
                                                </a>

                                                <a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url={{ route('event.single', ['id' => $event->id, 'slug' => $event->slug]) }}">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-column col-xl-6 col-lg-12 col-md-12 text-right">
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-column col-lg-3 col-md-12 col-sm-12">
                            <div class="inner-column2">
                                <h3>{{ __('sidebar_event') }}</h3>

                                <ul class="project-info clearfix">
                                    @if(!empty($event->time))
                                    <li>
                                        <span class="icon fal fa-clock"></span>
                                        <strong>
                                            @if(isset($setting->time_format))
                                            {{ date($setting->time_format, strtotime($event->time)) }}
                                            @else
                                            {{ date("h:i A", strtotime($event->time)) }}
                                            @endif
                                        </strong>
                                    </li>
                                    @endif

                                    <li>
                                        <span class="icon fal fa-calendar-alt"></span>
                                        <strong>{{ date("d F, Y", strtotime($event->date)) }}</strong>
                                    </li>

                                    @if(!empty($event->address))
                                    <li>
                                        <span class="icon fal fa-map-marker-check"></span>
                                        <strong>{{ $event->address }}</strong>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--End Event Detail -->
       
    </main>
    <!-- main-area-end -->

@endsection