<?php
session_start();
require_once "./components/header+offcanvas.php";
?>

<div style="max-width: 35%;" class="container my-5 px-5 py-5 bg-none border shadow">
        <h3 class="text-center">Create Staff Account</h3>
        <form class="row mt-3 g-4" id="register-form" action="./includes/register_staff.inc.php" method="POST" novalidate> <!-- novalidate stops Google's own browser validation of Form Submissions-->
        
            <div class="col-md-12">
                <!-- <label for="inputFirstName" class="form-label">First Name</label> -->
                <input type="text" class="form-control form-control-lg border-dark" id="inputFirstName" placeholder="First name" 
                name="firstName" value="">
                <?php /*if (in_array("firstNameEmpty", $errorArray)) : ?>
                        <p class="mt-1 text-danger mb-0  ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("firstName", $errorArray)) :  ?>
                        <p class="mt-1 text-danger mb-0  ps-1 d-block">Please enter a valid name</p>
                <?php endif; */?>
            </div>

            <div class="col-md-12">
                <!-- <label for="inputLastName" class="form-label">Last Name</label> -->
                <input type="text" class="form-control form-control-lg border-dark" id="inputLastName" placeholder="Last name" 
                name="lastName" value="">
                <?php /*if (in_array("lastNameEmpty", $errorArray)) : ?>
                        <p class="mt-1 text-danger mb-0 ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("lastName", $errorArray)) :  ?>
                        <p class="mt-1 text-danger mb-0 ps-1 d-block">Please enter a valid name</p>
                <?php endif; */?>                
            </div>

            <div class="col-md-12">
                <!-- <label for="inputTelephone" class="form-label">Mobile Number</label> -->
                <div class="input-group">
                    <div class="input-group-text border-dark">+60</div>
                    <input type="tel" class="form-control form-control-lg border-dark" id="inputTelephone" placeholder="123456789" 
                    name="mobileNumber" value="">

                </div>
            </div>
            <?php /*if (in_array("mobileNumberEmpty", $errorArray)) : ?>
                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please fill out this field</p>
            <?php elseif (in_array("mobileNumber", $errorArray)) :  ?>
                <p class="mt-1 text-danger mb-0 ps-3 d-block">Please enter a valid mobile number</p>
            <?php endif; */?>


            <div class="col-md-12">
                <!-- <label for="registerEmail" class="form-label">Email*</label> -->
                <input type="email" class="form-control form-control-lg border-dark" id="registerEmail" placeholder="Email address" 
                name="email" value="">
                <?php /*if (in_array("emailEmpty", $errorArray)) : ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Please fill out this field</p>
                <?php elseif (in_array("email", $errorArray)) :  ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Please enter a valid email</p>
                <?php elseif (in_array("emailTaken", $errorArray)) :  ?>
                    <p class="mt-1 text-danger mb-0 ps-1 d-block">Email has been taken</p>
                <?php endif; */?> 
            </div>

            <div class="col-md-12">
                <!-- <label for="registerPassword" class="form-label">Password</label> -->
                <input type="password" class="form-control form-control-lg border-dark" id="registerPassword" placeholder="Password" name="password" required>
                <div class="mt-1 <?php //if (in_array("password", $errorArray))  echo "border border-danger ps-1 rounded mt-1"; ?>">
                <?php /*if (in_array("passwordEmpty", $errorArray)) : ?>
                    <p class="mt-1 text-danger mb-0 d-block">Please fill out this field</p>
                <?php endif */?>
                    <small class="fs-8 fst-italic fw-lighter <?php //if (in_array("password", $errorArray))  echo "text-danger"; ?>">
                    Length must be between 8-64 characters, combines uppercase, lowercase letters and numbers, 
                    and contains at least one symbol (~ ! @ # $ % ^ & * - _ ?)
                    </small>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-check form-switch">
                    <input class="form-check-input view-Password" type="checkbox" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault">Show Password</label>
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary" name="signup">Create Account</button>
            </div>
        </form>
    </div>

    <!-- Javascript-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/show_password.js"></script>
    <script src="js/current_date.js"></script>
  </body>
</html>