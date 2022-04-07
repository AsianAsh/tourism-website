<?php

session_start();

//Import DB connection
if (isset($_POST["admin-login"])) {
    require_once "../connection/db.php";

    $loginErrorArray = [];   
    $username = $_POST["username"];
    $password = $_POST['password'];

    if (empty($username)){
        array_push($loginErrorArray, "usernameEmpty");
    } 

    if ($password == ""){
        array_push($loginErrorArray, "passwordEmpty");
    } 

    if (!$loginErrorArray) {
        $stmt = $connection->prepare("SELECT * FROM admin WHERE username = ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($password == $row["admin_password"]){
            $verifyPassword = true;
        }
        else{
            $verifyPassword = false;
        }

        $validLogin = $verifyPassword;

        if ($validLogin == true) {
            $_SESSION["admin"] = array(
                "adminID" => $row["admin_id"],
                "username" => $row["username"],
            );
            $_SESSION["alertMessage"][] = "Signin Successful";
            header("Location: ../admin_dashboard.php");
            exit();
        } else {
            $_SESSION["alertMessage"][] = "Incorrect Login Details";
        }        
    } else {
        $_SESSION["loginErrorArray"] = $loginErrorArray;
        $_SESSION["alertMessage"][] = "Invalid Details";
    }

    header("Location: ../admin.php");
    exit();
}
