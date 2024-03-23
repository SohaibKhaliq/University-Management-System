<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 <head>
 	<!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    @if(isset($setting))
    <!-- App Title -->
    <title>@yield('title') | {{ $setting->meta_title ?? '' }}</title>

    <meta name="description" content="{!! str_limit(strip_tags($setting->meta_description), 160, ' ...') !!}">
    <meta name="keywords" content="{!! strip_tags($setting->meta_keywords) !!}">

    <!-- App favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/uploads/setting/'.$setting->favicon_path) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/uploads/setting/'.$setting->favicon_path) }}" type="image/x-icon">
    @endif


    @if(empty($setting))
    <!-- App Title -->
    <title>@yield('title')</title>
    @endif


    <!-- Social Meta Tags -->
    <link rel="canonical" href="{{ route('home') }}">
    
    @yield('social_meta_tags')


 	<!-- Stylesheets -->
 	<link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('web/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/dripicons.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">


    @php 
    $version = App\Models\Language::version(); 
    @endphp
    @if($version->direction == 1)
    <!-- RTL css -->
    <link rel="stylesheet" href="{{ asset('web/css/rtl.css') }}">
    @endif
 </head>

 <body>

 	<!-- header -->
    <header class="header-area header-three">  
       <div class="header-top second-header d-none d-md-block">
            <div class="container">
                <div class="row align-items-center">      
                   
                    <div class="col-lg-4 col-md-4 d-none d-lg-block ">
                        @if(isset($topbarSetting) && $topbarSetting->social_status == 1)
                        <div class="header-social">
                            <span>
                            @if(isset($socialSetting->facebook))
                            <a href="{{ $socialSetting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if(isset($socialSetting->instagram))
                            <a href="{{ $socialSetting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if(isset($socialSetting->twitter))
                            <a href="{{ $socialSetting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if(isset($socialSetting->linkedin))
                            <a href="{{ $socialSetting->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            @endif
                            @if(isset($socialSetting->pinterest))
                            <a href="{{ $socialSetting->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                            @endif
                            @if(isset($socialSetting->youtube))
                            <a href="{{ $socialSetting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            @endif
                           </span>                    
                           <!--  /social media icon redux -->                               
                        </div>
                        @endif
                    </div>

                    <div class="col-lg-8 col-md-8 d-none d-lg-block text-right">
                        <div class="header-cta">
                            <ul>
                               @isset($topbarSetting->phone)
                               <li>
                                  <div class="call-box">
                                     <div class="icon">
                                        <img src="{{ asset('web/img/icon/phone-call.png') }}" alt="img">
                                     </div>
                                     <div class="text">
                                        <strong><a href="tel:{{ str_replace(' ', '', $topbarSetting->phone ?? '') }}">{{ $topbarSetting->phone ?? '' }}</a></strong>
                                     </div>
                                  </div>
                               </li>
                               @endisset
                               @isset($topbarSetting->email)
                               <li>
                                  <div class="call-box">
                                     <div class="icon">
                                        <img src="{{ asset('web/img/icon/mailing.png') }}" alt="img">
                                     </div>
                                     <div class="text">
                                        <strong><a href="mailto:{{ $topbarSetting->email ?? '' }}">{{ $topbarSetting->email ?? '' }}</a></strong>
                                     </div>
                                  </div>
                               </li>
                               @endisset
                            </ul>
                        </div>                        
                    </div>
                    
                </div>
            </div>
        </div>    


        <div id="header-sticky" class="menu-area">
            <div class="container">
                <div class="second-menu">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            @if(isset($setting))
                            <div class="logo">
                                <a href="{{ route('home') }}"><img src="{{ asset('/uploads/setting/'.$setting->logo_path) }}" alt="logo"></a>
                            </div>
                            @endif
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="main-menu text-right text-xl-right">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="{{ Request::path() == '/' ? 'current' : '' }}"><a href="{{ route('home') }}">{{ __('navbar_home') }}</a></li>
                                        <li class="{{ Request::is('course*') ? 'current' : '' }}"><a href="{{ route('course') }}">{{ __('navbar_course') }}</a></li>
                                        <li class="{{ Request::is('event*') ? 'current' : '' }}"><a href="{{ route('event') }}">{{ __('navbar_event') }}</a></li>
                                        <li class="{{ Request::is('faq*') ? 'current' : '' }}"><a href="{{ route('faq') }}">{{ __('navbar_faqs') }}</a></li>
                                        <li class="{{ Request::is('gallery*') ? 'current' : '' }}"><a href="{{ route('gallery') }}">{{ __('navbar_gallery') }}</a></li>
                                        <li class="{{ Request::is('news*') ? 'current' : '' }}"><a href="{{ route('news') }}">{{ __('navbar_news') }}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 text-right d-none d-lg-block text-right text-xl-right">
                            @php 
                            $application = App\Models\ApplicationSetting::status(); 
                            @endphp
                            @isset($application)
                            <div class="login">
                                <ul>
                                    <li>
                                        <div class="second-header-btn">
                                           <a href="{{ route('application.index') }}" target="_blank" class="btn">{{ __('navbar_admission') }}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            @endisset
                        </div>
                        
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

 	
    <!-- Content Start -->
    @yield('content')
    <!-- Content End -->


 	<!-- footer -->
    <footer class="footer-bg footer-p pt-90" style="background-color: #125875;">
        <div class="footer-top pb-70">
            <div class="container">
                <div class="row justify-content-between">
                    
                    <div class="col-xl-4 col-lg-4 col-sm-12">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>{{ __('footer_socials') }}</h2>
                            </div>
                            <div class="footer-social mt-10">                                    
                                @if(isset($socialSetting->facebook))
                                <a href="{{ $socialSetting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if(isset($socialSetting->instagram))
                                <a href="{{ $socialSetting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if(isset($socialSetting->twitter))
                                <a href="{{ $socialSetting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if(isset($socialSetting->linkedin))
                                <a href="{{ $socialSetting->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if(isset($socialSetting->pinterest))
                                <a href="{{ $socialSetting->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                                @endif
                                @if(isset($socialSetting->youtube))
                                <a href="{{ $socialSetting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                                @endif
                            </div>    
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>{{ __('footer_links') }}</h2>
                            </div>
                            <div class="footer-link">
                                <ul>
                                    @if (Route::has('student.login'))
                                    <li><a href="{{ route('student.login') }}" target="_blank">{{ __('field_student') }} {{ __('field_login') }}</a></li>
                                    @endif
                                    @if (Route::has('login'))
                                    <li><a href="{{ route('login') }}" target="_blank">{{ __('field_staff') }} {{ __('field_login') }}</a></li>
                                    @endif

                                    @php 
                                    $application = App\Models\ApplicationSetting::status(); 
                                    @endphp
                                    @isset($application)
                                    <li><a href="{{ route('application.index') }}" target="_blank">{{ __('navbar_admission') }}</a></li>
                                    @endisset

                                    @foreach($footer_pages as $footer_page)
                                    <li><a href="{{ route('page.single', ['slug' => $footer_page->slug]) }}">{{ $footer_page->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-sm-6">
                        <div class="footer-widget mb-30">
                            <div class="f-widget-title">
                                <h2>{{ __('footer_contact') }}</h2>
                            </div>
                            <div class="f-contact">
                                <ul>
                                    @isset($topbarSetting->phone)
                                    <li>
                                        <i class="icon fal fa-phone"></i>
                                        <span><a href="tel:{{ str_replace(' ', '', $topbarSetting->phone ?? '') }}">{{ $topbarSetting->phone ?? '' }}</a></span>
                                    </li>
                                    @endisset
                                    @isset($topbarSetting->email)
                                    <li>
                                        <i class="icon fal fa-envelope"></i>
                                        <span><a href="mailto:{{ $topbarSetting->email ?? '' }}">{{ $topbarSetting->email ?? '' }}</a></span>
                                    </li>
                                    @endisset
                                    @isset($topbarSetting->address)
                                    <li>
                                        <i class="icon fal fa-map-marker-check"></i>
                                        <span>{{ $topbarSetting->address ?? '' }}</span>
                                    </li>
                                    @endisset
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="copyright-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="dropdown">
                          <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $version->name }}
                          </a>

                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @foreach($user_languages as $user_language)
                            <li><a class="dropdown-item" href="{{ route('version', $user_language->code) }}">{{ $user_language->name }}</a></li>
                            @endforeach
                          </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 text-center">          
                        
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 text-center text-md-right">
                        @isset($setting->copyright_text)
                        &copy; {!! strip_tags($setting->copyright_text, '<a><b><i><u><strong>') !!}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->


 	<!-- Script JS -->
 	<script src="{{ asset('web/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('web/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/js/popper.min.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/js/slick.min.js') }}"></script>
    <script src="{{ asset('web/js/paroller.js') }}"></script>
    <script src="{{ asset('web/js/wow.min.js') }}"></script>
    <script src="{{ asset('web/js/js_isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('web/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('web/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('web/js/element-in-view.js') }}"></script>
    <script src="{{ asset('web/js/main.js') }}"></script>

 </body>
</html>