@extends('web.layouts.master')
@section('title', __('navbar_gallery'))
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
                                <h2>{{ __('navbar_gallery') }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="breadcrumb-wrap2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('navbar_gallery') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- gallery-area -->
        <section id="work" class="pt-150 pb-105">
            <div class="container">                  
                <div class="portfolio">
                    <div class="grid col3 wow fadeInUp  animated" data-animation="fadeInUp" data-delay=".4s">

                        @foreach($galleries as $gallery)
                        <div class="grid-item">
                            <a class="popup-image" href="{{ asset('uploads/gallery/'.$gallery->attach) }}">
                                <figure class="gallery-image">
                                    <img src="{{ asset('uploads/gallery/'.$gallery->attach) }}" alt="{{ $gallery->title ?? '' }}" class="img"> 
                                </figure>
                            </a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <!-- gallery-area-end -->
              
    </main>
    <!-- main-area-end -->

@endsection