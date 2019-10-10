<!DOCTYPE html>
<!--[if IE 7 ]><body class="ie ie7"><![endif]-->
<!--[if IE 8 ]><body class="ie ie8"><![endif]-->
<!--[if IE 9 ]><body class="ie ie9"><![endif]-->
<html class='no-js' lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta content="" name="keywords">
	<meta content="" name="description">

	<link type="image/x-icon" href="landing/img/favicon.ico" rel="shortcut icon">
	<link rel="stylesheet" href="landing/css/bootstrap.css">
	<link rel="stylesheet" href="landing/css/font-awesome.css">
	<link rel="stylesheet" href="landing/css/main.css">
	<link rel="stylesheet" href="landing/css/responsive.css">


</head>
<body>
<!--===========================-->
<!--==========Header===========-->
<div id="preloader">
	<div id="status">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
</div>

<div class="main-holder">
<header class='main-wrapper header'>
	<div class="container apex">
		<div class="row">

			<nav class="navbar header-navbar" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<div class="logo navbar-brand">
						{{ config('app.name', 'Laravel') }}
					</div>
		      <button class='toggle-slide-left visible-xs collapsed navbar-toggle' type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"><i class="fa fa-bars"></i></button>
				</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<div class="navbar-right">
						<nav class='nav-menu navbar-left main-nav trig-mob slide-menu-left'>
							<ul class='list-unstyled'>
								<li>
									<a href="#" data-scroll="information">
										<div class="inside">
											<div class="backside"> Information </div>
											<div class="frontside"> Information </div>
										</div>
									</a>
								</li>
								<li>
									<a href="#" data-scroll="features">
										<div class="inside">
											<div class="backside"> Features </div>
											<div class="frontside"> Features </div>
										</div>
									</a>
								</li>
								<li>
									<a href="#" data-scroll="testimonials">
									<div class="inside">
										<div class="backside"> Testimonials </div>
										<div class="frontside"> Testimonials </div>
									</div>
									</a>
								</li>
								<li>
									<a href="#" data-scroll="gallery">
										<div class="inside">
											<div class="backside"> Gallery </div>
											<div class="frontside"> Gallery </div>
										</div>
									</a>
								</li>
								<li>
									<a data-toggle="modal" role="button" href="#myModal">
										<div class="inside">
											<div class="backside"> Contact </div>
											<div class="frontside"> Contact </div>
										</div>
									</a>
								</li>
								<li>
									<a href="{{ route('login') }}" data-scroll="login">
										<div class="inside">
											<div class="backside"> Login </div>
											<div class="frontside"> Login </div>
										</div>
									</a>
								</li>
							</ul>
						</nav>
						<div class="wr-soc">
							<div class="header-social">
								<ul class='social-transform unstyled'>
								<li>
									<a href='#' target='blank' class='front'><div class="fa fa-facebook"></div></a>
								</li>
								<li>
									<a href='#' target='blank' class='front'><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href='#' target='blank' class='front'><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href='#' target='blank' class='front'><i class='fa fa-vimeo-square'></i></a>
								</li>
								</ul>
							</div>
						</div>
					</div>
		    </div><!-- /.navbar-collapse -->
			</nav>

		</div>
	</div>
</header>


