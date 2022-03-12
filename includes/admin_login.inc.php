<?php

session_start();

//Import DB connection & helpers
if (isset($_POST["admin-login"])) {
    require_once "../connection/db.php";

    $loginErrorArray = [];   
    $username = $_POST["username"];
    $password = $_POST['password'];

    if (empty($username)){
        array_push($loginErrorArray, "usernameEmpty");
    } 
    /*elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($loginErrorArray, "email");
    } */

    if ($password == ""){
        array_push($loginErrorArray, "passwordEmpty");
    } 

    // print_r($loginErrorArray);
    // die;

    if (!$loginErrorArray) {
        $stmt = $connection->prepare("SELECT * FROM admin WHERE username = ?;");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        // $verifyPassword = password_verify($password, $row["admin_password"]); // uncomment this when you change the password to hash version
        if ($password == $row["admin_password"]){
            $verifyPassword = true;
        }
        else{
            $verifyPassword = false;
        }

        // $validLogin = ($verifyPassword === false) ? false : true;
        $validLogin = $verifyPassword;

        // var_dump($validLogin);
        // die; // false so far no matter the password right or not
        // if ($validLogin) { //for hashed password
        if ($validLogin == true) {
            $_SESSION["user"] = array(
                "userID" => $row["admin_id"],
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
