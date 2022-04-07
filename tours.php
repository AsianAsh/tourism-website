<?php 
session_start(); 
require_once "./connection/db.php";
//Search Query for Tour
if (isset($_GET["q"])) {
	$searchQuery = $_GET["q"];
} else{
	$searchQuery = ""; 
}
$tours = [];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.status = 1 AND t.name LIKE '%$searchQuery%';";

$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
	array_push($tours, $row);
}
$stmt->close(); 

require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 
?>

<section class="section section-sm bg-default">
	<div class="container">
		<h3 class="oh-desktop"><span class="d-inline-block wow slideInDown pb-2">Tours</span></h3>
		<!-- Search Bar -->
		<form class="py-2" method="GET">
			<div class="input-group rounded">
				<input type="text" class="form-control rounded" placeholder="Search for Tours" aria-label="Search" aria-describedby="search-addon" name="q" value="<?php echo $searchQuery?>"/>
				<button type="submit" class="btn btn-outline-secondary" id="search-addon">Search</button>
				</span>
			</div>
		</form>
		<h6 class="pt-3">Tours for you to check out!</h6>

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

<?php require_once "./components/footer.php"; ?>