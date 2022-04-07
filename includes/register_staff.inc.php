<?php
session_start();

if(isset($_POST["create-staff"])){
    //Import DB connection 
    require_once "../connection/db.php";

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
            header("Location: ../register_staff.php?signup=char&mobilenumber=$mobileNumber&dob=$dob&email=$email&password=$password");
            exit();
        } else {
            // Validate input mobile number
            $mobileRegEx = "/^[0-9]{8,11}$/";  
            // str_replace("-","", $mobileNumber);
            if (!preg_match($mobileRegEx, $mobileNumber)) { // preg_match returns 0 if $mobileNumber does not match the pattern set by $mobileRegEx
                header("Location: ../register_staff.php?signup=mobilenumber&first=$firstName&last=$lastName&dob=$dob&email=$email&password=$password");
                exit();                
            } else{
                // Remove all illegal characters from email
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                // Validate input email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // filter_var returns false on failure, returns $email itself if success
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
                        header("Location: ../register_staff.php?signup=emailtaken&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&password=$password");
                        exit();  
                    } else{
                        // Validate input password
                        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,64}$/';
                        if (!preg_match($passwordRegEx, $password)) {
                            header("Location: ../register_staff.php?signup=password&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&email=$email");
                            exit();                             
                        } else{
                            // No validation errors so insert input into database
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $connection->prepare("INSERT INTO office_staff(first_name, last_name, email, staff_password, mobile_number, dob, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?);");
                            $stmt->bind_param("ssssisi", $firstName, $lastName, $email, $hashedPassword, $mobileNumber, $dob, $_SESSION["admin"]["adminID"]); 
                            $stmt->execute();
                            $stmt->close();
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