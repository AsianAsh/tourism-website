<?php
session_start();
// require_once "../helpers/helpers.php";
require_once "../connection/db.php";

if (isset($_POST["createTour"])){

    //$result = adminValidateProduct($_POST);
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

    // var_dump($description);
    //   die;

    // Check for empty input fields
    if (empty($tourName) || empty($tourPrice) || empty($description) || empty($minPax) || empty($maxPax) || empty($tripDuration) || empty($location) || empty($startTime) || empty($endTime)) {
        header("Location: ../create_tours.php?tour=empty");
        exit();
    } else{
        if (strlen($description) > 1000){
            header("Location: ../create_tours.php?tour=description&name=$tourName&price=$tourPrice&min=$minPax&max=$maxPax&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
            exit();            
        } else{
            if($minPax > $maxPax){
                header("Location: ../create_tours.php?tour=pax&name=$tourName&price=$tourPrice&duration=$tripDuration&location=$location&starttime=$startTime&endtime=$endTime");
                exit;
            } else{

                // var_dump($startTime);
                // var_dump($endTime);
                // die;
                $stmt = $connection->prepare("INSERT INTO tour_packages(name, price, description, min_pax, max_pax, location, trip_duration, status, 
                start_time, end_time, agent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                $stmt->bind_param("sdsiississi", $tourName, $tourPrice, $description, $minPax, $maxPax, $location, $tripDuration, $status, 
                $startTime, $endTime, $_SESSION["agent"]["agentID"]); 
                $stmt->execute();
                $stmt->close();

                header("Location: ../agent_dashboard.php?tourcreation=success");
                exit();
            }
        }
    }
} else{
    header("Location: ../create_tours.php");
    exit();
}
