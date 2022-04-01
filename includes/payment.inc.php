<?php
session_start();
// import
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

    // echo "$totalPrice";
    // echo "$checkIn";

    $stmt = $connection->prepare("INSERT INTO orders(customer_id, tour_id, adult_num, child_num, check_in_date, total_price ) VALUES ($customerID, $tourID, $adult,$child,$checkIn,$totalPrice)");
    // echo $stmt->error;
    // $stmt->bind_param("iiiisi", $customerID, $tourID, $adult, $child, $checkIn, $totalPrice);
    $stmt->execute();
    $stmt->close();

    header("Location: ../index.php?payment=success");
    echo '<script>alert("Thank you for Purchasing!")</script>';
    exit();






}else{
    header("Location: ../index.php?payment=unsuccesful");
    exit();
}





?>