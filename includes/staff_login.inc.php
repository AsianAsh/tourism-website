<?php
session_start();

//Import DB connection 
if (isset($_POST["staff-login"])) {
    require_once "../connection/db.php";

    $email = $_POST["email"];
    $password = $_POST['password'];

    // Check for any empty input fields
    if (empty($email)) {
        header("Location: ../staff.php?login=emptyemail&password=$password");
        exit();
    } else{
        if(empty($password)){
            header("Location: ../staff.php?login=emptypassword&email=$email");
            exit();
        } else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../staff.php?login=email&password=$password");
                exit();
            } else {
                $stmt = $connection->prepare("SELECT * FROM office_staff WHERE email = ?;");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
        
                $verifyPassword = password_verify($password, $row["staff_password"]); 
                $validLogin = ($verifyPassword === false) ? false : true;
                $validLogin = $verifyPassword;

                if (!$validLogin) {
                    header("Location: ../staff.php?login=password&email=$email");
                    exit();
                } else{
                    $_SESSION["staff"] = array(
                        "staffID" => $row["staff_id"],
                        "firstName" => $row["first_name"],
                        "lastName" => $row["last_name"],
                        "email" => $row["email"],
                        "mobileNumber" => $row["mobile_number"],
                        "dob" => $row["dob"],
                        "creationDate" => $row["creation_date"],
                        "adminID" => $row["admin_id"]
                    );
                    $_SESSION["alertMessage"][] = "Signin Successful";
                    header("Location: ../staff_dashboard.php");
                    exit();
                }   
            }        
        }
    }
} else{
    header("Location: ../staff.php");
    exit();
}
