<?php
session_start();

//Import DB connection & helpers
require_once "../connection/db.php";
// require_once "../helper/helpers.php";

if(!isset($_POST["signup"])){
    header("Location: ../admin.php");
    exit();
} else {
    $errorArray = [];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}

 

// $firstName = sanitizeText($_POST["firstName"]);
// $lastName = sanitizeText($_POST["lastName"]);
// $mobileNumber = validateMobileNumber($_POST["mobileNumber"]);
// $password = validatePassword($_POST["password"]);
// $email = validateEmail($_POST["email"]);



// Check for any empty input fields
// if (empty($firstName) || empty($lastName) || empty($mobileNumber) || empty($email) || empty($password)) {
//     $_SESSION["messages"][] = "Please fill all required fields!";
//     // exit;
// } 


// Validate First & Last Name
$nameRegEx = "/^([a-zA-Z' ]+)$/";
if (empty($firstName)) {
    array_push($errorArray, "firstNameEmpty");
} 
elseif (!preg_match($nameRegEx, $firstName)) {
    array_push($errorArray, "firstName");
} 
if ($lastName == "") {
    array_push($errorArray, "lastNameEmpty");
} 
elseif (!preg_match($nameRegEx, $lastName)) {
    array_push($errorArray, "lastName");
} 


// Validate input mobile number
$mobileRegEx = "/^[1-9][0-9]{7,10}$/" ;  
if ($mobileNumber == ""){
    array_push($errorArray, "mobileNumberEmpty");
} 
elseif (!preg_match($mobileRegEx, $mobileNumber)) { // preg_match returns 0 if $mobileNumber does not match the pattern set by $mobileRegEx
    array_push($errorArray, "mobileNumber");
}


// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate input email
if (empty($email)){
    array_push($errorArray, "emailEmpty");
} 
elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) { // filter_var returns false on failure, returns $email itself if success
    array_push($errorArray, "email");
}


// Check to see if input email already exists/taken in the database
$stmt = $connection->prepare("SELECT email FROM user WHERE email = ?;");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$checkEmailTaken = $result->fetch_assoc();
if ($checkEmailTaken && $email !== false) {
    array_push($errorArray, "emailTaken");
}
$stmt->close();


// Validate input password
$passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,12}$/';
if ($password == ""){
    array_push($errorArray, "passwordEmpty");
} 
elseif (!preg_match($passwordRegEx, $password)) {
    array_push($errorArray, "password");
};



// echo '<pre>';
// var_dump($errorArray); // or print_r($var);
// die;



if (!empty($errorArray)) {
    $_SESSION["accountCreationError"] = $errorArray;
    header("Location:  ../register_staff.php");
    exit();
} else {    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO office_staff(first_name, last_name, email, staff_password, mobile_number) VALUES (?, ?, ?, ?, ?);");
    $stmt->bind_param("ssssi", $firstName, $lastName, $email, $hashedPassword, $mobileNumber); 
    $stmt->execute();
    $stmt->close();
    $_SESSION["alertMessage"][] = "Account Successfully Created";
    header("Location: ../admin.php");
    exit();
}