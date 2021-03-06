<?php 
session_start();
// Return customer to index.php if not logged in
if(!isset($_SESSION["user"]["userID"])){
    header("Location: index.php");
    exit();
}
require_once "./connection/db.php";
require_once "./components/header+offcanvas.php"; 

$tourID = $_GET["id"];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $tourID);
$stmt->execute();
$result = $stmt->get_result();
$tourinfo = $result->fetch_assoc();
$stmt->close();

$price = $tourinfo['price'];
$total = ($price * 0.017) + $price;
$checkIn = $_GET['checkin'];
$adult_num = $_GET['adult'];
$child_num = $_GET['children']
?>

<style>
    .box-space{
    padding-bottom:30px;
    padding-top:25px;
    }
    .container{
    padding-top:80px;
    }
    .btn-purchase{
    display:flex;
    justify-content:center;
    padding-top:30px;
    }
    .back{
    text-align: center;
    padding-top:10px;
    }
</style>

<div class="container">
    <div class="row m-0">
        <div class="col-lg-7 pb-5 pe-lg-5">
            <div class="row">
                <div class="row m-0 bg-light">
                    <div class="box-space">
                        <img src=
                        <?php if(!isset($tourinfo["image"])){
                                echo "images/Melaka-index.jpeg";
                            } else{
                                $image = base64_encode($tourinfo["image"]);
                                echo "'data:image/jpg;charset=utf8;base64, $image'"; //$image is a longblob(bunch of random symbols) so this converts it to image
                            }?>  
                        alt="" class="img-thumbnail" width="550" height="400">
                    </div>
                    <div class="box-space">
                        <p class="h5 m-0">Package Name</p>
                        <p class="text-muted"><?php echo $tourinfo['name']; ?></p>
                    </div>
                    <div class="box-space">
                        <p class="h5 m-0">Description</p>
                        <p class="text-muted"><?php echo $tourinfo['description']; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Trip Duration</p>
                        <p class="text-muted"><?php echo $tourinfo['trip_duration']; ?></p>
                    </div>
                    
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Start Time</p>
                        <p class="text-muted"><?php echo $tourinfo['start_time']; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">End Time</p>
                        <p class="text-muted"><?php echo $tourinfo['end_time']; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Adult</p>
                        <p class="text-muted"><?php echo $adult_num; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Children</p>
                        <p class="text-muted"><?php echo $child_num; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Check In Date</p>
                        <p class="text-muted"><?php echo $checkIn; ?></p>
                    </div>
                    <div class="col-m">
                    <p class="text-muted"></p>
                        <p class="h5 m-0"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 p-0 ps-lg-4 bg-light">
            <div class="row m-0">
                <div class="col-12 px-4">
                    <div class="d-flex align-items-end mt-4 mb-2">
                        <p class="h4 m-0"><span class="pe-1">INFO</span</p>
                        
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Package price</p>
                        <p class="fs-14 fw-bold"><span class="fas fa-dollar-sign mt-1 pe-1 fs-14 ">RM</span><span class="h6"><?php echo $tourinfo['price']; ?></span></p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Quantity</p>
                        <p class="fs-14 fw-bold">1</p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Promo code</p>
                        <p class="fs-14 fw-bold"><span class="fas fa-dollar-sign px-1"></span>No Promo  Available</p>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <p class="textmuted">Service Charge</p>
                        <p class="fs-14 fw-bold">1.7%</p>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <p class="textmuted fw-bold">Total</p>
                        <div class="d-flex align-text-top "> <span class="fas fa-dollar-sign mt-1 pe-1 fs-14 ">RM</span><span class="h4"><?php echo $total; ?></span> </div>
                    </div>
                </div>
            <form action="./includes/payment.inc.php?id=<?php echo $tourID ?>&checkIn=<?php echo $checkIn ?>&adult=<?php echo $adult_num?>&children=<?php echo $child_num?>&totalprice=<?php echo $total?>" method="POST" enctype="multipart/form">
                <div class="h-50 col-12 px-1">
                    <div class="row bg-light m-0">
                        <div class="col-12 px-4 my-4">
                            <p class="fw-bold">Payment detail</p>
                        </div>
                        <div class="col-12 px-4">
                            <div class="form-group m-3">
                                <label for="cardNumber">Card Number</label>
                                <input type="number" class="form-control" placeholder="**** **** **** ****" name="cardNumber" id="cardNumber" required>
                            </div>
                            <div class="form-group m-3">
                                <label for="holderName">Card Holder Name (As stated on card)</label>
                                <input type="text" class="form-control" name="holderName" id="holderName" pattern="([A-z0-9??-??\s]){2,}" required placeholder="Name">
                            </div>
                            <div class="form-group m-3">
                                <label>Card Expiry Date</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="MM" name="expiryMonth" required>
                                    <input type="number" class="form-control" placeholder="YYYY" name="expiryYear" required>
                                </div>
                            </div>
                            <div class="form-group m-3">
                                    <label for="cvv">CVV</label>
                                    <input type="number" class="form-control" name="cvv" id="cvv" placeholder= "***"required>
                                </div>
                                <div class="col-12 text-center mt-2">
                                    <button type="submit" class="btn btn-primary" name="purchaseTour">Purchase</button>
                                </div>
                        </div>
                    </div>
                    <div class="back">
                        <a href="tour_individual.php">Browse Other Tours</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

    

