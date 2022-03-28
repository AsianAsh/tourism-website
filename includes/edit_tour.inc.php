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

    // Insert Form Input into tour_packages to Create New Tour
    $stmt = $connection->prepare("UPDATE tour_packages SET name = ?, price = ?, description = ?, trip_duration = ?, 
    location = ?, min_pax = ?, max_pax = ?, start_time = ?, end_time = ? WHERE tour_id = ?");
    $stmt->bind_param("sdsssiissi", $tourName, $tourPrice, $description, $tripDuration, $location, $minPax, $maxPax, $startTime, $endTime, $id);
    $stmt->execute();
    $stmt->close();

    // Edit Tour Image
    if (isset($_FILES["editMainImage"])){
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
    header("Location: ../agent_dashboard.php?tourupdate=success");
    exit();

} elseif(!isset($_GET["id"])){
    header("Location: ../agent_dashboard.php?tourupdate=error");
    exit();
} else{
    header("Location: ../edit_tour.php?id=$id");
    exit();
}
