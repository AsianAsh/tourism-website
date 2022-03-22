<?php
session_start();
// require_once "../helpers/helpers.php";
require_once "../connection/db.php";

if (isset($_POST["updateTour"]) && isset($_GET["id"])){
    $id = $_GET["id"];
    $tourName = ucwords($_POST['tourName']);
    $tourPrice = $_POST['tourPrice'];
    $description = str_replace("\n", "[NEWLINE]", $_POST['description']);
    $minPax = $_POST['minPax'];
    $maxPax = $_POST['maxPax'];
    $tripDuration = strtoupper($_POST['tripDuration']);
    $location = ucwords($_POST['location']);
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    // var_dump($id);
    // var_dump($tourName);
    // var_dump($tourPrice);
    // var_dump($minPax);
    // var_dump($maxPax);
    // var_dump($tripDuration);
    // var_dump($location);
    // var_dump($startTime);
    // var_dump($endTime);
    // die;

    $stmt = $connection->prepare("UPDATE tour_packages SET name=?, price=?, description=?, trip_duration=?, 
    location=?, min_pax=?, max_pax=?, start_time=?, end_time=? WHERE tour_id=?");
    $stmt->bind_param("sdsssiissi", $tourName, $tourPrice, $description, $tripDuration, $location, $minPax, $maxPax, $startTime, $endTime, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../agent_dashboard.php?tourupdate=success");
    exit();
} elseif(!isset($_GET["id"])){
    header("Location: ../agent_dashboard.php?tourupdate=error");
    exit();
} else{
    header("Location: ../edit_tour.php?id=$id");
    exit();
}
