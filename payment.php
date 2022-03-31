<?php session_start(); ?>
<?php 
// Return customer to index.php if not logged in
if(!isset($_SESSION["user"]["userID"])){
    header("Location: index.php");
    exit();
}

require_once "./connection/db.php";
require_once "./components/header+offcanvas.php"; 


// $customerID = $_SESSION["user"]["userID"] ?? null;
$tourID = $_GET["id"];
$sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $tourID);
$stmt->execute();
$result = $stmt->get_result();
$tourinfo = $result->fetch_assoc();
$stmt->close();
?>
<?php

$price = $tourinfo['price'];
$total = ($price * 0.017) + $price;
$checkIn = $_POST['checkInDate'];



// if (isset('purchaseTour'))
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

<form action="./includes/payment.inc.php?id=<?php $_GET['id']?>&checkIn=<?php $_GET['checkIn']?>&adult=<?php $_GET['adult']?>&childeren=<?php $_GET['children']?>"method="POST" enctype="multipart/form">
<input type="hidden" name="totalChildren" id="inputChild" value="" min="0" max="1000" disabled>
<input type="hidden" name="totalAdult" id="inputChild" value="" min="0" max="1000" disabled>
<input type="hidden" name="checkIndate" id="inputChild" value="" min="0" max="1000" disabled>

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
                        <p class="text-muted"><?php echo $tourinfo['end_time']; ?></p>
                    </div>
                    <div class="col-md-4 col-6 ps-30 my-4">
                        <p class="h5 m-0">Children</p>
                        <p class="text-muted"><?php echo $tourinfo['end_time']; ?></p>
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
                                <input type="text" class="form-control" name="holderName" id="holderName" pattern="([A-z0-9À-ž\s]){2,}" required placeholder="Name">
                            </div>
    
                            <div class="form-group m-3">
                                <label>Card Expiry Date</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" placeholder="MM" name="expiryMonth" required>
                                    <input type="number" class="form-control" placeholder="YY" name="expiryYear" required>
                                </div>
                            </div>
                            <div class="form-group m-3">
                                    <label for="cvv">CVV</label>
                                    <input type="number" class="form-control" name="cvv" id="cvv" placeholder= "***"required>
                                </div>
                            <div class="btn-purchase">
                                <div class="btn btn-primary" type="submit" name="purchaseTour">Purchase<span class="fas fa-arrow-right ps-2">
                                </span> 
                            </div>
                        </div>
                    </div>
                    <div class="back">
                        <a href="tour_individual.php">Browse Other Tours</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<?php

// if (!isset)


?>

    

