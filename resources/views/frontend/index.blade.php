@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<section class="homepage">
    <section class="hero d-flex flex-row align-items-center text-center bg-secondary text-white">
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
          <div class="col-md-3 col-lg-3 d-flex">
            <div class="bg-light p-4 flex-grow flex-fill d-flex text-center align-items-center flex-column justify-content-center">
                <h5 class="fw-600 font-18">The world's largest selection of courses</h5>
                <p>Learn anything, anywhere, anytime</p>
            </div>
          </div>


          <div class="col-md-9 col-lg-9">
            <div class="tc-tabs-style3">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" href="#development">Developoment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#design">Design</a>
                    </li>
                </ul>
                <div class="tab-content tc-post-grid-style1 sec-spacer">
                    <div id="development" class="tab-pane in active">
                        <base-slick-carousel :num_slides="4"></base-slick-carousel>
                    </div>
                </div>	                			
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
                    <base-heading text="Students are viewing"></base-heading>
                    <base-slick-carousel :num_slides="5"></base-slick-carousel>
                </div>
            </div>
        </div>
    </section>
    

    <!-- TOP CATEGORIES -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tc-post-grid-style1 sec-spacer">
                    <base-heading text="Top Categories"></base-heading>
                </div>
            </div>
        
            <div class="row">
                <base-home-category-card name="Development" icon="im im-icon-Code-Window"></base-home-category-card>
                <base-home-category-card name="Business" icon="im im-icon-Bar-Chart"></base-home-category-card>
                <base-home-category-card name="IT and Software" icon="im im-icon-Computer-3"></base-home-category-card>
                <base-home-category-card name="Design" icon="im im-icon-Fountain-Pen"></base-home-category-card>
                <base-home-category-card name="Photography" icon="im im-icon-Old-Camera"></base-home-category-card>
                <base-home-category-card name="Health and Fitness" icon="im im-icon-Stethoscope"></base-home-category-card>
                <base-home-category-card name="Music" icon="im im-icon-Cloud-Music"></base-home-category-card>
                <base-home-category-card name="Marketing" icon="im im-icon-Target-Market"></base-home-category-card>
            </div>
        
        </div>
    </section>



</section>

@endsection
