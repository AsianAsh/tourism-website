<?php 
session_start(); 
require_once "./connection/db.php";
// require_once "./helper/helpers.php";

//Search Query for Tour
// if (isset($_GET["q"])) {
// 	$searchQuery = $_GET["q"];
// } else{
// 	$searchQuery = ""; 
// }
// $sortBy = ""; 
$tours = [];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON  t.tour_id = i.tour_id WHERE t.status = 1;"; // Change this to include images/Add image_type column to table 
// Append ORDER BY Clause in SQL to sort the tours based on filter set by customer
// switch ($filter) {
// 	case "priceHigh":
// 		$sql = substr_replace($sql, " ORDER BY price DESC;", -1, -1);
// 		break;

// 	case "priceLow":
// 		$sql = substr_replace($sql, " ORDER BY price ASC;", -1, -1);
// 		break;
// }

$stmt = $connection->prepare($sql);
// $searchQuery = "%$searchQuery%";
// $stmt->bind_param("s", $searchQuery);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
	array_push($tours, $row);
}
$stmt->close(); 

// View the contents of $tours array
// echo "<pre>";
//     var_dump($tours);
// echo "</pre>";
// die;

require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 
?>

<section class="section section-sm bg-default">
	<div class="container">
		<h3 class="oh-desktop"><span class="d-inline-block wow slideInDown">Tours</span></h3>
		<h6 class="pt-2">Tours for you to check out!</h6>
		<div class="row row-sm row-40 row-md-50">

			<div class="col-sm-6 col-md-12 wow fadeInRight">
				<!-- Product Big-->
				<article class="product-big">
					<div class="unit flex-column flex-md-row align-items-md-stretch">
						<div class="unit-left">
							<a class="product-big-figure" href="#"><img src="images/Melaka-index.jpeg" alt="" width="600" height="366"/></a>
						</div>
						<div class="unit-body">
							<div class="product-big-body">
								<h5 class="product-big-title"><a href="#">Malacca</a></h5>
								<div class="group-sm group-middle justify-content-start">
									<div class="product-big-rating">
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star_half"></span>
									</div>
									<a class="product-big-reviews" href="#">4.7/5 (235 customer reviews)</a>
								</div>
								<p class="product-big-text">Malacca is one of the most popular tourist destinations within Malaysia. Enjoy an exciting experience at A 'Famosa Malacca when you visit the famous theme...</p><a class="button button-black-outline button-ujarak" href="#">Buy This Tour</a>
								<div class="product-big-price-wrap">
									<span class="product-big-price">RM500</span>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
			
			<div class="col-sm-6 col-md-12 wow fadeInLeft">
				<!-- Product Big-->
				<article class="product-big">
					<div class="unit flex-column flex-md-row align-items-md-stretch">
						<div class="unit-left">
							<a class="product-big-figure" href="#"><img src="images/Sarawak-index.jpeg" alt="" width="600" height="366"/></a>
						</div>
						<div class="unit-body">
							<div class="product-big-body">
								<h5 class="product-big-title"><a href="#">Sarawak</a></h5>
								<div class="group-sm group-middle justify-content-start">
									<div class="product-big-rating">
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star_half"></span>
									</div>
									<a class="product-big-reviews" href="#">4.8/5 (375 customer reviews)</a>
								</div>
								<p class="product-big-text">The State of Sarawak is divided into 3 geographic areas - coastal lowlands comprising peat swamp as well as narrow deltaic and alluvial plains. A large area of...</p><a class="button button-black-outline button-ujarak" href="#">Buy This Tour</a>
								<div class="product-big-price-wrap">
									<span class="product-big-price">RM800</span>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>

			<p>Loop for All Available Tours start here (The proper images aren't displayed yet)</p>
			<!-- Foreach Loop to Display all Available Tours one by one -->
			<?php foreach ($tours as $tour) : ?>
				<?php //echo $key ?>
			<div class="col-sm-6 col-md-12 wow fadeInLeft">
				<!-- Product Big-->
				<article class="product-big">
					<div class="unit flex-column flex-md-row align-items-md-stretch">
						<div class="unit-left">
							<a class="product-big-figure img-fluid" href="#">
								<img src=
								<?php if(!isset($tour["image"])){
									echo "images/Melaka-index.jpeg";
								} else{
									$image = base64_encode($tour["image"]);
									echo "'data:image/jpg;charset=utf8;base64, $image'"; //$image is a longblob(bunch of random symbols) so this converts it to image
								}?> alt="" width="600" height="366"/></a>
							<!-- <a class="product-big-figure img-fluid" href="#"><img src="<?php //echo "$tour[imagePath]"; ?>" alt="" width="600" height="366"/></a> -->
						</div>
						<div class="unit-body">
							<div class="product-big-body">
								<h5 class="product-big-title pe-5"><a href="#"><?php echo "$tour[name]"; ?></a></h5>
								<div class="group-sm group-middle justify-content-start">
									<!-- <div class="product-big-rating">
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star"></span>
										<span class="icon material-icons-star_half"></span>
									</div> -->
									<a class="product-big-reviews" href="#">4.8/5 (375 customer reviews)</a>
								</div>
								<?php $description = str_replace('[NEWLINE]', "\n", $tour['description']) ?>
								<?php $description = strlen($description) > 180 ? substr($description,0,180)."..." : $description; ?>
								<p class="product-big-text"><?php echo $description; ?></p><a class="button button-black-outline button-ujarak" href="#">More Details</a>
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