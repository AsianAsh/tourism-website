<?php
// To handle request for changing status of tour to 1 (POST received from staff_dashboard.php (ADD button))
session_start();
if (!isset($_SESSION["staff"]["staffID"]) && !isset($_POST["tourID"]) && !isset($_POST["staffID"]) && !isset($_POST["publishTour"]) && !isset($_POST["unpublishTour"])) {
  header("Location: ../index.php");
  exit();
}

// require_once "../helper/helpers.php";
require_once "../connection/db.php";
$tourID = filter_input(INPUT_POST, "tourID", FILTER_SANITIZE_NUMBER_INT); //$_POST["tourID"] Maybe this is the solution
$staffID = filter_input(INPUT_POST, "staffID", FILTER_SANITIZE_NUMBER_INT);

// var_dump($_POST["staffID"]);
// var_dump($_POST["tourID"]);
// var_dump($staffID);
// var_dump($tourID);
// die;

if (isset($_POST["publishTour"])){
	$stmt = $connection->prepare("UPDATE tour_packages SET status = 1, published_by = ? WHERE tour_id = ? ");
	$stmt->bind_param("ii", $staffID, $tourID);
	$stmt->execute();
	$stmt->close();
} elseif(isset($_POST["unpublishTour"])){
	$stmt = $connection->prepare("UPDATE tour_packages SET status = 0, published_by = NULL WHERE tour_id = ? ");
	$stmt->bind_param("i", $tourID);
	$stmt->execute();
	$stmt->close();
}



// $_SESSION["alertMessage"][] = "Item Added";
header("Location: ../staff_dashboard.php");
exit();