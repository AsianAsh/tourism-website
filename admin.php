<?php
session_start();
// Redirect to admin_dashboard.php page if already logged in to Admin Account
if (isset($_SESSION["admin"]["adminID"])) {
    header("Location: admin_dashboard.php");
    exit();
}
require_once "./components/header+offcanvas.php";
?>

<div style="max-width: 35%;" class="container my-5 px-5 py-5 bg-none border shadow">
    <h3 class="text-center">Admin Login</h3>
    <form class="row mt-3 g-4" id="register-form" action="./includes/admin_login.inc.php" method="POST" novalidate> <!-- novalidate stops Google's own browser validation of Form Submissions-->
    
        <div class="col-md-12">
            <!-- <label for="inputFirstName" class="form-label">First Name</label> -->
            <input type="text" class="form-control form-control-lg border-dark" id="inputUsername" placeholder="Username" 
            name="username" value="">
            <?php if (in_array("usernameEmpty", $loginErrorArray)) : ?>
                    <p class="mt-1 text-danger mb-0  ps-1 d-block">Please fill out this field</p>
            <?php //elseif (in_array("firstName", $loginErrorArray)) :  ?>
                    <!-- <p class="mt-1 text-danger mb-0  ps-1 d-block">Please enter a valid username</p> -->
            <?php endif; ?>
        </div>

        <div class="col-md-12">
            <!-- <label for="registerPassword" class="form-label">Password</label> -->
            <input type="password" class="form-control form-control-lg border-dark loginPassword" id="adminLoginPassword" placeholder="Password" name="password">
            <div class="mt-1 <?php if (in_array("password", $loginErrorArray))  echo "border border-danger ps-1 rounded mt-1"; ?>">
            <?php if (in_array("passwordEmpty", $loginErrorArray)) : ?>
                <p class="mt-1 text-danger mb-0 d-block">Please fill out this field</p>
            <?php endif ?>
            </div>
            
            <div class="form-check form-switch mt-2">
                <input class="form-check-input view-Login-Password" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">Show Password</label>
            </div>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" name="admin-login">Sign In</button>
        </div>
    </form>
</div>

<?php require_once "./components/scripts.php"; ?>