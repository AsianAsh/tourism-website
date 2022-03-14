<?php
session_start();

if(isset($_POST["create-agent"])){
    //Import DB connection & helpers
    require_once "../connection/db.php";
    // require_once "../helper/helpers.php";

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $mobileNumber = $_POST['mobileNumber'];
    $dob = $_POST['DOB'];
    $email = $_POST['email'];
    $agency = $_POST['agency'];
    $password = $_POST['password'];

    // Check for any empty input fields
    if (empty($firstName) || empty($lastName) || empty($mobileNumber) || empty($email) || empty($password)) {
        header("Location: ../register_agent.php?signup=empty");
        exit();
    } else{
        // Validate First & Last Name
        $nameRegEx = "/^([a-zA-Z' ]+)$/";
        if (!preg_match($nameRegEx, $firstName) || !preg_match($nameRegEx, $lastName)){
            header("Location: ../register_agent.php?signup=char&mobilenumber=$mobileNumber&dob=$dob&email=$email&agency=$agency&password=$password");
            exit();
        } else {
            // Validate input mobile number
            $mobileRegEx = "/^[0-9]{8,11}$/";  
            // str_replace("-","", $mobileNumber);
            if (!preg_match($mobileRegEx, $mobileNumber)) { // preg_match returns 0 if $mobileNumber does not match the pattern set by $mobileRegEx
                header("Location: ../register_agent.php?signup=mobilenumber&first=$firstName&last=$lastName&dob=$dob&email=$email&agency=$agency&password=$password");
                exit();                
            } else{
                // Remove all illegal characters from email
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                // Validate input email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // filter_var returns false on failure, returns $email itself if success
                    header("Location: ../register_agent.php?signup=email&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&agency=$agency&password=$password");
                    exit();                    
                } else {
                    // Check to see if input email already exists/taken in the database
                    $stmt = $connection->prepare("SELECT email FROM travel_agent WHERE email = ?;");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $checkEmailTaken = $result->fetch_assoc();
                    $stmt->close();
                    if ($checkEmailTaken && $email !== false) {
                        header("Location: ../register_agent.php?signup=emailtaken&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&agency=$agency&password=$password");
                        exit();  
                    } else{
                        // Validate input password
                        $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,64}$/';
                        if (!preg_match($passwordRegEx, $password)) {
                            header("Location: ../register_agent.php?signup=password&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&email=$email&agency=$agency");
                            exit();                             
                        } else{
                            // Validate Travel Agency
                            if ((strlen($agency) > 160)){
                                header("Location: ../register_agent.php?signup=agency&first=$firstName&last=$lastName&mobilenumber=$mobileNumber&dob=$dob&email=$email&password=$password");
                                exit();
                            } else {                                
                                // No validation errors so insert input into database
                                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                                $stmt = $connection->prepare("INSERT INTO travel_agent(first_name, last_name, email, agent_password, mobile_number, dob, travel_agency, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
                                $stmt->bind_param("ssssissi", $firstName, $lastName, $email, $hashedPassword, $mobileNumber, $dob, $agency, $_SESSION["user"]["userID"]); 
                                $stmt->execute();
                                $stmt->close();
                                $_SESSION["alertMessage"][] = "Account Successfully Created";
                                header("Location: ../admin_dashboard.php?signup=success");
                                exit();
                            }
                        }
                    }                    
                }
            }
        }         
    }
} else{
    header("Location: ../register_agent.php");
    exit();   
}

// $firstName = sanitizeText($_POST["firstName"]);
// $lastName = sanitizeText($_POST["lastName"]);
// $mobileNumber = validateMobileNumber($_POST["mobileNumber"]);
// $password = validatePassword($_POST["password"]);
// $email = validateEmail($_POST["email"]);
