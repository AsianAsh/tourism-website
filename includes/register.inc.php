<?php
session_start();

//Import DB connection & helpers
require_once "../connection/db.php";
// require_once "../helper/helpers.php";

if(!isset($_POST["signup"])){
    header("Location: ../index.php");
    exit();
} else {
    $errorArray = [];

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $dob = $_POST['DOB'];
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
$mobileRegEx = "/^[0-9]{8,11}$/";  
str_replace("-","", $mobileNumber);
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
$stmt = $connection->prepare("SELECT email FROM customer WHERE email = ?;");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$checkEmailTaken = $result->fetch_assoc();
if ($checkEmailTaken && $email !== false) {
    array_push($errorArray, "emailTaken");
}
$stmt->close();


//Validate input DOB
if (empty($dob)){
    array_push($errorArray, "dobEmpty");
} 


// Validate input password
$passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,64}$/';
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
    header("Location:  ../register.php");
    exit();
} else {
    // The default image when user sign up for an account
    $imagePath =  "./images/svg/profile-pic-default.svg"; 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $connection->prepare("INSERT INTO customer(first_name, last_name, email, customer_password, mobile_number, dob, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("ssssiss", $firstName, $lastName, $email, $hashedPassword, $mobileNumber, $dob, $imagePath); 
    $stmt->execute();
    $stmt->close();
    $_SESSION["alertMessage"][] = "Account Successfully Created";
    header("Location: ../index.php");
    exit();
}

// $newUser = array(
//     "firstName" => $firstName,
//     "lastName" => $lastName,
//     "mobileNumber" => $mobileNumber,
//     "email" => $email,
//     "password" => $password
// );

// foreach ($newUser as $key => $value) {
//     if ($value === false) {
//         array_push($errorArray, $key);
//     }
// }

// if ($errorArray) {
//     $_SESSION["accountCreationError"] = $errorArray;
//     header("Location:  ../register.php");
//     exit();
// } else {
//     createUser($newUser, $connection);
//     $_SESSION["alertMessage"][] = "Account Successfully Created";
//     header("Location:  ../index.php");
//     exit();
// }