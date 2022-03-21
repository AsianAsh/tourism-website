<?php session_start(); 
require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["user"]["userID"])) {
    header("Location: index.php");
    exit();
}

?>
<div class="container border border-dark profile-container my-5 d-flex align-items-stretch">
    <div class="row align-items-stretch">
        <div class="col-3 px-0  pb-5 nav-tab-container d-flex flex-column justify-content-center">
            <div>
                <!-- Profile Picture -->
                <div class="text-center mb-5">
                    <img src="<?php echo $_SESSION["user"]["profilePic"] ?>" alt=""
                        class="img-fluid shadow rounded-circle userProfilePicture">
                </div>
                <!-- Tab Buttons -->
                <div class="nav nav-tabs profile-tab flex-column" id="nav-tab" role="tablist">
                    <button class=" nav-link active" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="true">Personal Info</button>
                    <button class=" nav-link" id="nav-pic-tab" data-bs-toggle="tab" data-bs-target="#nav-pic"
                        type="button" role="tab" aria-controls="nav-pic" aria-selected="false">Profile
                        Picture</button>
                    <button class=" nav-link" id="nav-privacy-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-privacy" type="button" role="tab" aria-controls="nav-privacy"
                        aria-selected="false">Change Password</button>
                    <button class=" nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order"
                        type="button" role="tab" aria-controls="nav-order" aria-selected="false">Order
                        History</button>
                </div>
            </div>
        </div>
        <div class="col-9 my-auto">
            <div class="tab-content mt-3" id="nav-tabContent">
                <!-- Personal Info Tab  -->
                <div class="tab-pane fade mx-auto active show" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <form action="" class="row g-3 justify-content-center"
                        id="profile-form" method="POST">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="inputFirstName" placeholder="First Name"
                                name="firstName" value="<?php echo $_SESSION["user"]["firstName"];?>">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="inputLastName" placeholder="Last Name"
                                name="lastName" value="<?php echo $_SESSION["user"]["lastName"];?>">
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                value="<?php echo $_SESSION["user"]["email"];?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="tel" class="form-control" id="inputTelephone" placeholder="123456789"
                                name="mobileNumber" value="<?php echo $_SESSION["user"]["mobileNumber"]; ?>" readonly>
                            <?php /*if (isset($profileErrorArray) && in_array("mobileNumber", $profileErrorArray)) :  ?>
                            <p class="mt-1 text-danger mb-0 d-block">Please enter a valid mobile number</p>
                            <?php endif; */?>
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="customerDOB" name="DOB"
                                value="<?php echo $_SESSION["user"]["dob"];?>" readonly>
                        </div>
                        <div class="col-12 text-center"><button type="submit"
                                class="btn offcanvas-save-profile rounded-pill mt-5 px-5"
                                name="saveProfile">Save</button></div>
                    </form>
                </div>
                <!-- End of Personal Info Tab -->


                <!-- Profile Picture Tab -->
                <div class="tab-pane fade" id="nav-pic" role="tabpanel" aria-labelledby="nav-pic-tab">
                    <div class="outer-crop-wrapper text-center">
                        <!-- Image Box to preview new profile picture -->
                        <div class="box mx-auto">
                            <img src="" alt="" id="cropBox" style="display: block; max-width: 100%;">
                        </div>
                        <small class="imageExtensionMessage">Only jpg, png and jpeg are accepted</small>
                        <!-- End of Image Box -->
                    </div>

                    <div class="mt-5">
                        <form action="./includes/update_profile_pic.inc.php" class="imageForm" method="POST">
                            <input type="hidden" name="uploadPic" value="">
                            <input type="file" class="fileInput" accept="image/png, image/jpg, image/jpeg">
                            <button type="reset" class="btn btn-dark fileInputResetBtn">Reset</button>
                            <button class="hidden uploadPicBtn btn" type="button">Upload</button>
                        </form>

                        <form action="./includes/update_profile_pic.inc.php" class="" method="POST">
                            <button class="hidden btn btn-danger removePicBtn" type="submit"
                                name="removeProfilePic">Remove Current Pic</button>
                        </form>
                    </div>
                </div>
                <!-- End of Profile Picture Tab -->


                <!-- Password Tab -->
                <div class="tab-pane fade" id="nav-privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
                    <form action="" class="row g-3 justify-content-center"
                        id="password-form" method="POST">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Current Password"
                                name="oldPassword">
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="New Password"
                                name="newPassword">
                        </div>
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Retype Password"
                                name="confirmPassword">
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn offcanvas-save-profile rounded-pill mt-5 px-5"
                                name="changePass">Save</button>
                        </div>
                    </form>
                </div>
                <!--  End of Password Tab-->


                <!-- Order History Tab -->
                <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                    <div class="container review-container">
                        <h2 class="text-center my-auto">No previous orders</h2>
                        <!-- <button type="button" id="testBtn">Button</button> -->
                        <!-- Container for each Order -->
                        <?php /*if (empty($orderId)) : ?>
                        <h2 class="text-center my-auto">No previous orders.</h2>
                        <?php else:?>
                        <?php foreach ($orderId as $order):
                        $total = getOrderTotal($order, $connection);
                        $orderItems = getOrderItems($order, $connection);?>
                        <div class="card mb-3 border rounded">
                            <!-- Row for each Order Item in Order -->
                            <?php foreach ($orderItems as $item):?>
                            <div class="card border-0 bg-transparent">
                                <div class="card-body border-bottom">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="<?php echo "$item[image]";?>" alt="Item Image"
                                                class="img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <p class="my-auto"><?php echo $item["name"];?></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>x<?php echo $item["quantity"];?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-end">
                                                        RM<?php //echo number_format($item["subtotal"],2 , ".", "");?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">

                                                <!-- Rate Button to toggle review form off-canvas -->
                                                <!-- <?php $rateEligibility = rateEligibility($item["orderItemId"], $connection);
                                                if ($item["itemType"] == "product"):
                                                    if ($rateEligibility == 0):?>
                                                <button class="btn btn-warning" data-bs-toggle="offcanvas"
                                                    href="#reviewCanvas" id="<?php echo $item["orderItemId"]?>"
                                                    onClick="clickForId(this.id)" name="toRate" role="button"
                                                    aria-controls="reviewCanvasExample">Rate</button>
                                                <?php else: ?>
                                                <button class="btn btn-light border" role="button"
                                                    aria-disabled="true" disabled>Rated</button>
                                                <?php endif;?>
                                                <?php endif;?> -->

                                                <!-- End of Rate Button -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- End of Row for each Order Item in Order -->
                            <div class="card-footer">
                                <p class="text-end">
                                    OrderID: <?php echo $order;?><br>
                                    Order Total: RM<?php echo number_format($total, 2, '.', '');?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif;*/?> 
                        <!-- End of Container for each Order --> 
                    </div>
                </div>
                <!-- End of Order History Tab -->
            </div>
        </div>
    </div>
</div>


<?php require_once "./components/scripts.php"; ?>