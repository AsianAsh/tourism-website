<?php
session_start();

//Import DB connection 
if (isset($_POST["agent-login"])) {
    require_once "../connection/db.php";
  
    $email = $_POST["email"];
    $password = $_POST['password'];

    // Check for any empty input fields
    if (empty($email)) {
        header("Location: ../agent.php?login=emptyemail&password=$password");
        exit();
    } else{
        if(empty($password)){
            header("Location: ../agent.php?login=emptypassword&email=$email");
            exit();
        } else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../agent.php?login=email&password=$password");
                exit();
            } else {
                $stmt = $connection->prepare("SELECT * FROM travel_agent WHERE email = ?;");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $stmt->close();
        
                $verifyPassword = password_verify($password, $row["agent_password"]); // uncomment this when you change the password to hash version   
                $validLogin = ($verifyPassword === false) ? false : true;
                $validLogin = $verifyPassword;
                if (!$validLogin) {
                    header("Location: ../agent.php?login=password&email=$email");
                    exit();
                } else{
                    $_SESSION["agent"] = array(
                        "agentID" => $row["agent_id"],
                        "firstName" => $row["first_name"],
                        "lastName" => $row["last_name"],
                        "email" => $row["email"],
                        "mobileNumber" => $row["mobile_number"],
                        "dob" => $row["dob"],
                        "travelAgency" => $row["travel_agency"],
                        "creationDate" => $row["creation_date"],
                        "adminID" => $row["admin_id"]
                    );
                    $_SESSION["alertMessage"][] = "Signin Successful";
                    header("Location: ../agent_dashboard.php");
                    exit();
                }   
            }        
        }
    }
} else{
    header("Location: ../agent.php");
    exit();
}
