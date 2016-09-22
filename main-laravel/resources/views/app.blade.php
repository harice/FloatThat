<!DOCTYPE html>
<html lang="en">
  <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield("tags")

	  <title>@yield("title") - FloatThat.com</title>

	  <link href="{{ asset('/css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/fonts/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('/fonts/fontello/css/fontello.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/skins/cool_green.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/animations.css') }}" rel="stylesheet">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	  <!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

    @yield("css")

	  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

  </head>
  <body>
    <header class="header fixed clearfix">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">
							<!-- logo -->
							<div id="logo" class="logo">
								<a href="/"><img id="logo_img" src="{{ asset('/img/logo.png') }}" alt="The Project"></a>
							</div>
						</div>
						<!-- header-left end -->
					</div>

					<div class="col-md-10">
						<!-- header-right start -->
						<!-- ================ -->
						<div class="header-right clearfix">
							<div class="main-navigation animated">
								<nav class="navbar navbar-default" role="navigation">
									<div class="container-fluid">

										<!-- Toggle get grouped for better mobile display -->
										<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										</div>

										<!-- Collect the nav links, forms, and other content for toggling -->
										<div class="collapse navbar-collapse" id="navbar-collapse-1">
											<!-- main-menu -->
											<ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('how-it-works') }}">How it works</a></li>
                        <li><a href="{{ url('deals') }}">All Floats</a></li>
                        @if (!Auth::guest())
                          <li><a href="{{ url('/float/create') }}">Start a new float</a></li>
                        @endif
                      </ul>

                      <ul class="nav navbar-nav navbar-right">
					              @if (Auth::guest())
						              <li><a href="{{ url('/auth/login') }}">Login</a></li>
						              <li><a href="{{ url('/auth/register') }}">Register</a></li>
					              @else
						              <li class="dropdown">
							              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              @if (Auth::user()->avatar)
                                <img class="avatar" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"/>
                              @else
                                <img class="avatar" src="/img/profile-no-photo.png"
                                     alt="{{ Auth::user()->name }}" />
                              @endif
                              {{ Auth::user()->name }}
                            </a>
							              <ul class="dropdown-menu" role="menu">
								              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							              </ul>
						              </li>
					              @endif
				              </ul>


										</div>
									</div>
								</nav>
								<!-- navbar end -->
							</div>
							<!-- main-navigation end -->
						</div>
						<!-- header-right end -->
					</div>
				</div>
			</div>
		</header>

    <div id="page_content">
	    @yield('content')
    </div>

	  <!-- Scripts -->
	  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/lib/modernizr.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/lib/facebook.js') }}"></script>
    <script src="{{ asset('js/lib/jstz.min.js') }}"></script>
    <script src="{{ asset('js/lib/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/lib/moment-timezone-with-data.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- importing -->
    @yield('js')
    <!-- end importing -->
  </body>
</html>
