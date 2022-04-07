<?php
session_start();
require_once "./components/header+offcanvas.php";
require_once "./components/navbar.php"; 
?>

<!-- Contact information-->
<section class="section section-sm section-first bg-default">
<div class="container">
	<div class="row row-30 justify-content-center">
	<div class="col-sm-8 col-md-6 col-lg-4">
		<article class="box-contacts">
		<div class="box-contacts-body">
			<div class="box-contacts-icon fl-bigmug-line-cellphone55"></div>
			<div class="box-contacts-decor"></div>
			<p class="box-contacts-link"><a href="tel:#">+603-1555-8030</a></p>
			<p class="box-contacts-link"><a href="tel:#">+6014-888-8030</a></p>
		</div>
		</article>
	</div>
	<div class="col-sm-8 col-md-6 col-lg-4">
		<article class="box-contacts">
		<div class="box-contacts-body">
			<div class="box-contacts-icon fl-bigmug-line-up104"></div>
			<div class="box-contacts-decor"></div>
			<p class="box-contacts-link"><a href="#">B-47, AOU Avenue, Bukit Springs, 43200 Kajang, Selangor, Malaysia</a></p>
		</div>
		</article>
	</div>
	<div class="col-sm-8 col-md-6 col-lg-4">
		<article class="box-contacts">
		<div class="box-contacts-body">
			<div class="box-contacts-icon fl-bigmug-line-chat55"></div>
			<div class="box-contacts-decor"></div>
			<p class="box-contacts-link"><a href="mailto:#">traveltime@gmail.com</a></p>
			<p class="box-contacts-link"><a href="mailto:#">sales@traveltime.com</a></p>
		</div>
		</article>
	</div>
	</div>
</div>
</section>

<!-- Contact Form-->
<section class="section section-sm section-last bg-default text-left">
	<div class="container">
		<article class="title-classic">
			<div class="title-classic-title">
				<h3>Get in touch</h3>
			</div>
			<div class="title-classic-text">
				<p>If you have any questions, just fill in the contact form, and we will answer you shortly.</p>
			</div>
		</article>
		<form class="rd-form rd-form-variant-2 rd-mailform" data-form-output="form-output-global" data-form-type="contact" method="post" action="bat/rd-mailform.php">
			<div class="row row-14 gutters-14">
				<div class="col-md-4">
					<div class="form-wrap">
						<input class="form-input" id="contact-your-name-2" type="text" name="name" data-constraints="@Required">
						<label class="form-label" for="contact-your-name-2">Your Name</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-wrap">
						<input class="form-input" id="contact-email-2" type="email" name="email" data-constraints="@Email @Required">
						<label class="form-label" for="contact-email-2">E-mail</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-wrap">
						<input class="form-input" id="contact-phone-2" type="text" name="phone" data-constraints="@Numeric">
						<label class="form-label" for="contact-phone-2">Phone</label>
					</div>
				</div>
				<div class="col-12">
					<div class="form-wrap">
						<label class="form-label" for="contact-message-2">Message</label>
						<textarea class="form-input textarea-lg" id="contact-message-2" name="message" data-constraints="@Required"></textarea>
					</div>
				</div>
			</div>
			<button class="button button-primary button-pipaluk" type="submit">Send Message</button>
		</form>
	</div>
</section>

<?php require_once "./components/footer.php"; ?>