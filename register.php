<?php
session_start();
$errorArray = [];
$firstName = "";
$lastName = "";
$mobileNumber = "";
$dob = "";
$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $dob = $_POST['DOB'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if (isset($_SESSION["accountCreationError"])) {
    $errorArray =  $_SESSION["accountCreationError"];
    unset($_SESSION["accountCreationError"]);
}
?>

<?php require_once "./components/header+offcanvas.php"; ?>
<?php require_once "./components/navbar.php"; ?>

    <div style="max-width: 35%;" class="container my-5 px-5 py-5 bg-none border shadow">
        <h3 class="text-center">Create an account</h3>
        <form class="row mt-3 g-4" id="register-form" action="./includes/register.inc.php" method="POST" novalidate> <!-- novalidate stops Google's own browser validation of Form Submissions-->
            <!-- First Name Input Field -->
            <div class="col-md-12">
                <input type="text" class="form-control form-control-lg border-dark" id="inputFirstName" placeholder="First name" 
                name="firstName" value="">
                <?php if (in_array("firstNameEmpty", $errorArray)) : ?>
                        <p class="mt-1 text-danger mb-0  ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("firstName", $errorArray)) :  ?>
                        <p class="mt-1 text-danger mb-0  ps-1 d-block">Please enter a valid name</p>
                <?php endif; ?>
            </div>
            
            <!-- Last Name Input Field -->
            <div class="col-md-12">
                <input type="text" class="form-control form-control-lg border-dark" id="inputLastName" placeholder="Last name" 
                name="lastName" value="">
                <?php if (in_array("lastNameEmpty", $errorArray)) : ?>
                        <p class="mt-1 text-danger mb-0 ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("lastName", $errorArray)) :  ?>
                        <p class="mt-1 text-danger mb-0 ps-1 d-block">Please enter a valid name</p>
                <?php endif; ?>                
            </div>
            
            <!-- Mobile Number Input Field -->
            <div class="col-md-12">
                <div class="input-group">
                    <div class="input-group-text border-dark">+60</div>
                    <input type="tel" class="form-control form-control-lg border-dark" id="inputTelephone" placeholder="123456789" 
                    name="mobileNumber" value="<?php echo $mobileNumber ?>">
                </div>
            </div>
            <?php if (in_array("mobileNumberEmpty", $errorArray)) : ?>
                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please fill out this field</p>
            <?php elseif (in_array("mobileNumber", $errorArray)) :  ?>
                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please enter a valid mobile number</p>
            <?php endif; ?>
            
            <!-- Date of Birth (DOB) Input Field -->
            <div class="col-md-12">
                <input type="date" class="form-control form-control-lg border-dark registerDOB" id="registerDOB" name="DOB" value="" min="1930-01-01" max="">
            </div>
            <?php if (in_array("dobEmpty", $errorArray)) : ?>
                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please fill out this field</p>
            <?php endif; ?>
            
            <!-- Email Input Field -->
            <div class="col-md-12">
                <input type="email" class="form-control form-control-lg border-dark" id="registerEmail" placeholder="Email address" 
                name="email" value="">
                <?php if (in_array("emailEmpty", $errorArray)) : ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("email", $errorArray)) :  ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Please enter a valid email</p>
                <?php elseif (in_array("emailTaken", $errorArray)) :  ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Email has been taken</p>
                <?php endif; ?> 
            </div>
            
            <!-- Password Input Field -->
            <div class="col-md-12">
                <input type="password" class="form-control form-control-lg border-dark registerPassword" id="registerPassword" placeholder="Password" name="password" required>
                <div class="mt-1 <?php if (in_array("password", $errorArray))  echo "border border-danger ps-1 rounded mt-1"; ?>">
                <?php if (in_array("passwordEmpty", $errorArray)) : ?>
                    <p class="mt-1 text-danger mb-0 d-block">Please fill out this field</p>
                <?php endif ?>
                    <small class="fs-8 fst-italic fw-lighter <?php if (in_array("password", $errorArray))  echo "text-danger"; ?>">
                    Length must be between 8-64 characters, combines uppercase, lowercase letters and numbers, 
                    and contains at least one symbol (~ ! @ # $ % ^ & * - _ ?)
                    </small>
                </div>
            </div>
            
            <!-- Show Password Switch/Button -->
            <div class="col-md-12">
                <div class="form-check form-switch">
                    <input class="form-check-input view-Password" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Show Password</label>
                </div>
            </div>

            <p>By creating an account, I agree to the "Website Name" Terms & Conditions and Privacy Statement.</p>
            
            <!-- Submit Form Button -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
            </div>
            
            <!-- Link to Login Form -->
            <p class="text-center">Already have an account? <a class="rd-nav-link" data-bs-toggle="offcanvas" href="#accountCanvas" role="button" aria-controls="accountCanvas">Sign In</a></p>
        </form>
    </div>

<?php require_once "./components/scripts.php"; ?>