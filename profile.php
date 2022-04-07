<?php 
session_start(); 
require_once "./components/header+offcanvas.php"; 
require_once "./components/navbar.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["user"]["userID"])) {
    header("Location: index.php");
    exit();
}

$errArray = [];
if (isset($_SESSION["errorsArray"])) {
    $errArray =  $_SESSION["errorsArray"];
    unset($_SESSION["errorsArray"]);
}

require_once "./connection/db.php";
$userID = $_SESSION["user"]["userID"];
$orderHistory= [];
$sql = "SELECT * FROM orders WHERE customer_id = $userID";
$stmt = $connection->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()){
    array_push($orderHistory,$row);
}
$stmt->close();
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
                    <button class=" nav-link <?php if(!isset($_GET["profilepwd"])){echo "active";}?>" id="nav-profile-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                        aria-selected="true">Personal Info</button>
                    <button class=" nav-link <?php if(isset($_GET["profilepwd"])){echo "active";}?>" id="nav-privacy-tab" data-bs-toggle="tab"
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
                <div class="tab-pane fade mx-auto <?php if(!isset($_GET["profilepwd"])){echo "active show";}?>" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <form action="./includes/update_profile.inc.php" class="row g-3 justify-content-center" id="profile-form" method="POST">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="inputFirstName" placeholder="First Name"
                                name="firstName" value="<?php echo $_SESSION["user"]["firstName"];?>">
                            <?php if (in_array("firstName", $errArray)) : ?>
                                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please enter a valid name</p>
                            <?php endif?>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="inputLastName" placeholder="Last Name"
                                name="lastName" value="<?php echo $_SESSION["user"]["lastName"];?>">
                            <?php if (in_array("lastName", $errArray)) : ?>
                                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please enter a valid name</p>
                            <?php endif?>
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                value="<?php echo $_SESSION["user"]["email"];?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-text">+60</div>
                                <input type="tel" class="form-control" id="inputTelephone" placeholder="123456789"
                                    name="mobileNumber" value="<?php echo $_SESSION["user"]["mobileNumber"]; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="form-control" id="customerDOB" name="DOB"
                                value="<?php echo $_SESSION["user"]["dob"];?>" readonly>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary" name="saveProfile">Save</button>
                        </div>
                        <?php if (in_array("profileEmpty", $errArray)) : ?>
                            <p class="mt-3 text-danger text-center fs-5 mb-0 ps-1 d-block">Please fill in all fields!</p>
                        <?php endif?>
                    </form>
                    <!-- Update Profile Pic Section -->
                    <form action="./includes/update_profile.inc.php" enctype="multipart/form-data" class="row g-3 justify-content-center" id="profile-pic-form" method="POST">
                        <div class="col-12 text-center">
                            <h3 class="text-decoration-underline">Update Profile Picture</h3>
                            <input type="file" class="fileInput mt-3" id="inputProfilePic" name="inputProfilePic" accept="image/png, image/jpg, image/jpeg">
                            <button type="submit" class="btn btn-primary" name="uploadProfilePic">Upload</button>
                        </div>
                        <?php if (in_array("profilePic", $errArray)) : ?>
                            <p class="mt-1 text-danger text-center mb-0 ps-3 d-block">Failed to upload profile picture</p>
                        <?php endif?>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary" name="removeProfilePic">Reset To Default Pic</button>
                        </div>
                    </form>                
                </div>
                <!-- End of Personal Info Tab -->

                <!-- Change Password Tab -->
                <div class="tab-pane fade <?php if(isset($_GET["profilepwd"])){echo "active show";}?>" id="nav-privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
                    <form action="./includes/update_profile.inc.php" class="row g-3 justify-content-center"
                        id="password-form" method="POST">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Current Password" name="oldPassword">
                        </div>
                        <?php if (in_array("wrongPwd", $errArray)) : ?>
                            <p class="mt-1 text-danger mb-0 ps-3 d-block">Incorrect Password!</p>
                        <?php endif?>
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="New Password" name="newPassword">
                        </div>
                        <?php if (in_array("samePwd", $errArray)) : ?>
                            <p class="mt-1 text-danger mb-0 ps-3 d-block">New password cannot be the same as current password!</p>
                        <?php endif?>
                        <?php if (in_array("invalidPwd", $errArray)) : ?>
                            <p class="mt-1 text-danger mb-0 ps-3 d-block">Please enter a new valid password!</p>
                        <?php endif?>
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Retype Password" name="confirmPassword">
                        </div>
                        <?php if (in_array("diffPwd", $errArray)) : ?>
                            <p class="mt-1 text-danger mb-0 ps-3 d-block">Please make sure new password and retype password are the same!</p>
                        <?php endif?>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary mt-3"
                                name="changePwd">Change Password</button>
                        </div>
                        <?php if (in_array("pwdEmpty", $errArray)) : ?>
                            <p class="mt-3 text-danger text-center fs-5 mb-0 ps-1 d-block">Please fill in all fields!</p>
                        <?php endif?>
                    </form>
                </div>
                <!--  End of Change Password Tab-->

                <!-- Order History Tab -->
                <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
                    <div class="container review-container">
                        <div class="home-content">
                            <div class="overview boxes">
                                <table class="table table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tour id</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">No. of Adult</th>
                                            <th scope="col">No. of Children</th>
                                            <!-- <th scope="col">Check Out Date</th> -->
                                            <th scope="col">Total Price</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($orderHistory as $order):?>
                                        <tr class="align-middle">
                                            <td><?php echo $order["tour_id"]?></td>
                                            <td><?php echo $order["order_date"]?></td>
                                            <td><?php echo $order["adult_num"]?></td>
                                            <td><?php echo $order["child_num"]?></td>
                                            <td><span>RM</span><?php echo $order["total_price"]?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Order History Tab -->
            </div>
        </div>
    </div>
</div>

<?php require_once "./components/scripts.php"; ?>