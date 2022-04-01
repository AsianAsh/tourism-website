<!-- VALIDATION FOR TOUR INDIVIDUAL HERE -->

<!-- check in datetime
adult =
children = array
post into payment.php using url if validation ok

<?php

if (isset($_POST['booknow'])){

    require_once "../connection/db.php";

    $id = $_GET["id"];
    $Adult = $_POST['totalAdults'];
    $Children = $_POST['totalChildren'];
    $CheckIn = $_POST['checkInDate'];
    // $maxpep =$_POST["max"];
    // $minpep = $_POST["min"];

    $sql = "SELECT * FROM tour_packages WHERE tour_id=$id";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tourinfo = $result->fetch_assoc();
    $stmt->close();

    $minpax = $tourinfo['min_pax'];
    $maxpax = $tourinfo['max_pax'];



    // check for empty input field

    if(empty($Adult) || empty($Children) || empty($CheckIn))  {
        // echo "Please enter valid info";
        header("Location:../tour_individual.php?signup=empty");
        exit();
    }
    else{
        
        header("Location: ../payment.php?id=$id&adult=$Adult&children=$Children&checkin=$CheckIn");
                exit();
        // if($Adult || $Children > $maxpax){
        //     header('Location:../tour_individual.php?signup=empty');
        //     exit();
        // }
        // if ($Adult || $Children < $minpax){
        //     header('Location:../tour_individual.php?signup=empty');
        //     exit();
        // }
        // else{
            // ($Adult || $Children == $minpax || $maxpax){
        // }
        }
    }





?>