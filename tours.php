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
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.status = 1;";
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

require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 
?>

<?php
// if(isset($_POST["submit"])){
// 	$search = $_POST["search"];
// 	$S_query = $connection->prepare('SELECT * FROM tour_packages WHERE location LIKE :keyword');
// 	$S_query->bindvalue(':keyword','%'.$search.'%',PDO::PARAM_STR);
// 	$S_query->execute();
// 	$result2 = $S_query->fetchAll();
// 	$row2 = $S_query->rowcount();
// }


?>

<section class="section section-sm bg-default">
	<div class="container">
		<h3 class="oh-desktop"><span class="d-inline-block wow slideInDown pb-2">Tours</span></h3>
		<form class="py-2" action="" method="POST">
			<div class="input-group rounded">
				<input type="search" class="form-control rounded" placeholder="Search Tours" aria-label="Search" aria-describedby="search-addon" name="search" />
				<input type="submit" class="input-group-text border-0" id="search-addon" value="Search" name="submit">
					<!-- <i class="fas fa-search"></i> -->
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
								<!-- <div class="group-sm group-middle justify-content-start">
									<a class="product-big-reviews" href="#">4.8/5 (375 customer reviews)</a>
								</div> -->
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