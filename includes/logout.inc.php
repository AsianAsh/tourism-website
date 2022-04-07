<?php 
session_start();

if (isset($_POST["logout"]) && isset($_GET["page"])) {
    $lastPageQuery = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    // Get the last page the user was on before logging out, or homepage if user was on profile/account page when logging out
    if ($lastPageQuery["page"] == "profile.php"){
        $lastPage = "index.php";
    } elseif($lastPageQuery["page"] == "admin_dashboard.php"){ // Same here
        $lastPage = "index.php";
    } else{
        $lastPage = $lastPageQuery["page"];
    }


    // Get the query string from the last page the user was on before  logging out
    // $queryString = $lastPageQuery["queryString"];
    
    session_unset();
    session_destroy();

    header("Location: ../$lastPage");
    exit();
} else{
    session_unset();
    session_destroy();

    header("Location: ../index.php");
    exit();
}