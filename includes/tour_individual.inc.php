<!-- VALIDATION FOR TOUR INDIVIDUAL HERE -->

<!-- check in datetime
adult =
children = array
post into payment.php using url if validation ok

<?php


if (isset($_POST['booknow'])){

    require_once "../connection/db.php";

    $Adult = $_POST['totalAdults'];
    $Children = $_POST['totalChildren'];
    $CheckIn = $_POST['checkInDate'];


    // check for empty input field

    if(empty($Adult) || empty($Children) || empty($CheckIn))  {
        header('Location:../tour_individual.php?signup=empty');
        exit();
    }



}




?>