<!--===========================-->
<!--==========Content==========-->
<div class='main-wrapper content'>
	<section class="relative software_slider">
		<div class="forma-slider">
			<div class="container">
				<div class="row">
					<div id="form_slider" data-anchor="form_slider">

						<ul class="form-bxslider list-unstyled">
							<li>
								<div class="list-forstart fin_1">
									<h2 class='h-Bold'>For Easy Start</h2>
									<p class='desc'>Olypian quarrels et gorilla congolium sic ad nauseum.</p>
									<ul class='ul-list-slider Open-sansR'>
										<li>Curabitur Tempor Sapien</li>
										<li>Maecenas Porttitor Ligula Adipiscing</li>
										<li>Contests with $ 1.000.000 Magna Feugiat</li>
										<li>Morbi Varius Egestas</li>
									</ul>
								</div>
								<div class="img-slider hidden-xs slide-man1 fin_2"></div>
							</li>
							<li>
								<div class="list-forstart fin_1">
									<h2 class='h-Bold'>Be an  Expert</h2>
									<p class='desc'>Epsum factorial non deposit quid pro quo hic escorol. Olypian quarrels et gorilla congolium sic ad nauseum.</p>
									<ul class='ul-list-slider Open-sansR'>
										<li>Curabitur Tempor Sapien</li>
										<li>Maecenas Porttitor Ligula Adipiscing </li>
										<li>Contests with $ 1.000.000 Magna</li>
									</ul>
								</div>
								<div class="img-slider hidden-xs slide-man2 fin_2"></div>
							</li>
							<li>
								<div class="list-forstart fin_1">
									<h2 class='h-Bold'>For the Best</h2>
									<ul class='ul-list-slider Open-sansR'>
										<li>24 / 7 Curabitur Tempor Sapien</li>
										<li>Maecenas Porttitor Ligula Adipiscing </li>
										<li>Contests with $ 1.000.000 Magna Feugiat </li>
										<li>Morbi Varius Egestas</li>
									</ul>
								</div>
								<div class="img-slider hidden-xs slide-man3 fin_2"></div>
							</li>
						</ul>
						<div class="bx-controls bx-has-pager bx-has-controls-direction" id='dafault_pager'>
							<div class="bx-pager bx-default-pager">
								<div class="bx-pager-item">
									<a class="bx-pager-link pager-Ico1" data-slide-index="0" href=""><span>Begginer</span></a>
								</div>

								<div class="bx-pager-item">
									<a class="bx-pager-link pager-Ico2 active" data-slide-index="1" href=""><span>Expert</span></a>
								</div>

								<div class="bx-pager-item lastItem">
									<a class="bx-pager-link pager-Ico3" data-slide-index="2" href=""><span>God</span></a>
								</div>
							</div>
						</div>
					</div>

					<div class="clearfix visible-xs visible-md"></div>

					<div class="container relative fin_3" id='elem-portable'>
						<div class="reg-now">
							<h2 class='medium-h text-center'>Sign up now for free</h2>
							<h3 class='xsmall-h text-center'>Nulla ornare tortor quis rhoncus vulputate. </h3>

							<form class='reg-now-visible' id='formIndex' action="contact-form.php" method="post" accept-charset="utf-8" role="form">
								<div class='control-group'>
									<input type="text" name="name" value="" placeholder='Enter your name' data-required>
								</div>
								<div class='control-group'>
									<input type="text" name="email" value="" class='insert-attr' placeholder='Enter your mail' data-required>
								</div>
								<div class='control-group'>
									<input type="text" name="phone" value="" placeholder='Enter your telephone' data-required data-pattern="^[0-9]+$">
								</div>


									<div class="relative">
										<select name="caoch" class="styled">
											<option value="Select Your Caoch">Select Your Caoch</option>
											<option value="Caoch 1" >Caoch 1</option>
											<option value="Caoch 2" >Caoch 2</option>
											<option value="Caoch 3" >Caoch 3</option>
										</select>
									</div>

									<div class="relative">
										<select name="file" class="styled">
											<option value="Select File">Select File</option>
											<option value="File 1">File 1</option>
											<option value="File 2">File 2</option>
											<option value="File 3">File 3</option>
										</select>
									</div>

								 <button type="submit" value="Register Now" class='btn submit sub-form' name="submit">Register Now</button>
							</form>

						</div>
					</div>
				</div>
			</div><!-- end container -->
		</div>
	</section>

	<section class='dark-blue'>
		<div class="container make-row">
			<div class="row">
				<div class="col-md-3 col-sm-6 make-md">
					<h4 class='division-h sem-h' id='animIt1'>Next seminar</h4>
				</div>

				<ul class='list-unstyled seminars'>
					<li id='animIt2' class='col-md-3 col-sm-6'>
						<i class="fa fa-calendar"></i>
						<div class="media">
							<h4 class='division-h'>Date</h4>
							<span>Desember 27th, 2013</span>
						</div>
					</li>
					<li id='animIt3' class='col-md-3 col-sm-6'>
						<i class="fa fa-clock-o"></i>
						<div class="media">
							<h4 class='division-h'>Time</h4>
							<span>10:00 am - 4:30 pm </span>
						</div>
					</li>
					<li id='animIt4' class='col-md-3 col-sm-6'>
						<i class="fa fa-map-marker"></i>
						<div class="media">
							<h4 class='division-h'>Location</h4>
							<span>Deutsche Bahn, Ulm, Baden-Württemberg</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="container" data-anchor="features">
		<div class="spacer6"></div>
			<h2 class='text-center xxh-Bold'>Why people choose Advisa Trainings?</h2>
			<h3 class='text-center xmedium-h'>Your main Features</h3>
			<div class="row trainings" id='trainings'>
				<div class="col-md-3 col-xs-6 hov1">
					<figure class='thumbnails'>
						<i class='fa fa-shield'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Yearly Programs Upgrades</h4>
					<div class="full-text">
						Nulla ornare tortor quis rhoncus vulputate. Suspendisse commodo fringilla tellus vitae facilisis.
					</div>
				</div>

				<div class="col-md-3 col-xs-6 hov2">
					<figure class='thumbnails'>
						<i class='fa fa-heart-o'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Best Learning Programs</h4>
					<div class="full-text">
						Nulla ornare tortor quis rhoncus vulputate. Quisque vehicula quis sapien a accumsan
					</div>
				</div>

				<div class="col-md-3 col-xs-6 hov3">
					<figure class='thumbnails'>
						<i class='fa fa-refresh'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>100% Money Back</h4>
					<div class="full-text">
						Nulla ornare tortor quis rhoncus vulputate. Fusce enim erat, volutpat id nisi quis, blandit sodales est
					</div>
				</div>

				<div class="col-md-3 col-xs-6 hov4">
					<figure class='thumbnails'>
						<i class='fa fa-book'></i>
					</figure>
					<h4 class='xxsmall-h text-center transition-h'>Small groups, Individual Learning</h4>
					<div class="full-text">
						Nulla ornare tortor quis rhoncus vulputate. Vivamus a enim
					</div>
				</div>
			</div>
		<div class="offsetY-4"></div>
	</section>

	<section class="bg-darkblue">
		<div class="container make-row" data-anchor="information">
			<div class="row">
				<div class="col-sm-6 media-wr" id='animIt5'>
					<figure class='media-news'>
						<a href='http://www.youtube.com/embed/VOJyrQa_WR4?rel=0&amp;wmode=transparent' class="group1" title='This is title text'>
							<img src="landing/img/staticks/thumb01.jpg" alt="alt..." >
							<i class="zoom-ico"></i>
						</a>
					</figure>
				</div>

				<div class="col-sm-6" id='animIt6'>
					<h2 class='xh-Bold'>Take a shortlook at our video introduction</h2>
					<div class="excerpt">
						Suspendisse commodo fringilla tellus vitae facilisis. Sed tempor diam ut lectus porta rhoncus. Suspendisse fringilla ligula eu pretium sodales. Mauris non egestas velit. Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio. Aliquam congue nunc turpis.  Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio.
					</div>
					<a href="#" class='more'>
						<div class="inside">
							<div class="backside"> View more Videos </div>
							<div class="frontside"> View more Videos </div>
						</div>
					</a>
				</div>
			</div>
			<div class="spacer2"></div>
		</div>

		<div class="container make-row">
			<div class="row">
				<div class="col-sm-6" id='animIt7'>
					<h2 class='xh-Bold'>Receive international graduation certificate</h2>
					<div class="excerpt">
						Suspendisse commodo fringilla tellus vitae facilisis. Sed tempor diam ut lectus porta rhoncus. Suspendisse fringilla ligula eu pretium sodales. Mauris non egestas velit. Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio. Aliquam congue nunc turpis.  Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio.
					</div>
					<a href="#" class='more'>
						<div class="inside">
							<div class="backside"> View more Videos </div>
							<div class="frontside"> View more Videos </div>
						</div>
					</a>
					<div class="spacer2"></div>
				</div>

				<div class="col-sm-6 media-wr" id='animIt8'>
					<figure class='media-news'>
						<a href="landing/img/staticks/fullsize/img_1.jpg" class="group3" title='There can be written anything'>
							<img src="landing/img/staticks/thumb01.jpg" alt="alt..." >
							<i class="zoom-icoBw"></i>
						</a>
					</figure>
				</div>
			</div>
			<div class="spacer2"></div>
		</div>

		<div class="container make-row">
			<div class="row">
				<div class="col-sm-6 media-wr" id='animIt9'>
					<figure class='media-news'>
						<a href="landing/img/staticks/fullsize/img_1.jpg" class="group3" title='This is title text'>
							<img src="landing/img/staticks/thumb01.jpg" alt="alt..." >
							<i class="zoom-icoBw"></i>
						</a>
					</figure>
				</div>

				<div class="col-sm-6" id='animIt10'>
					<h2 class='xh-Bold'>The best Advisa in next year</h2>
					<div class="excerpt">
						Suspendisse commodo fringilla tellus vitae facilisis. Sed tempor diam ut lectus porta rhoncus. Suspendisse fringilla ligula eu pretium sodales. Mauris non egestas velit. Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio. Aliquam congue nunc turpis.  Duis imperdiet ullamcorper ante sed varius. Sed quis orci odio. 					</div>
					<a href="#" class='more'>
						<div class="inside">
							<div class="backside"> View Training Program (pdf - 453K) </div>
							<div class="frontside"> View Training Program (pdf - 453K) </div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="container tables" id='about'>
		<h2 class='text-center xxh-Bold'>We have some Special Bundles for you</h2>
		<h3 class='text-center xmedium-h'>Your main Features</h3>

		<div class='auto-x'>
			<div class="row">
				<div class="col-sm-4 noR-border table-offers" id='animIt11'>
					<table class='table package-services not-favorable basic'>
						<caption class='noR-border'>Basic</caption>
						 <thead>
							<tr>
								<td><b><sup>$</sup>99</b>.95</td>
							</tr>
						 </thead>
						<tbody>
							<tr>
								<td>Morbi Vel Aliquet Arcu</td>
							</tr>
							<tr>
								<td>300 Aenean Hendrerit Tempor <br> Quisque Lectus Leo</td>
							</tr>
							<tr>
								<td>200 Vestibulum Nisi Metus</td>
							</tr>
							<tr class='lastTr'>
								<td><a class='btn buy-now' href='#'>Buy Now</a></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="col-sm-4 profitable table-offers" id='animIt13'>
					<table class='table package-services business'>
						<caption>Business</caption>
						 <thead>
							<tr>
								<td><b><sup>$</sup>499</b>.95</td>
							</tr>
						 </thead>
						<tbody>
							<tr>
								<td>Morbi vel aliquet arcu</td>
							</tr>
							<tr>
								<td>4×300 Aenean Hendrerit Tempor <br> Quisque Lectus Leo</td>
							</tr>
							<tr>
								<td>4×300 Vestibulum Nisi</td>
							</tr>
							<tr>
								<td>4×300 Aenean Hendrerit Tempor</td>
							</tr>
							<tr>
								<td>Vitae Pretium</td>
							</tr>
							<tr class='lastTr'>
								<td><a class='btn buy-now offsetY-5' href='#'>Buy Now</a></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class='col-sm-4 noL-border table-offers' id='animIt12'>
					<table class='table package-services not-favorable premium'>
						<caption class='noL-border'>Premium</caption>
						 <thead>
							<tr>
								<td><b><sup>$</sup>799</b>.95</td>
							</tr>
						 </thead>
						<tbody>
							<tr>
								<td>Morbi vel aliquet arcu</td>
							</tr>
							<tr>
								<td>8×300 Aenean Hendrerit Tempor <br> Quisque Lectus Leo</td>
							</tr>
							<tr>
								<td>12×300 Vestibulum Nisi</td>
							</tr>
							<tr>
								<td>8×300 Aenean Hendrerit Tempor</td>
							</tr>
							<tr>
								<td>Vitae Pretium</td>
							</tr>
							<tr class='lastTr'>
								<td><a class='btn buy-now offsetY-6' href='#'>Buy Now</a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<section id="aboutUs_slider" data-anchor="testimonials">
		<h3 class='slide-title text-center'>What people say about us?</h3>
		<h4 class='xxmedium-h text-center'>Testimonals of our Customers </h4>
		<div class="container">
			<ul class="aboutUs-slider unstyled">
				<li>
					<figure class="thumbnail">
						<a href="#">
							<img src="landing/img/staticks/user1.png" alt="img">
						</a>
					</figure>
					<div class="quote">
					Aenean mollis tortor placerat mauris ornare suscipit. Praesent vitae faucibus sem. Nulla facilisi. Suspendisse quam dolor, suscipit tincidunt venenatis malesuada, interdum eu erat. Donec tempor tristique
					</div>
					<span class="author">John Doe (SEO of LLF Corp.)</span>
				</li>
				<li>
					<figure class="thumbnail">
						<a href="#">
							<img src="landing/img/staticks/user1.png" alt="img">
						</a>
					</figure>
					<div class="quote">
					Aenean mollis tortor placerat mauris ornare suscipit. Praesent vitae faucibus sem. Nulla facilisi. Suspendisse quam dolor, suscipit tincidunt venenatis malesuada, interdum eu erat. Donec tempor tristique
					</div>
					<span class="author">John Doe (SEO of LLF Corp.)</span>
				</li>
				<li>
					<figure class="thumbnail">
						<a href="#">
							<img src="landing/img/staticks/user1.png" alt="img">
						</a>
					</figure>
					<div class="quote">
					Aenean mollis tortor placerat mauris ornare suscipit. Praesent vitae faucibus sem. Nulla facilisi. Suspendisse quam dolor, suscipit tincidunt venenatis malesuada, interdum eu erat. Donec tempor tristique
					</div>
					<span class="author">John Doe (SEO of LLF Corp.)</span>
				</li>
			</ul>
		</div>
	</section>

	<section class="container make-row" data-anchor="gallery">
		<h2 class='text-center xxh-Bold'>See Gallery from Last Event</h2>
		<h3 class='text-center xmedium-h'>Your main Features</h3>

		<div class="row" id='gallery'>
			<div class="col-md-4 col-sm-6 animIt14">
				<figure class='media-news'>
					<a href="landing/img/staticks/fullsize/img_1.jpg" class="group2 bwWrapper">
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>

			<div class="col-md-4 col-sm-6 animIt14">
				<figure class='media-news'>
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>

			<div class="col-md-4 col-sm-6 animIt14">
				<figure class='media-news'>
					<a href="landing/img/staticks/fullsize/img_1.jpg" class="group2 bwWrapper">
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>

			<div class="col-md-4 col-sm-6 animIt15">
				<figure class='media-news'>
					<a href="landing/img/staticks/fullsize/img_1.jpg" class="group2 bwWrapper">
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>

			<div class="col-md-4 col-sm-6 animIt15">
				<figure class='media-news'>
					<a href="landing/img/staticks/fullsize/img_1.jpg" class="group2 bwWrapper">
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>

			<div class="col-md-4 col-sm-6 animIt15">
				<figure class='media-news'>
					<a href="landing/img/staticks/fullsize/img_1.jpg" class="group2 bwWrapper">
						<img src="landing/img/staticks/pop1.jpg" alt="alt..." >
						<i class="zoom-icoBw"></i>
					</a>
				</figure>
			</div>
		</div>
		<div class="spacer5"></div>
		<div class="text-center">
			<a href="#" class='more pull-none blue-text'>
				<div class="inside">
					<div class="backside"> View More Photo </div>
					<div class="frontside"> View More Photo </div>
				</div>
			</a>
		</div>
		<div class="spacer5"></div>
	</section>
