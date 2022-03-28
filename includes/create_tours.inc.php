<?php
session_start();
// require_once "../helpers/helpers.php";
require_once "../connection/db.php";

if (isset($_POST["createTour"])){
    $tourName = ucwords($_POST['tourName']);
    $tourPrice = $_POST['tourPrice'];
    $description = str_replace("\n", "[NEWLINE]", $_POST['description']);
    $minPax = $_POST['minPax'];
    $maxPax = $_POST['maxPax'];
    $tripDuration = strtoupper($_POST['tripDuration']);
    $status = 0;
    $location = ucwords($_POST['location']);
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];

    $fileName = basename($_FILES["uploadMainImage"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileError = $_FILES["uploadMainImage"]["error"];
    $fileSize = $_FILES["uploadMainImage"]["size"];
    $allowedTypes = ["jpg", "jpeg", "png"];
    // var_dump($description);
    // print_r($fileType);
    // die;

    // Form Input Validation
    // Check for empty input fields
    if (empty($tourName) || empty($tourPrice) || empty($description) || empty($minPax) || empty($maxPax) || empty($tripDuration) || empty($location) || empty($startTime) || empty($endTime) || empty($_FILES["uploadMainImage"]["name"])) {
        header("Location: ../create_tours.php?tour=empty&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
        exit();
    } else{
        if (strlen($_POST['description']) > 3000){ // Description cannot be more than 3000 characters
            header("Location: ../create_tours.php?tour=description&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
            exit();            
        } else{
            if ($minPax > $maxPax){ // Minimum Pax cannot be more than Maximum Pax
                header("Location: ../create_tours.php?tour=pax&name=$tourName&price=$tourPrice&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
                exit;
            } else{
                if (!in_array($fileType, $allowedTypes)) { //Image has to be jpg, jpeg, or png
                    header("Location: ../create_tours.php?tour=filetype&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
                    exit();
                } else{
                    if ($fileError !== 0) { 
                        header("Location: ../create_tours.php?tour=fileerror&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
                        exit();
                    } else{
                        if ($fileSize > 1000000) {
                            header("Location: ../create_tours.php?tour=filesize&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
                            exit();
                        } else {
                            // Insert Form Input into tour_packages to Create New Tour
                            $stmt = $connection->prepare("INSERT INTO tour_packages(name, price, description, min_pax, max_pax, location, trip_duration, status, 
                            start_time, end_time, agent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                            $stmt->bind_param("sdsiississi", $tourName, $tourPrice, $description, $minPax, $maxPax, $location, $tripDuration, $status, 
                            $startTime, $endTime, $_SESSION["agent"]["agentID"]); 
                            $stmt->execute();
                            $tourID = $stmt->insert_id; //Newly Generated ID for Tour
                            $stmt->close();
                            
                            // Insert Image into trip_images with TourID as foreign key
                            $image = $_FILES["uploadMainImage"]["tmp_name"];
                            $imgContent = addslashes(file_get_contents($image));
                            $stmt = $connection->prepare("INSERT INTO trip_images(tour_id, image, image_type) VALUES ($tourID, '".$imgContent."', 'Main');");
                            $stmt->execute();
                            $stmt->close();

                            header("Location: ../agent_dashboard.php?tourcreation=success");
                            exit();
                        }
                    }
                }
            }
        }
    }
} else{
    header("Location: ../create_tours.php");
    exit();
}
