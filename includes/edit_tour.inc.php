<?php
session_start();
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

    // Insert Form Input into tour_packages to Create New Tour
    $stmt = $connection->prepare("UPDATE tour_packages SET name = ?, price = ?, description = ?, trip_duration = ?, 
    location = ?, min_pax = ?, max_pax = ?, start_time = ?, end_time = ? WHERE tour_id = ?");
    $stmt->bind_param("sdsssiissi", $tourName, $tourPrice, $description, $tripDuration, $location, $minPax, $maxPax, $startTime, $endTime, $id);
    $stmt->execute();
    $stmt->close();

    // Edit Tour Image
    if (!empty($_FILES["editMainImage"])){
        $fileName = basename($_FILES["editMainImage"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileError = $_FILES["editMainImage"]["error"];
        $fileSize = $_FILES["editMainImage"]["size"];
        $allowedTypes = ["jpg", "jpeg", "png"];
    
        // Get number of rows ($num_rows) to check if tour has a Main Image (1 is yes, 0 means no)
        $stmt = $connection->prepare("SELECT tour_id FROM trip_images WHERE tour_id = ? AND image_type = 'Main';");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $num_rows = mysqli_num_rows($result);
        $stmt->close();
    
        // Insert Image into trip_images with TourID as foreign key
        $image = $_FILES["editMainImage"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));
        if ($num_rows == 1){
            $stmt = $connection->prepare("UPDATE trip_images SET image = '".$imgContent."' WHERE tour_id = $id AND image_type = 'Main';");;
        } else{
            $stmt = $connection->prepare("INSERT INTO trip_images(tour_id, image, image_type) VALUES ($id, '".$imgContent."', 'Main');");
        }
        $stmt->execute();
        $stmt->close();
    }
    if ($_SESSION["agent"]["agentID"]){
        header("Location: ../agent_dashboard.php?tourupdate=success");
        exit();
    } elseif($_SESSION["staff"]["staffID"]){
        header("Location: ../staff_dashboard.php?tourupdate=success");
        exit();
    } else{
        header("Location: index.php");
        exit();
    }

} elseif(!isset($_GET["id"])){ // If there is no id in the URL, redirect to the appropriate page based on user role
    if ($_SESSION["agent"]["agentID"]){
        header("Location: ../agent_dashboard.php?tourupdate=error");
        exit();
    } elseif($_SESSION["staff"]["staffID"]){
        header("Location: ../staff_dashboard.php?tourupdate=error");
        exit();
    } else{
        header("Location: index.php");
        exit();
    }
} else{ // Redirect to the appropriate page based on user role
    if (isset($_SESSION["agent"]["agentID"]) || isset($_SESSION["staff"]["staffID"])){
        header("Location: ../edit_tour.php?id=$id");
        exit();
    } else{
        header("Location: index.php");
        exit();
    }
}