</div>

<!--===========================-->
<!--=========Footer============-->
<footer class='main-wrapper footer'>
	<div class="partners" id='partners'>
		<div class="container make-row">
			<div class="row">
				<h4 class='division-h col-md-2 dark-text'>Our Partners</h4>

				<div id='animIt16' class='col-md-2'>
					<a href="#"><img src="landing/img/staticks/sponsor1.png" alt="alt..."></a>
				</div>
				<div id='animIt17' class='col-md-2'>
					<a href="#"><img src="landing/img/staticks/sponsor1.png" alt="alt..."></a>
				</div>
				<div id='animIt18' class='col-md-2'>
					<a href="#"><img src="landing/img/staticks/sponsor1.png" alt="alt..."></a>
				</div>
				<div id='animIt19' class='col-md-2'>
					<a href="#"><img src="landing/img/staticks/sponsor1.png" alt="alt..."></a>
				</div>
				<div id='animIt20' class='col-md-2'>
					<a href="#"><img src="landing/img/staticks/sponsor1.png" alt="alt..."></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<a href="#" data-scroll="form_slider" class='btn submit a-trig reg-footer'>Register Now</a>
	</div>
	<div class="container bottom">

		<ul class='social-transform footer-soc list-unstyled'>
			<li>
				<a href='#' target='blank' class='front'><div class="fa fa-facebook"></div></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class="fa fa-twitter"></i></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class="fa fa-google-plus"></i></a>
			</li>
			<li>
				<a href='#' target='blank' class='front'><i class='fa fa-vimeo-square'></i></a>
			</li>
		</ul>
		<div class="clearifx"></div>
		<span class="copyright">
			&#169; 2013 Advisa.com
		</span>
		<div class="container-fluid responsive-switcher hidden-md hidden-lg">
			<i class="fa fa-mobile"></i>
			Mobile version: Enabled
		</div>
	</div>
