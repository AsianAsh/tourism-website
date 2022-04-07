<?php
session_start();
require_once "./components/header+offcanvas.php";
require_once "./components/navbar.php"; 
?>

<!-- Breadcrumbs -->
<section class="breadcrumbs-custom-inset">
<div class="breadcrumbs-custom context-dark bg-overlay-60">
	<div class="container">
	<h2 class="breadcrumbs-custom-title">About</h2>
	<ul class="breadcrumbs-custom-path">
		<li><a href="index.php">Home</a></li>
		<li class="active">About</li>
	</ul>
	</div>
	<div class="box-position" style="background-image: url(images/aboutus.jpg);"></div>
</div>
</section>
<!-- Why choose us-->
<section class="section section-sm section-first bg-default text-md-left">
<div class="container">
	<div class="row row-50 justify-content-center align-items-xl-center">
	<div class="col-md-10 col-lg-5 col-xl-6"><img src="images/questionmark.jpg" alt="" width="519" height="564"/>
	</div>
	<div class="col-md-10 col-lg-7 col-xl-6">
		<h1 class="text-spacing-25 font-weight-normal title-opacity-9">Why choose us</h1>
		<!-- Bootstrap tabs-->
		<div class="tabs-custom tabs-horizontal tabs-line" id="tabs-4">
		<!-- Nav tabs-->
		<ul class="nav nav-tabs">
			<li class="nav-item" role="presentation"><a class="nav-link active" href="#tabs-4-1" data-toggle="tab">Experience</a></li>
			<li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-2" data-toggle="tab">Skills</a></li>
			<li class="nav-item" role="presentation"><a class="nav-link" href="#tabs-4-3" data-toggle="tab">Mission</a></li>
		</ul>
		<!-- Tab panes-->
		<div class="tab-content">
			<div class="tab-pane fade show active" id="tabs-4-1">
			<p>Aliquam malesuada bibendum arcu vitae elementum curabitur. A erat nam at lectus urna duis convallis convallis tellus. Sit amet consectetur adipiscing elit pellentesque.</p>
			<!-- Linear progress bar-->
			<article class="progress-linear progress-secondary">
				<div class="progress-header">
				<p>Tours</p>
				</div>
				<div class="progress-bar-linear-wrap">
				<div class="progress-bar-linear" data-gradient=""><span class="progress-value">79</span><span class="progress-marker"></span></div>
				</div>
			</article>
			<!-- Linear progress bar-->
			<article class="progress-linear progress-orange">
				<div class="progress-header">
				<p>Excursions</p>
				</div>
				<div class="progress-bar-linear-wrap">
				<div class="progress-bar-linear" data-gradient=""><span class="progress-value">72</span><span class="progress-marker"></span></div>
				</div>
			</article>
			<!-- Linear progress bar-->
			<article class="progress-linear">
				<div class="progress-header">
				<p>Hotel Bookings</p>
				</div>
				<div class="progress-bar-linear-wrap">
				<div class="progress-bar-linear" data-gradient=""><span class="progress-value">88</span><span class="progress-marker"></span></div>
				</div>
			</article>
			</div>
			<div class="tab-pane fade" id="tabs-4-2">
			<div class="row row-40 justify-content-center text-center inset-top-10">
				<div class="col-sm-4">
				<!-- Circle Progress Bar-->
				<div class="progress-bar-circle" data-value="0.87" data-gradient="#01b3a7" data-empty-fill="transparent" data-size="150" data-thickness="12" data-reverse="true"><span></span></div>
				<p class="progress-bar-circle-title">Tours</p>
				</div>
				<div class="col-sm-4">
				<!-- Circle Progress Bar-->
				<div class="progress-bar-circle" data-value="0.74" data-gradient="#01b3a7" data-empty-fill="transparent" data-size="150" data-thickness="12" data-reverse="true"><span></span></div>
				<p class="progress-bar-circle-title">Excursions</p>
				</div>
				<div class="col-sm-4">
				<!-- Circle Progress Bar-->
				<div class="progress-bar-circle" data-value="0.99" data-gradient="#01b3a7" data-empty-fill="transparent" data-size="150" data-thickness="12" data-reverse="true"><span></span></div>
				<p class="progress-bar-circle-title">Hotel Bookings</p>
				</div>
			</div>
			<div class="group-md group-middle"><a class="button button-width-xl-230 button-primary button-pipaluk" href="#">Get in touch</a><a class="button button-black-outline button-width-xl-230" href="#">Read more</a></div>
			</div>
			<div class="tab-pane fade" id="tabs-4-3">
			<p>Orci nulla pellentesque dignissim enim sit. Elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus. Nibh mauris cursus mattis molestie a iaculis at erat pellentesque.</p>
			<div class="text-center text-sm-left offset-top-30 tab-height">
				<ul class="row-16 list-0 list-custom list-marked list-marked-sm list-marked-secondary">
				<li>Lorem ipsum</li>
				<li>Consectetur adipiscing</li>
				<li>Sed do eiusmod</li>
				<li>Tempor incididunt</li>
				<li>Sem fringilla</li>
				<li>Ut venenatis</li>
				</ul>
			</div>
			<div class="group-md group-middle"><a class="button button-width-xl-230 button-primary button-pipaluk" href="#">Get in touch</a><a class="button button-black-outline button-md" href="#">Download presentation</a></div>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>
</section>
<!-- Latest Projects-->
<section class="section section-sm section-fluid bg-default">
<div class="container">
	<h3>Destinations</h3>
