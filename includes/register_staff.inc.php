<?php
session_start();

if(isset($_POST["create-staff"])){
    //Import DB connection & helpers
    require_once "../connection/db.php";
    // require_once "../helper/helpers.php";

    // $staffErrorArray = [];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $dob = $_POST['DOB'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for any empty input fields
    if (empty($firstName) || empty($lastName) || empty($mobileNumber) || empty($email) || empty($password)) {
        header("Location: ../register_staff.php?signup=empty");
        exit();
    } else{
        // Validate First & Last Name
        $nameRegEx = "/^([a-zA-Z' ]+)$/";
        if (!preg_match($nameRegEx, $firstName) || !preg_match($nameRegEx, $lastName)){
            // array_push($staffErrorArray, "firstName");
            header("Location: ../register_staff.php?signup=char&mobilenumber=$mobileNumber&dob=$dob&email=$email&password=$password");
            exit();
        } else {
            // Validate input mobile number
            $mobileRegEx = "/^[0-9]{8,11}$/";  
            // str_replace("-","", $mobileNumber);
            if (!preg_match($mobileRegEx, $mobileNumber)) { // preg_match returns 0 if $mobileNumber does not match the pattern set by $mobileRegEx
                header("Location: ../register_staff.php?signup=mobilenumber&first=$firstName&last=$lastName&dob=$dob&email=$email&password=$password");
                exit();                
                // array_push($staffErrorArray, "mobileNumber");
            } else{
                // Remove all illegal characters from email
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                // Validate input email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // filter_var returns false on failure, returns $email itself if success
                    // array_push($staffErrorArray, "email");
                    header("Location: ../register_staff.php?signup=email&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&password=$password");
                    exit();                    
                } else {
                    // Check to see if input email already exists/taken in the database
                    $stmt = $connection->prepare("SELECT email FROM office_staff WHERE email = ?;");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $checkEmailTaken = $result->fetch_assoc();
                    $stmt->close();
                    if ($checkEmailTaken && $email !== false) {
                        // array_push($staffErrorArray, "emailTaken");
                        header("Location: ../register_staff.php?signup=emailtaken&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&password=$password");
                        exit();  
                    } else{
                        // Validate input password
                        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,64}$/';
                        if (!preg_match($passwordRegEx, $password)) {
                            // array_push($staffErrorArray, "password");
                            header("Location: ../register_staff.php?signup=password&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&email=$email");
                            exit();                             
                        } else{
                            // No validation errors so insert input into database
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            // var_dump($firstName);
                            // var_dump($lastName);
                            // var_dump($email);
                            // var_dump($hashedPassword);
                            // var_dump($mobileNumber);
                            // var_dump($dob);

                            $stmt = $connection->prepare("INSERT INTO office_staff(first_name, last_name, email, staff_password, mobile_number, dob, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?);");
                            $stmt->bind_param("ssssisi", $firstName, $lastName, $email, $hashedPassword, $mobileNumber, $dob, $_SESSION["admin"]["adminID"]); 
                            $stmt->execute();
                            $stmt->close();
                            // $_SESSION["alertMessage"][] = "Account Successfully Created";
                            header("Location: ../admin_dashboard.php?signup=success");
                            exit();
                        }
                    }                    
                }
            }
        }         
    }
} else{
    header("Location: ../register_staff.php");
    exit();   
}

// $firstName = sanitizeText($_POST["firstName"]);
// $lastName = sanitizeText($_POST["lastName"]);
// $mobileNumber = validateMobileNumber($_POST["mobileNumber"]);
// $password = validatePassword($_POST["password"]);
// $email = validateEmail($_POST["email"]);


/*
// Validate First & Last Name
$nameRegEx = "/^([a-zA-Z' ]+)$/";
if (empty($firstName)) {
    array_push($staffErrorArray, "firstNameEmpty");
} 
elseif (!preg_match($nameRegEx, $firstName)) {
    array_push($staffErrorArray, "firstName");
} 
if ($lastName == "") {
    array_push($staffErrorArray, "lastNameEmpty");
} 
elseif (!preg_match($nameRegEx, $lastName)) {
    array_push($staffErrorArray, "lastName");
} 


// Validate input mobile number
$mobileRegEx = "/^[0-9]{8,11}$/";  
str_replace("-","", $mobileNumber);
if ($mobileNumber == ""){
    array_push($staffErrorArray, "mobileNumberEmpty");
} 
elseif (!preg_match($mobileRegEx, $mobileNumber)) { // preg_match returns 0 if $mobileNumber does not match the pattern set by $mobileRegEx
    array_push($staffErrorArray, "mobileNumber");
}


// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate input email
if (empty($email)){
    array_push($staffErrorArray, "emailEmpty");
} 
elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) { // filter_var returns false on failure, returns $email itself if success
    array_push($staffErrorArray, "email");
}


// Check to see if input email already exists/taken in the database
$stmt = $connection->prepare("SELECT email FROM office_staff WHERE email = ?;");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$checkEmailTaken = $result->fetch_assoc();
if ($checkEmailTaken && $email !== false) {
    array_push($staffErrorArray, "emailTaken");
}
$stmt->close();


//Validate input DOB
if (empty($dob)){
    array_push($staffErrorArray, "dobEmpty");
} 


// Validate input password
$passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,12}$/';
if ($password == ""){
    array_push($staffErrorArray, "passwordEmpty");
} 
elseif (!preg_match($passwordRegEx, $password)) {
    array_push($staffErrorArray, "password");
};



// echo '<pre>';
// var_dump($errorArray); // or print_r($var);
// die;



if (!empty($staffErrorArray)) {
    $_SESSION["accountCreationError"] = $staffErrorArray;
    header("Location:  ../register_staff.php");
    exit();
} else {    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO office_staff(first_name, last_name, email, staff_password, mobile_number, dob, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("ssssisi", $firstName, $lastName, $email, $hashedPassword, $mobileNumber, $dob, $_SESSION["user"]["userID"]); 
    $stmt->execute();
    $stmt->close();
    $_SESSION["alertMessage"][] = "Account Successfully Created";
    header("Location: ../admin_dashboard.php");
    exit();
} */