</footer>


<!-- Top -->
<div id="back-top-wrapper" class="visible-lg">
	<p id="back-top" class='bounceOut'>
		<a href="#top">
			<span></span>
		</a>
	</p>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-hidden="true">
	<div class="modal-wr">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

		<form id='contact' action="request-form.php" method="post" accept-charset="utf-8" role="form">
			<input type="hidden" name='resultCaptcha' value=''>
			<div class='control-group'>
				<input type="text" name='name' value='' placeholder='Enter your name' data-required>
			</div>
			<div class='control-group'>
				<input type="text" name='email' value='' placeholder='Enter your mail' class='insert-attr' data-required>
			</div>
			<div class='control-group'>
				<textarea name='message' cols="30" rows="10" maxlength="300" placeholder='Enter your message ...' data-required></textarea>
			</div>
			<div class='control-group captcha'>
				<div class="picture-code">
					What is <span id="numb1">4</span> + <span id="numb2">1</span> (Anti-spam)
				</div>
				<input type="text" placeholder='Type here ...' name='name' id='chek' data-required data-pattern="5">
			</div>
			<button type="submit" value="Submit" class='btn submit' name="submit">Submit</button>
		</form>
	</div>
</div>


</div>
	<div class="mask"></div>
	<script src="landing/js/libs/jquery-1.10.1.min.js"></script>
	<script src="landing/js/libs/bootstrap.min.js"></script>
	<script src="landing/js/cross/modernizr.js"></script>
	<script src="landing/js/jquery.bxslider.min.js"></script>
	<script src="landing/js/jquery.customSelect.js"></script>
	<script src="landing/js/jquery.validate.min.js"></script>
	<script src="landing/js/jquery.colorbox-min.js"></script>
	<script src="landing/js/jquery.waypoints.min.js"></script>
	<script src="landing/js/jquery.parallax-1.1.3.js"></script>
	<script src="landing/js/custom.js"></script>
	<!-- file loader -->
	<script src="landing/js/loader.js"></script>

</body>
</html>