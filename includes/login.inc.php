<?php

session_start();

//Import DB connection & helpers
if (isset($_POST["signin"]) && isset($_GET["page"])) {
    require_once "../connection/db.php";

    $loginErrorArray = [];
    // Get the last page the user was on before signing in
    $lastPageQuery = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    
    if ($lastPageQuery["page"] == "register.php"){
        $lastPage = "index.php";
    }
    else{
        $lastPage = $lastPageQuery["page"];
    }

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email)){
        array_push($loginErrorArray, "emailEmpty");
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($loginErrorArray, "email");
    }

    if ($password == ""){
        array_push($loginErrorArray, "passwordEmpty");
    } 

    if (!$loginErrorArray) {
        $stmt = $connection->prepare("SELECT * FROM customer WHERE email = ?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $verifyPassword = password_verify($password, $row["customer_password"]);
        $validLogin = ($verifyPassword === false) ? false : true;
        if ($validLogin) {
            $_SESSION["user"] = array(
                "userID" => $row["customer_id"],
                "firstName" => $row["first_name"],
                "lastName" => $row["last_name"],
                "email" => $row["email"],
                "mobileNumber" => $row["mobile_number"],
                "dob" => $row["dob"],
                "profilePic" => $row["profile_pic"],
                "creationDate" => $row["creation_date"],
            );
        } 
    } else {
        $_SESSION["loginErrorArray"] = $loginErrorArray;
    }

    header("Location: ../$lastPage");
    exit();
}