</div>
<!-- Owl Carousel-->
<div class="owl-carousel owl-classic owl-timeline" data-items="1" data-md-items="2" data-lg-items="3" data-xl-items="4" data-margin="30" data-autoplay="false" data-nav="true" data-dots="true">
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/france.jpg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-11-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-11-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">The Barat</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/pulau2.jpg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-12-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-12-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">Pulau Lakei</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/pulau3.jpg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-13-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-13-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">Perhentian</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/Stadthuys.jpeg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-14-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-14-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">Stadthuys</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/Batu-Caves.jpeg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-15-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-15-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">Batu Caves</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
	<div class="owl-item">
	<!-- Thumbnail Classic-->
	<article class="thumbnail thumbnail-mary">
		<div class="thumbnail-mary-figure"><img src="images/Cameron-Highlands.jpeg" alt="" width="420" height="308"/>
		</div>
		<div class="thumbnail-mary-caption"><a class="icon fl-bigmug-line-zoom60" href="images/gallery-image-16-1200x800-original.jpg" data-lightgallery="item"><img src="images/gallery-image-16-420x308.jpg" alt="" width="420" height="308"/></a>
		</div>
	</article>
	<div class="thumbnail-mary-description">
		<h5 class="thumbnail-mary-project"><a href="#">Cameron Highlands</a></h5><span class="thumbnail-mary-decor"></span>
		<h5 class="thumbnail-mary-time">
		</h5>
	</div>
	</div>
</div>
</section>
<!-- What people Say-->
<section class="section section-sm section-last bg-default">
<div class="container">
	<h3>What People Say</h3>
	<!-- Owl Carousel-->
	<div class="owl-carousel owl-modern" data-items="1" data-stage-padding="15" data-margin="30" data-dots="true" data-animation-in="fadeIn" data-animation-out="fadeOut" data-autoplay="true">
	<!-- Quote Lisa-->
	<article class="quote-lisa">
		<div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/connor.jpg" alt="" width="100" height="100"/></a>
		<div class="quote-lisa-text">
			<p class="q">Pharetra vel turpis nunc eget lorem dolor sed viverra ipsum. Diam phasellus vestibulum lorem sed risus ultricies. Aenean et tortor at risus viverra adipiscing. Aliquet enim tortor at auctor urna. Tortor aliquam nulla facilisi cras fermentum. Malesuada pellentesque elit eget gravida cum sociis natoque.</p>
		</div>
		<h5 class="quote-lisa-cite"><a href="#">Connor williams</a></h5>
		<p class="quote-lisa-status">Regular Client</p>
		</div>
	</article>
	<!-- Quote Lisa-->
	<article class="quote-lisa">
		<div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/kratos.jpg" alt="" width="100" height="100"/></a>
		<div class="quote-lisa-text">
			<p class="q">Sodales ut etiam sit amet nisl purus. Maecenas accumsan lacus vel facilisis volutpat est. Suscipit adipiscing bibendum est ultricies integer quis auctor. Viverra aliquet eget sit amet tellus cras adipiscing. Posuere ac ut consequat semper viverra nam libero justo laoreet. Iaculis eu non diam phasellus vestibulum lorem sed risus ultricies.</p>
		</div>
		<h5 class="quote-lisa-cite"><a href="#">Sir Kratos</a></h5>
		<p class="quote-lisa-status">Regular Client</p>
		</div>
	</article>
	<!-- Quote Lisa-->
	<article class="quote-lisa">
		<div class="quote-lisa-body"><a class="quote-lisa-figure" href="#"><img class="img-circles" src="images/samuel.jpg" alt="" width="100" height="100"/></a>
		<div class="quote-lisa-text">
			<p class="q">Lacus vestibulum sed arcu non odio euismod lacinia. Pellentesque elit ullamcorper dignissim cras. Ultrices eros in cursus turpis massa tincidunt dui. Nunc pulvinar sapien et ligula ullamcorper malesuada proin. Commodo odio aenean sed adipiscing diam. Sed euismod nisi porta lorem mollis aliquam.</p>
		</div>
		<h5 class="quote-lisa-cite"><a href="#">Samuel Brown</a></h5>
		<p class="quote-lisa-status">Regular Client</p>
		</div>
	</article>
	</div>
</div>
</section>
<!--Counters-->
<!-- Counter Classic-->
<section class="section section-fluid bg-default">
<div class="parallax-container" data-parallax-img="images/lookcliff.png">
	<div class="parallax-content section-xl context-dark bg-overlay-26">
	<div class="container">
		<div class="row row-50 justify-content-center border-classic">
		<div class="col-sm-6 col-md-5 col-lg-3">
			<div class="counter-classic">
			<div class="counter-classic-number"><span class="counter">2</span>
			</div>
			<h5 class="counter-classic-title">Awards</h5>
			</div>
		</div>
		<div class="col-sm-6 col-md-5 col-lg-3">
			<div class="counter-classic">
			<div class="counter-classic-number"><span class="counter">12</span><span class="symbol">+</span>
			</div>
			<h5 class="counter-classic-title">Tours</h5>
			</div>
		</div>
		<div class="col-sm-6 col-md-5 col-lg-3">
			<div class="counter-classic">
			<div class="counter-classic-number"><span class="counter">1</span><span class="symbol">k</span>
			</div>
			<h5 class="counter-classic-title">Travelers</h5>
			</div>
		</div>
		<div class="col-sm-6 col-md-5 col-lg-3">
			<div class="counter-classic">
			<div class="counter-classic-number"><span class="counter">5</span>
			</div>
			<h5 class="counter-classic-title">Team members</h5>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>
</section>

<?php require_once "./components/footer.php"; ?>