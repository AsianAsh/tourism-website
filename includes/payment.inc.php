<?php
session_start();
require_once "../connection/db.php";

if(isset($_POST["purchaseTour"])){
    $customerID = $_SESSION["user"]["userID"] ?? null;
    $tourID = $_GET["id"];
    $sql = "SELECT * FROM tour_packages WHERE tour_id = $tourID";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $tourinfo = $result->fetch_assoc();
    $stmt->close();

    $customerID = $_SESSION["user"]["userID"] ?? null;
    $adult = $_GET["adult"];
    $child = $_GET["children"];
    $checkIn = $_GET["checkIn"];
    $tourName = $tourinfo['name'];
    $totalPrice = $_GET["totalprice"];
    $cardNum = $_POST['cardNumber'];
    $cardName = $_POST['holderName'];
    $expMonth = $_POST['expiryMonth'];
    $expYear = $_POST['expiryYear'];
    $cvv = $_POST['cvv'];

    $stmt = $connection->prepare("INSERT INTO orders(customer_id, tour_id, adult_num, child_num, check_in_date, total_price) VALUES ($customerID, $tourID, $adult,$child,$checkIn,$totalPrice)");
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