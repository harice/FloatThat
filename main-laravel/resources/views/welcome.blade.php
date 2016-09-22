@extends('app')

@section('title')
  Online shopping is now social
@endsection

@section('js')
  <script src="{{ asset('js/lib/jquery.vide.min.js') }}"></script>

  <script>
   //Video Background
	 //-----------------------------------------------
	 if($(".video-background").length>0) {
		   if (Modernizr.touch) {
		       $(".video-background").vide({
		           mp4: "videos/background-video-banner.mp4",
		           webm: "videos/background-video-banner.webm",
		           poster: "videos/video-fallback.jpg"
		       }, {
		           volume: 1,
		           playbackRate: 1,
		           muted: true,
		           loop: true,
		           autoplay: true,
		           position: "50% 100%", // Similar to the CSS `background-position` property.
		           posterType: "jpg", // Poster image type. "detect" â€” auto-detection; "none" â€” no poster; "jpg", "png", "gif",... - extensions.
		           resizing: true
		       });
		   } else {
		       $(".video-background").vide({
		           mp4: "videos/background-video-banner.mp4",
		           webm: "videos/background-video-banner.webm",
		           poster: "videos/video-banner-poster.jpg"
		       }, {
		           volume: 1,
		           playbackRate: 1,
		           muted: true,
		           loop: true,
		           autoplay: true,
		           position: "50% 100%", // Similar to the CSS `background-position` property.
		           posterType: "jpg", // Poster image type. "detect" â€” auto-detection; "none" â€” no poster; "jpg", "png", "gif",... - extensions.
		           resizing: true
		       });
		   };

	 };


   if (($("[data-animation-effect]").length>0) && !Modernizr.touch) {
			 $("[data-animation-effect]").each(function() {
				   if(Modernizr.mq('only all and (min-width: 768px)') && Modernizr.csstransitions) {
					     var waypoints = $(this).waypoint(function(direction) {
						       var appearDelay = $(this.element).attr("data-effect-delay"),
						           animatedObject = $(this.element);
						       setTimeout(function() {
							         animatedObject.addClass('animated object-visible ' + animatedObject.attr("data-animation-effect"));
						       }, appearDelay);
						       this.destroy();
					     },{
						       offset: '90%'
					     });
				   } else {
					     $(this).addClass('object-visible');
				   }
			 });
	 };
  </script>
@endsection

@section('content')
	<section id="banner" class="video-background pv-40 dark-translucent-bg hovered">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<h2 class="text-center object-non-visible" data-animation-effect="zoomIn" data-effect-delay="100">Online shopping is now social</h2>
					<div class="separator object-non-visible" data-animation-effect="zoomIn" data-effect-delay="100"></div>

					<p class="large text-center object-non-visible" data-animation-effect="zoomIn" data-effect-delay="200">
            We make purchasing and gifting a fun and interactive experience.
          </p>

          <p class="text-center"><a href="{{ url("auth/login") }}" class="btn btn-lg btn-gray-transparent object-non-visible" data-animation-effect="zoomIn" data-effect-delay="300">Sign Up</a></p>

				</div>
			</div>
		</div>
	</section>

  <section id="featured">
    <div class="container">

      @if (session('success'))
        <div class="alert alert-icon alert-success" role="alert">
		      <i class="fa fa-check"></i>
		      {{ session('success') }}
	      </div>
      @endif

      <h2>Some of our featured deals</h2>

	    <div class="row masonry-grid-fitrows grid-space-10">
        @foreach ($deals as $deal)
          <div class="col-md-3 col-sm-6 masonry-grid-item">
				    <div class="listing-item white-bg bordered mb-20">
					    <div class="overlay-container">
						    <img src="{{ asset($deal->image_path) }}" alt="{{ $deal->name }}">
						    <a class="overlay-link" href="{{ url('float', $deal) }}"><i class="fa fa-arrow-right"></i></a>
						    <span class="badge">NEW</span>
					    </div>
					    <div class="body">
						    <h3><a href="{{ url('float', $deal) }}">{{ $deal->name }}</a></h3>
						    <p class="small" style="display: none;">{{ str_limit($deal->description, 100) }}.</p>
						    <div class="elements-list clearfix">
							    <span class="price">{{ money_format('$%i', $deal->price) }}</span>
							    <a href="#" class="pull-right margin-clear btn btn-sm btn-default btn-animated">I want this <i class="fa fa-arrow-right"></i></a>
						    </div>
					    </div>
				    </div>
			    </div>
        @endforeach
	    </div>

      <p class="text-center">
        <a href="{{ url("deals") }}" class="btn radius-50 btn-default-transparent btn-lg">View more deals</a>
      </p>

    </div>
  </section>


  <div class="footer">
	  <div class="container">
		  <div class="footer-inner">
			  <div class="row">
				  <div class="col-md-6 col-md-offset-3">
					  <div class="footer-content text-center padding-ver-clear">
						  <div class="logo-footer"><img id="logo-footer" class="center-block" src="{{ asset('/img/logo.png') }}" alt=""></div>
						  <p>
                FloatThat is a website that that makes Purchasing and Gifting a fun and interactive experience. One can choose to simply purchase items our intvite members to participate in a Group Purchase for gifting purposes. Members can also engage other members to Float a deal allowing the total cost of the item to be spread evenly amongst the participating members and choosing 1 winner. FloatThat will also introduce a Task Tracker that alows members to track daily / everyday activities and accumulating points that can be uased to Float deals.
              </p>
						  <ul class="list-inline mb-20">
							  <li><i class="text-default fa fa-map-marker pr-5"></i>One infinity loop, 54100</li>
							  <li><a href="tel:+00 1234567890" class="link-dark"><i class="text-default fa fa-phone pl-10 pr-5"></i>+00 1234567890</a></li>
							  <li><a href="mailto:info@theproject.com" class="link-dark"><i class="text-default fa fa-envelope-o pl-10 pr-5"></i>info@theproject.com</a></li>
						  </ul>
						  <a href="#" class="btn btn-default-transparent btn-lg btn-hvr hvr-sweep-to-top smooth-scroll">Sign Up Now</a>
						  <div class="separator"></div>
						  <p class="text-center margin-clear">Copyright © 2015 Floathat.com. All Rights Reserved</p>
					  </div>
				  </div>
			  </div>
		  </div>
	  </div>
  </div>


@endsection
