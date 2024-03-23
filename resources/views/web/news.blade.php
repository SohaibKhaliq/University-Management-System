@extends('web.layouts.master')
@section('title', __('navbar_news'))
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
        
        <!-- blog-area -->
        <section class="blog-area p-relative fix pt-120 pb-120">
            <div class="container">
                <div class="row">

                    @foreach($newses as $news)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-post2 hover-zoomin mb-30 wow fadeInUp animated" data-animation="fadeInUp" data-delay=".4s">
                            <div class="blog-thumb2">
                                <a href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}"><img src="{{ asset('uploads/news/'.$news->attach) }}" alt="News"></a>

                                <div class="date-home">
                                    <i class="fal fa-calendar-alt"></i> 
                                    {{ date("d F, Y", strtotime($news->date)) }}
                                </div>
                            </div>                    
                            <div class="blog-content2">
                                <h4><a href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}">{{ $news->title }}</a></h4> 

                                <p>{!! str_limit(strip_tags($news->description), 120, ' ...') !!}</p>

                                <div class="blog-btn"><a href="{{ route('news.single', ['id' => $news->id, 'slug' => $news->slug]) }}">{{ __('btn_read_more') }} <i class="fal fa-long-arrow-right"></i></a></div>
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
                                    {{ $newses->appends(Request::only('search'))->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area-end -->

    </main>
    <!-- main-area-end -->

@endsection