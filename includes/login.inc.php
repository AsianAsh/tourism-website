<?php

session_start();

//Import DB connection & helpers
if (isset($_POST["signin"]) && isset($_GET["page"])) {
    require_once "../connection/db.php";

    $loginErrorArray = [];
    // Get the last page the user was on before signing in
    $lastPageQuery = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    $lastPage = $lastPageQuery["page"];

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

    // print_r($loginErrorArray);
    // die;

    if (!$loginErrorArray) {
        $stmt = $connection->prepare("SELECT * FROM user WHERE email = ?;");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $verifyPassword = password_verify($password, $row["user_password"]);
        $validLogin = ($verifyPassword === false) ? false : true;
        if ($validLogin) {
            // var_dump($validLogin );
            // die;
            $_SESSION["user"] = array(
                "userID" => $row["user_id"],
                "firstName" => $row["first_name"],
                "lastName" => $row["last_name"],
                "email" => $row["email"],
                "mobileNumber" => $row["mobile_number"]
                // "addressLine" => $row["addressLine"],
                // "city" => $row["city"],
                // "state" => $row["userState"],
                // "userPicture" => $row["imagePath"],
                // "postcode" => $row["postcode"],
                // "userRole" => $row["userRole"]
            );
            $_SESSION["alertMessage"][] = "Signin Successful";
        } else {
            $_SESSION["alertMessage"][] = "Incorrect Login Details";
        }
    } else {
        $_SESSION["loginErrorArray"] = $loginErrorArray;
        $_SESSION["alertMessage"][] = "Invalid Details";
    }

    header("Location: ../$lastPage");
    exit();
}



if (isset($_POST["logout"]) && isset($_GET["page"])) {
    $lastPageQuery = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    // Get the last page the user was on before logging out
    $lastPage = $lastPageQuery["page"];
    // Get the query string from the last page the user was on before  logging out
    // $queryString = $lastPageQuery["queryString"];
    
    session_unset();
    session_destroy();

    header("Location: ../$lastPage");
    exit();
}
// if (!$queryString){
//     header("Location: ../$lastPage");
//     exit();
// } else {
//     header("Location: ../$lastPage?$queryString");
//     exit();
// }