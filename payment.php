<?php session_start(); ?>
<?php 
// Return customer to index.php if not logged in
if(!isset($_SESSION["user"]["userID"])){
    header("Location: index.php");
    exit();
}
// if (isset($userid)){
//     $tourinfo = getTourInfo($tourid,$connection);
// }
$customerID = $_SESSION["user"]["userID"] ?? null;


?>
<?php require_once "./connection/db.php";?>
<?php require_once "./components/header+offcanvas.php"; ?>
<?php require_once "./helpers/helpers.php"?>



<div class=" container-fluid p-5 m-3 ">
    <div class="row mx-lg-5 justify-content-around">
        <!-- cart details -->
        <section class="col-md-7 py-3 px-lg-5 border bg-light rounded-3 d-flex justify-content-end flex-column">
            <div class="h4 mt-3 mb-4">Tour Package</div>
            <section class="container">
                <div class="row border-bottom mb-4">
                    <div class="col-1"></div>
                    <h6 class=" col-6 text-center">Package Name</h6>
                    <!-- <h6 class=" col-3 text-center">Quantity</h6> -->
                    <h6 class=" col-2 text-end">Total Price</h6>
                </div>
            </section>
            <section class="cart-container container overflow-auto">
            
            </section>
        
</div>








<div>
    
    <!-- payment -->
    <section class="col-md-4 py-2 px-lg-2 border bg-light rounded-3  d-flex align-items-center flex-column justify-content-center">
            <div class="row">
                <h3 class="m-4">Payment Info</h3>
            </div>
            <div class="container">
                <div class="card mb-3">
                    <!-- Payment Method -->
                    <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item credit-card" role="presentation">
                            <button class="nav-link active" id="credit-card-tab" data-bs-toggle="pill" data-bs-target="#credit-card-method" type="button" role="tab" aria-controls="credit-card-method" aria-selected="true">
                                <i class="far fa-credit-card fa-md p-2"></i>
                                Credit Card
                            </button>
                        </li>
                        <li class="nav-item online-banking" role="presentation">
                            <button class="nav-link" id="online-banking-tab" data-bs-toggle="pill" data-bs-target="#online-banking-method" type="button" role="tab" aria-controls="online-banking-method" aria-selected="false">
                                <i class="fas fa-university fa-md p-2"></i>
                                FPX Online Banking
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active m-4" id="credit-card-method" role="tabpanel" aria-labelledby="credit-card-tab">
                            <form action="" method="POST">
                                <input type="hidden" name="paymentMethod" value="Credit Card">
                                <input type="hidden" name="total" class="paymentTotal" value="">
                                <input type="hidden" name="deliveryMethod" class="orderDelivery" value="">
                                <div class="form-group m-3">
                                    <label for="cardType" class="pb-1">Select Your Card Type</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cardType" id="visa-card" value="VISA Card" checked>
                                        <label class="form-check-label" for="visa-card">
                                            <i class="fab fa-cc-visa fa-lg me-2"></i>VISA
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cardType" id="mastercard" value="MasterCard">
                                        <label class="form-check-label" for="mastercard">
                                            <i class="fab fa-cc-mastercard fa-lg me-2"></i>MasterCard
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-3">
                                    <label for="holderName">Card Holder Name (As stated on card)</label>
                                    <input type="text" class="form-control" name="holderName" id="holderName" pattern="([A-z0-9À-ž\s]){2,}" required>
                                </div>
                                <div class="form-group m-3">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="number" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX" name="cardNumber" id="cardNumber" required>
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
                                    <input type="number" class="form-control" name="cvv" id="cvv" required>
                                </div>
                                <div class="form-group text-center m-3">
                                    <button class="btn btn-primary payment-btn disabled" type="submit" name="cardPaymentBtn">Confirm</button>
                                </div>
                            </form>
                        </div>
                        <!-- End of Credit Card -->
                        <div class="tab-pane fade" id="online-banking-method" role="tabpanel" aria-labelledby="online-banking-tab">
                            <form action="" method="POST">
                                <input type="hidden" name="paymentMethod" value="Banking">
                                <input type="hidden" name="total" class="paymentTotal" value="">
                                <input type="hidden" name="deliveryMethod" class="orderDelivery" value="">
                                <div class="form-group m-3">
                                    <label for="paymentMethod" class="pb-1">Select Your Bank</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bank" id="maybank" value="Maybank" checked>
                                        <label class="form-check-label" for="maybank">
                                            Maybank2u
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bank" id="cimb-bank" value="CIMB Bank">
                                        <label class="form-check-label" for="cimb-bank">
                                            CIMB Bank
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="bank" id="public-bank" value="Public Bank">
                                        <label class="form-check-label" for="public-bank">
                                            Public Bank
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-3">
                                    <label for="bank-account">Account Name</label>
                                    <input type="text" class="form-control" placeholder="" name="bank-account" id="bank-account" required>
                                </div>
                                <div class="form-group m-3">
                                    <label for="bank-password">Password</label>
                                    <input type="password" class="form-control" placeholder="" name="bank-password" id="bank-password" required>
                                </div>
                                <div class="form-group text-center m-3">
                                    <button class="btn btn-primary payment-btn disabled" type="submit" name="bankingPaymentBtn">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
        </section>
        <!-- end of payment -->
</div>
    

