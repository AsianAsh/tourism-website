<?php
session_start();
// Redirect to staff_dashboard.php page if already logged in to Staff Account
if (isset($_SESSION["staff"]["staffID"])) {
    header("Location: staff_dashboard.php");
    exit();
}
require_once "./components/header+offcanvas.php";
?>

<div style="max-width: 35%;" class="container my-5 px-5 py-5 bg-none border shadow">
    <h3 class="text-center">Office Staff Login</h3>
    <form class="row mt-3 g-4" id="register-form" action="./includes/staff_login.inc.php" method="POST" novalidate> <!-- novalidate stops Google's own browser validation of Form Submissions-->
    
        <div class="col-md-12">
            <?php
            if(isset($_GET["email"])){
                $email = $_GET["email"];
                echo '<input type="email" class="form-control form-control-lg border-dark" id="agentLoginEmail" placeholder="Email Address" name="email" value="'.$email.'">';
            } else{
                echo '<input type="email" class="form-control form-control-lg border-dark" id="agentLoginEmail" placeholder="Email Address" name="email">';
            }
            ?>
        </div>
        <div class="col-md-12">
            <?php
            if(isset($_GET["password"])){
                $password = $_GET["password"];
                echo '<input type="password" class="form-control form-control-lg border-dark loginPassword" id="agentLoginPassword" placeholder="Password" name="password" value="'.$password.'">';
            } else{
                echo '<input type="password" class="form-control form-control-lg border-dark loginPassword" id="agentLoginPassword" placeholder="Password" name="password">';
            }
            ?>
        </div>
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary" name="staff-login">Sign In</button>
        </div>
    </form>

    <?php
        if(!isset($_GET["login"])){
            exit();
        } else{
            $loginCheck = $_GET["login"];
            
            if($loginCheck == "emptyemail"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please fill in the email field!</p>";
                exit();
            } elseif($loginCheck == "emptypassword"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please fill in the password field!</p>";
                exit();
            } elseif($loginCheck == "email"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please enter a valid email!</p>";
                exit();
            } elseif($loginCheck == "password"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Incorrect Login Details!</p>";
                exit();
            } elseif($loginCheck == "success"){
                echo "<p class='mt-2 text-success text-center mb-0 ps-1 d-block'>Login Successful!</p>";
                exit();
            }
        }
    ?>
</div>

<?php require_once "./components/scripts.php"; ?>