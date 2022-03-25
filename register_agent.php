<?php
session_start();
require_once "./components/header+offcanvas.php";

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}
?>
<!-- styling for back button -->
<style>
    .back{
        text-align: center;
        padding-top:10px;
    }
    .back:hover{
        text-decoration:underline;
    }
</style>
<div style="max-width: 35%;" class="container my-5 px-5 py-5 bg-none border shadow">

    <h3 class="text-center">Create Travel Agent Account</h3>
    <form class="row mt-3 g-4" id="register-form" action="./includes/register_agent.inc.php" method="POST" novalidate> <!-- novalidate stops Google's own browser validation of Form Submissions-->
        <div class="col-md-12">
            <?php
                if(isset($_GET["first"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $first = $_GET["first"];
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputFirstName" name="firstName" placeholder="First name" value="'.$first.'">';
                } else{
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputFirstName" name="firstName" placeholder="First name">';
                }
            ?> 
        </div>
        
        <div class="col-md-12">
            <?php
                if(isset($_GET["last"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $last = $_GET["last"];
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputLastName" placeholder="Last name" 
                    name="lastName" value="'.$last.'">';
                } else{
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputLastName" placeholder="Last name" 
                    name="lastName"';
                }
            ?> 
        </div> 

        <div class="col-md-12 mt-4">
            <?php
                if(isset($_GET["mobilenumber"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $number = $_GET["mobilenumber"];
                    echo '<div class="input-group">
                            <div class="input-group-text border-dark">+60</div>
                            <input type="tel" class="form-control form-control-lg border-dark" id="inputTelephone" placeholder="123456789" 
                            name="mobileNumber" value="'.$number.'">
                        </div>';
                } else{
                    echo '<div class="input-group">
                            <div class="input-group-text border-dark">+60</div>
                            <input type="tel" class="form-control form-control-lg border-dark" id="inputTelephone" placeholder="123456789" 
                            name="mobileNumber">
                        </div>';
                }
            ?> 
        </div> 
            
        <!-- Date of Birth (DOB) Input Field -->
        <div class="col-md-12 mt-4">
            <?php
                if(isset($_GET["dob"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $birthdate = $_GET["dob"];
                    echo '<input type="date" class="form-control form-control-lg border-dark registerDOB" id="registerDOB" name="DOB" min="1930-01-01" max="" value="'.$birthdate.'">';
                } else{
                    echo '<input type="date" class="form-control form-control-lg border-dark registerDOB" id="registerDOB" name="DOB" min="1930-01-01" max="">';
                }
            ?> 
        </div> 

        <div class="col-md-12 mt-4">
            <?php
                if(isset($_GET["email"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $email = $_GET["email"];
                    echo '<input type="email" class="form-control form-control-lg border-dark" id="registerEmail" placeholder="Email address" 
                    name="email" value="'.$email.'">';
                } else{
                    echo '<input type="email" class="form-control form-control-lg border-dark" id="registerEmail" placeholder="Email address" 
                    name="email"';
                }
            ?> 
        </div> 

        <div class="col-md-12 mt-4">
            <?php
                if(isset($_GET["agency"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $agency = $_GET["agency"];
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputAgency" placeholder="Travel Agency" 
                    name="agency" value="'.$agency.'">';
                } else{
                    echo '<input type="text" class="form-control form-control-lg border-dark" id="inputAgency" placeholder="Travel Agency" 
                    name="agency"';
                }
            ?> 
            <p class="mt-0">*Not required</p>
        </div> 

        <div class="col-md-12 mt-3">
            <?php
                if(isset($_GET["password"])){
                    // <label for="inputFirstName" class="form-label">First Name</label>
                    $password = $_GET["password"];
                    echo '<input type="password" class="form-control form-control-lg border-dark registerPassword" id="registerPassword" placeholder="Password" name="password" autocomplete="on" value="'.$password.'">';
                } else{
                    echo '<input type="password" class="form-control form-control-lg border-dark registerPassword" id="registerPassword" placeholder="Password" name="password" autocomplete="on">';
                }
            ?> 
            <div class="mt-1"> <!--border border-danger ps-1 rounded mt-1 -->
                <small class="fs-8 fst-italic fw-lighter">
                Length must be between 8-64 characters, combines uppercase, lowercase letters and numbers, 
                and contains at least one symbol (~ ! @ # $ % ^ & * - _ ?)
                </small>
            </div>
            <div class="form-check form-switch mt-2">
                <input class="form-check-input view-Password" type="checkbox" id="agentShowPassword">
                <label class="form-check-label" for="agentShowPassword">Show Password</label>
            </div>
        </div> 

        <div class="col-12 text-center mt-2">
            <button type="submit" class="btn btn-primary" name="create-agent">Create Account</button>
        </div>
        <div class="back">
            <a href="admin.php">Go back</a>
        </div>
    </form>
    
    <?php
        if(!isset($_GET["signup"])){
            exit();
        } else{
            $signupCheck = $_GET["signup"];
            
            if($signupCheck == "empty"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please fill in all required fields!</p>";
                exit();
            } elseif($signupCheck == "char"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please enter a valid name!</p>";
                exit();
            } elseif($signupCheck == "mobilenumber"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please enter a valid mobile number!</p>";
                exit();
            } elseif($signupCheck == "email"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please enter a valid email!</p>";
                exit();
            } elseif($signupCheck == "emailtaken"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Email has been taken!</p>";
                exit();
            } elseif($signupCheck == "agency"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please keep your travel agency under 160 characters!</p>";
                exit();
            } elseif($signupCheck == "password"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please enter a valid password!</p>";
                exit();
            } elseif($signupCheck == "success"){
                echo "<p class='mt-2 text-success text-center mb-0 ps-1 d-block'>Agent Registration Successful!</p>";
                exit();
            }
        }
    ?>
</div>

<?php require_once "./components/scripts.php"; ?>