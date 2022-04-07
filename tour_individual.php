<?php 
session_start(); 
if (!isset($_GET["id"])) {
	header("Location: tours.php");
    exit();
} 
require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 

// Details of the Tour
$id = $_GET["id"];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tourDetails = $result->fetch_assoc();
$stmt->close();
$description = str_replace('[NEWLINE]', "\n", $tourDetails["description"]);

// Tours for More Tours Section
$tours = [];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.status = 1 LIMIT 2;";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
	array_push($tours, $row);
}
$stmt->close(); 
?>

<!--Tour Display and Gallery-->
<section class="section section-sm section-fluid bg-default">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-9 col-lg-6 col-xl-5 order-lg-1">
				<div class="unit flex-column flex-md-row align-items-md-stretch">
					<div class="unit-left">
						<img src=
						<?php if(!isset($tourDetails["image"])){
							echo "images/Melaka-index.jpeg";
						} else{
							$image = base64_encode($tourDetails["image"]);
							echo "'data:image/jpg;charset=utf8;base64, $image'"; //$image is a longblob(bunch of random symbols) so this converts it to image
						}?> 
						alt="" class="img-thumbnail" width="550" height="400">
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-6 col-xl-6 item-inner-section order-5 ps-5">
				<h3 class="pt-3 mb-3"><span><?php echo $tourDetails["name"]; ?></span></h3>
				<div class="d-flex justify-content-between align-items-baseline">
					<p class="d-inline mt-2 item-info-price lead fs-3">
						<?php echo "RM " . $tourDetails["price"]; ?>
					</p>
				</div>
				<form class="fw-bold" id="booking-form" action="./includes/tour_individual.inc.php?id=<?php echo $id; ?> "method="POST" novalidate>
					<div class="pt-3">
						<label for="inputCheckInDate" class="mt-1 input-label">Check In: </label>
						<input type="date" class="form-control" name="checkInDate" id="inputCheckInDate" value="" min="" max="" >
					</div>
					<div class="pt-1">
						<label for="inputAdult" class="mt-1 me-3 input-label">Adults: </label>
						<input type="number" class="form-control" name="totalAdults" id="inputAdult" value="" min="1" max="1000">
					</div>
					<div class="pt-1">
						<label for="inputChild" class="mt-1 input-label">Children: </label>
						<input type="number" class="form-control" name="totalChildren" id="inputChild" value="" min="0" max="1000">
					</div>
					<div class="pt-1">
						<button type="submit" class="btn btn-primary mt-3" name="booknow">Book Now</button></div>
					</div>
				</form>
			</div>
		</div>	
	</div>
</section>



<!--Navbar for Tour Info, Description and Reviews-->
<section class="container mt-5">
	<nav class="specific-tabs-section">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<button class=" nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Info</button>
			<button class=" nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Description</button>
		</div>
	</nav>
	<div class="tab-content mt-3" id="nav-tabContent">
		<!-- Info Tab Content-->
		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">Trip Duration</p>
				<p><?php echo $tourDetails["trip_duration"]; ?></p>
			</div>
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">Location</p>
				<p><?php echo $tourDetails["location"]; ?></p>
			</div>
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">Minimum Pax</p>
				<p><?php echo $tourDetails["min_pax"]; ?></p>
			</div>
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">Maximum Pax</p>
				<p><?php echo $tourDetails["max_pax"]; ?></p>
			</div>
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">Start Time</p>
				<p><?php echo $tourDetails["start_time"]; ?></p>
			</div>
			<div class="specific-item-info">
				<p class="specific-item-property fw-bold">End Time</p>
				<p><?php echo $tourDetails["end_time"]; ?></p>
			</div>
		</div>
		<!-- End of Info Tab Content -->

		<!-- Description Tab Content -->
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<p><?php echo nl2br($description); ?></p>
		</div>
		<!-- End of Description Tab Content -->
	</div>
</section>
<!-- End of Nav and Tab for Info, Description, Review -->

<!-- Reviews Section -->
<section class="section section-sm">
	<div class="container">
		<h3>Reviews</h3>
		<h6 class="pt-2">Here's what our customers have to say about their experience!</h6>
		<div class="row row-30">
		<div class="col-sm-6 col-lg-4">
			<article class="box-icon-classic">
			<div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
				<div class="unit-left">
				<div class="box-icon-classic-icon fl-bigmug-line-equalization3"></div>
				</div>
				<div class="unit-body">
				<h5 class="box-icon-classic-title">AshChar02</h5>
				<p class="box-icon-classic-text">Great place to visit. Love the historical landmarks there!</p>
				</div>
			</div>
			</article>
		</div>
		<div class="col-sm-6 col-lg-4">
			<article class="box-icon-classic">
			<div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
				<div class="unit-left">
				<div class="box-icon-classic-icon fl-bigmug-line-circular220"></div>
				</div>
				<div class="unit-body">
				<h5 class="box-icon-classic-title">JohnSmith_TourLover</h5>
				<p class="box-icon-classic-text">Absolutely banging experience. My family and I had tons of fun on our tour.</p>
				</div>
			</div>
			</article>
		</div>
		<div class="col-sm-6 col-lg-4">
			<article class="box-icon-classic">
			<div class="unit box-icon-classic-body flex-column flex-md-row text-md-left flex-lg-column text-lg-center flex-xl-row text-xl-left">
				<div class="unit-left">
				<div class="box-icon-classic-icon fl-bigmug-line-favourites5"></div>
				</div>
				<div class="unit-body">
				<h5 class="box-icon-classic-title">Mano</h5>
				<p class="box-icon-classic-text">I'd 100% recommend this tour to my family and friends!</p>
				</div>
			</div>
			</article>
		</div>
		</div>
	</div>
</section>
<!-- End of Reviews Section -->

<!-- More Tours -->
<section class="section section-sm bg-default">
	<div class="container">
		<h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">Hot Tours</span></h3>
		<div class="row row-sm row-40 row-md-50">
		<!-- Foreach Loop to Display all Available Tours one by one -->
		<?php foreach ($tours as $tour) : ?>
		<div class="col-sm-6 col-md-12 wow fadeInLeft">
			<!-- Product Big-->
			<article class="product-big">
			<div class="unit flex-column flex-md-row align-items-md-stretch">
				<!-- Tour Image -->
				<div class="unit-left">
				<a class="product-big-figure img-fluid" href="#">
					<img src=
					<?php if(!isset($tour["image"])){
					echo "images/Melaka-index.jpeg";
					} else{
					$image = base64_encode($tour["image"]);
					echo "'data:image/jpg;charset=utf8;base64, $image'"; //$image is a longblob(bunch of random symbols) so this converts it to image
					}?> 
					alt="" width="600" height="366"/>
				</a>
				</div>
				<div class="unit-body">
				<div class="product-big-body">
					<!-- Tour Name -->
					<h5 class="product-big-title pe-5"><a href="#"><?php echo "$tour[name]"; ?></a></h5>
					<?php $description = str_replace('[NEWLINE]', "\n", $tour['description']) ?>
					<?php $description = strlen($description) > 180 ? substr($description,0,180)."..." : $description; ?>
					<p class="product-big-text"><?php echo $description; ?></p><a class="button button-black-outline button-ujarak" href="tour_individual.php?id=<?php echo $tour["tour_id"];?>">More Details</a>
					<div class="product-big-price-wrap">
					<span class="product-big-price">RM<?php echo "$tour[price]"; ?></span>
					</div>
				</div>
				</div>
			</div>
			</article>
		</div>
		<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- End of More Tours -->

<?php require_once "./components/footer.php"; ?>