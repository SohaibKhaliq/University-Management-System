@extends('web.layouts.master')
@section('title', __('navbar_course'))
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
        
        <!-- course-area -->
        <section class="shop-area pt-120 pb-120 p-relative " data-animation="fadeInUp animated" data-delay=".2s">
            <div class="container">
                <div class="row align-items-center">

                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 ">
                        <div class="courses-item mb-30 hover-zoomin">
                            <div class="thumb fix">
                                <a href="{{ route('course.single', ['slug' => $course->slug]) }}"><img src="{{ asset('uploads/course/'.$course->attach) }}" alt="Course"></a>
                            </div>
                            <div class="courses-content">                                    
                                <div class="cat"><i class="fal fa-graduation-cap"></i> {{ $course->faculty }}</div>

                                <h3><a href="{{ route('course.single', ['slug' => $course->slug]) }}">{{ $course->title }}</a></h3>
                                <p>{!! str_limit(strip_tags($course->description), 120, ' ...') !!}</p>

                                <a href="{{ route('course.single', ['slug' => $course->slug]) }}" class="readmore">{{ __('btn_read_more') }} <i class="fal fa-long-arrow-right"></i></a>
                            </div>
                            <div class="icon">
                                <img src="{{ asset('web/img/icon/cou-icon.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="pagination-wrap mt-20 text-center">
                            <nav>
                                <ul class="pagination">
                                    {{ $courses->appends(Request::only('search'))->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- course-area-end -->
       
    </main>
    <!-- main-area-end -->

@endsection