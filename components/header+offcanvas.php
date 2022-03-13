<?php    
require_once "./connection/db.php";
if (!isset($loginErrorArray)){
    $loginErrorArray = [];
}

// Get the current page
$folder = $_SERVER["SCRIPT_NAME"];
$currentPage= basename($folder);
$userid = $_SESSION['user']['userID'] ?? null;
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

  <head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
      <!-- Manual Bootstrap Link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <!-- End of Manual Bootstrap Link -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7CPoppins:400%7CTeko:300,400">
    <!-- <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css"> -->
    <link rel="stylesheet" href="css/style.css">
    <style>.ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;position: relative;z-index: 1;} html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}</style>
  </head>
  
  <body>
    <?php if (!isset($_SESSION["user"]["userID"])) : ?>
    <!-- Offcanvas for users that are not logged in -->
    <div class="offcanvas offcanvas-end justify-content-center" tabindex="-1" id="accountCanvas"
        aria-labelledby="accountCanvasLabel">
        <div class="align-middle">
            <div class="offcanvas-header flex-column align-middle">
                <button type="button" class="btn-close text-reset align-self-end" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
                <h2 class="offcanvas-title mt-3" id="offcanvasExampleLabel">SIGN IN</h2>
            </div>
            <div class="offcanvas-body mb-3">
                <!-- For valid input but password does not match email -->
                <?php //if (isset($validLogin) && $validLogin === false) : ?>
                  <!-- <div class="p-3 mb-2 bg-danger text-white text-center rounded-pill">INCORRECT LOGIN DETAILS</div> -->
                <?php //endif; ?>
                <div>
                    <form class="row g-3 row-cols-1" action="<?php echo './includes/login.inc.php?page=' . $currentPage //. '&queryString=' . $queryString; ?>" method="POST" novalidate>                 
                        <div class="row g-3 justify-content-md-center">   
                            <div class="col-md-10">
                                <!-- <label for="inputEmail" class="form-label"></label> -->
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email Address"
                                    name="email" required>
                                <?php if (in_array("emailEmpty", $loginErrorArray)) : ?>
                                <small class="mt-1 ps-1 text-danger">Please fill out this field</small>
                                <?php elseif (in_array("email", $loginErrorArray)) : ?>
                                <small class="mt-1 ps-1 text-danger">Please enter a valid email</small>
                                <?php endif; ?>
                            </div>
                        
                            <div class="col-md-10">
                                <!-- <label for="inputPassword" class="form-label"></label> -->
                                <input type="password" class="form-control" id="loginPassword" placeholder="Password"
                                    name="password" required>
                                <?php if (in_array("passwordEmpty", $loginErrorArray)) : ?>
                                <small class="mt-1 ps-1 text-danger">Please fill out this field</small>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 ps-3">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input view-Login-Password" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Show Password</label>
                                </div>
                            </div>
                        </div>

                        <small class="ps-4">By signing in, I agree to the "Website Name" Terms & Conditions and Privacy Statement.</small>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary offcanvas-sign-in mt-1" name="signin">Sign in</button>
                        </div>
                    </form>
                    <!-- Button to Registration Page -->
                    <div class="account-links d-flex justify-content-center mt-3">
                        <p>Don't have an account? <a href="./register.php" class="text-decoration-none">Create one</a></p>
                    </div>
                    <!-- End of Button to Registration Page -->
                </div>
            </div>
        </div>

        <?php else : ?>
        <!-- Offcanvas for users that are logged in-->
        <div class="offcanvas offcanvas-end text-center" tabindex="-1" id="accountCanvas"
            aria-labelledby="accountCanvasLabel">
            <div class="offcanvas-header flex-column">
                <button type="button" class="btn-close text-reset align-self-end" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
                <!-- <div class="text-center mb-3">
                    <img src="<?php //echo  $_SESSION["user"]["userPicture"] ?>" alt=""
                        class="img-fluid shadow rounded-circle userProfilePicture">
                </div> -->
                <h2 class="offcanvas-title mt-3" id="offcanvasExampleLabel">
                    <?php if (isset($_SESSION['user']['firstName'])){echo $_SESSION['user']['firstName'] . " " . $_SESSION['user']['lastName'];} ?> </h2>
            </div>
            <div class="offcanvas-body mb-5">
                <?php //if ($_SESSION["user"]["userRole"] === "STAFF"): ?> <!-- href="admin.php" -->
                <!-- <div class="col-12 text-center">
                    <a class="btn  offcanvas-view-account rounded-pill px-5 mb-4" href="">Admin Panel</a> 
                </div> -->
                <?php //endif; ?>
                <div class="col-12 text-center">
                    <a class="btn offcanvas-view-account rounded-pill px-5 mb-4" href="./profile.php">View Account</a> <!-- href="profile.php" -->
                </div>
                <form action="<?php echo './includes/login.inc.php?page=' . $currentPage //. '&queryString=' . $queryString; ?>"
                    class="row g-3 row-cols-1" method="POST">
                    <div class="col-12 text-center">
                      <button type="submit" class="btn offcanvas-sign-in rounded-pill px-5" name="logout">Sign Out</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <!-- End of Offcanvas for users that are not logged in -->
    

    <!-- Screen Loading Animation -->
    <!-- <div class="ie-panel"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <div class="preloader">
      <div class="preloader-body">
        <div class="cssload-container">
          <div class="cssload-speeding-wheel"></div>
        </div>
        <p>Loading...</p>
      </div>
    </div>
    <div class="page"> -->