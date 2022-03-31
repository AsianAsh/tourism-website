<?php
session_start();
require_once "../connection/db.php";

if(isset($_POST["purchaseTour"])){
    $tourID = $_GET["id"];
    $sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $tourID);
    $stmt->execute();
    $result = $stmt->get_result();
    $tourinfo = $result->fetch_assoc();
    $stmt->close();

    $customerID = $_SESSION["user"]["userID"] ?? null;
    $tourID = $tourinfo['tour_id'];
    // $adult = 
    // $child =
    $checkIn = $tourinfo['check-in_date'];
    $checkOut = $tourinfo['check-out_date'];
    // $totalPrice = 
}
// if(isset($_POST['booknow'])){



// }

?>