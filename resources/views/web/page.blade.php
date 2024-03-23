@extends('web.layouts.master')
@section('title', $page->title)
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
                                <h2>{{ $page->title }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->
                   
        <!-- Page Detail -->
        <section class="project-detail">
            <div class="container">
                <!-- Upper Box -->
                @if(is_file('uploads/page/'.$page->attach))
                <div class="upper-box">
                    <div class="single-item-carousel owl-carousel owl-theme">
                        <figure class="image"><img src="{{ asset('uploads/page/'.$page->attach) }}" alt="{{ $page->title }}"></figure>
                    </div>
                </div>
                @endif

                <!-- Lower Content -->
                <div class="lower-content2">
                    <div class="row">
                        <div class="text-column col-lg-12 col-md-12 col-sm-12">
                            <div class="s-about-content wow fadeInRight" data-animation="fadeInRight" data-delay=".2s">  

                                <h2>{{ $page->title }}</h2>
                                <p>{!! $page->description !!}</p>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!--End Page Detail -->
       
    </main>
    <!-- main-area-end -->

@endsection