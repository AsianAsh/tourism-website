<?php
session_start();
require_once "../connection/db.php";

if(isset($_POST["purchaseTour"])){
    $customerID = $_SESSION["user"]["userID"] ?? null;
    $tourID = $_GET["id"];
    $sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $tourID);
    $stmt->execute();
    $result = $stmt->get_result();
    $tourinfo = $result->fetch_assoc();
    $stmt->close();

    $customerID = $_SESSION["user"]["userID"] ?? null;
    // $tourID = $tourinfo['tour_id'];
    $adult = $_GET["adult"];
    $child = $_GET["children"];
    $checkIn = $_GET["checkIn"];
    // $checkOut = $tourinfo['check-out_date'];
    $totalPrice = $_GET["totalprice"];
    $cardNum = $_POST['cardNumber'];
    $cardName = $_POST['holderName'];
    $expMonth = $_POST['expiryMonth'];
    $expYear = $_POST['expiryYear'];
    $cvv = $_POST['cvv'];




}
// if(isset($_POST['booknow'])){



// }

?>