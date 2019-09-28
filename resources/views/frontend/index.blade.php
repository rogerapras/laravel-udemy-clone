@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
    <style>
        .homepage .hero:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            background-image: url("{{ setting('site.homepage_image') }}") !important; 
            width: 100%;
            height: 100%;
            z-index: 0;
            opacity: 0.9;
            background-size: cover;
        }
    </style>
@endpush

@section('content')
<section class="homepage">
    <section class="hero d-none d-lg-flex flex-row align-items-center text-center bg-secondary text-white">
  	    <div class="container-fluid">
  	        <h1 class="font-28 fw-600 text-uppercase">What are you working on?</h1>
  		    <p class="font-16 fw-400">Demo is where designers get inspired.</p>
  		    <a class="get-started font-16 fw-400" href="#" title="Get Started">Get Started</a>
  	    </div>
    </section>
    
    <!-- HERO BOTTOM -->
    <section class="home__how_it_works_container d-none d-lg-block">
	    <div class="container home__how_it_works">
		    <div class="col-md-4 home__how_it_works_col d-flex pl-0">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-globe"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">80,000 online courses</span>
		            <div class="home__how_it_works-text-subtitle">
		                Explore a variety of fresh topics
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4 home__how_it_works_col d-flex">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-check-circle"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">Expert instruction</span>
		            <div class="home__how_it_works-text-subtitle">
		                Find the right instructor for you
		            </div>
		        </div>
		    </div>
		    
		    <div class="col-md-4 home__how_it_works_col d-flex">
		        <span class="home__how-it-works-icon">
		            <i class="fa fa-clock-o"></i>
		        </span>
		        <div class="home__how-it-works-text">
		            <span class="home__how_it_works-text-title">Lifetime Access</span>
		            <div class="home__how_it_works-text-subtitle">
		                Learn on your schedule...forever
		            </div>
		        </div>
		    </div>
	    </div>
    </section>


    <!-- Carousel -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex">
                        <div class="bg-light p-4 flex-grow flex-fill d-flex text-center align-items-center flex-column justify-content-center">
                            <h5 class="fw-600 font-18 mb-2">
                                @lang('strings.join_happy_students')
                            </h5>
                            <p class="font-weight-light">@lang('strings.join_happy_students_desc')</p>
                        </div>
                </div>


                <div class="col-sm-12 col-lg-9">
                    <div class="tc-tabs-style6">
                        <base-homepage-categories-tabs :categories="{{ $top_categories }}"></base-homepage-categories-tabs>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CURRENTLY VIEWING -->
    <section class="cards-block py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tc-post-grid-style1 sec-spacer">
                    <base-heading text="{{ __('strings.students_are_viewing') }}"></base-heading>
                    <base-slick-carousel :num_slides="5" :courses="{{ json_encode($most_viewed) }}"></base-slick-carousel>
                </div>
            </div>
        </div>
    </section>
    

    <!-- TOP CATEGORIES -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tc-post-grid-style1 sec-spacer">
                    <base-heading text="{{ __('strings.top_categories') }}"></base-heading>
                </div>
            </div>
        
            <div class="row">
                @foreach($top_subcategories as $subcategory)
                    <base-home-category-card :category="{{ json_encode($subcategory) }}"></base-home-category-card>
                @endforeach 
            </div>
        
        </div>
    </section>



</section>

@endsection
