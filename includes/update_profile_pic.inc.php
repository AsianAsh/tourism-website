<?php
// Handle request to change user prpfile picture
session_start();
// POST received from profile.php (Profile Picture Tab) (Upload Button)
if (isset($_SESSION["user"]["customer_id"], $_POST["uploadPic"])) {
    $hasImage = $_SESSION["user"]["profilePic"] === "" ? false : true;
    require_once "../connection/db.php";
    // Get submitted image file from user
    $dataURI = $_POST["newProfilePic"];
    $image = file_get_contents($dataURI);

    //validateImage Function from helpers
    $getImageString = getimagesizefromstring($image);
    // Using this method to check if content is image
    if (!$getImageString) {
        return false;
    }
    $mimeType = $getImageString["mime"];
    $mimeTypeArray = ["image/png", "image/jpg", "image/jpeg"];
    if (!in_array($mimeType, $mimeTypeArray)) {
        return false;
    }
    return $mimeType;
    //End of validateImage function from helpers

    $imageMime = $mimeType;
    if (!$imageMime) {
        $_SESSION["alertMessage"][] = "Invalid Image Type";
        header("Location: ../profile.php");
        exit();
    }
    //Check if User dir exist in the server folder, if not, create it
    $userImageDirectory = "../Images/User";
    if (!is_dir($userImageDirectory)) {
        mkdir($userImageDirectory);
    }
    
    $_SESSION["alertMessage"][] = "Image Updated";

    $userDir = "../images/User/user_" . $_SESSION["user"]["customer_id"];
    if (!is_dir($userDir)) {
        mkdir($userDir);
    }
    switch ($mimeType) {
        case "image/png":
            $userPic = $userDir . "/user_" . $_SESSION["user"]["customer_id"] . "_pic" . ".png";
            file_put_contents($userPic, $image);
            break;
        case "image/jpg":
            $userPic = $userDir . "/user_" . $_SESSION["user"]["customer_id"] . "_pic" . ".jpg";
            file_put_contents($userPic, $image);
            break;
        case "image/jpeg":
            $userPic = $userDir . "/user_" . $_SESSION["user"]["customer_id"] . "_pic" . ".jpeg";
            file_put_contents($userPic, $image);
            break;
    }

    $saveToDbImage = substr($userPic, 1);
    $stmt = $connection->prepare("UPDATE user SET profile_pic = ? WHERE customer_id = ?");
    $stmt->bind_param("si", $saveToDbImage, $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION["user"]["profilePic"] = $saveToDbImage;
    
    header("Location: ../profile.php");
    exit();
}

// POST received from profile.php (Profile Picture Tab) (Remove Current Picture Button)
if (isset($_SESSION["user"]["customer_id"], $_POST["removeProfilePic"])) {
    require_once "../connection/db.php";
    $defaultPic = "./images/svg/profile-pic-default.svg"; 
    $stmt = $connection->prepare("UPDATE customer SET profile_pic = ? WHERE customer_id = ?");
    $stmt->bind_param("si", $defaultPic, $_SESSION["user"]["customer_id"]);
    $stmt->execute();
    $stmt->close();
    $_SESSION["user"]["profilePic"] = $defaultPic;
    //Delete the current user image from the server folder
    $files = glob("../Images/User/user_" . $_SESSION["user"]["customer_id"] . "/*"); // get all file names
    foreach ($files as $file) { // iterate files
        if (is_file($file)) {
            unlink($file); // delete file
        }
    }
    header("Location: ../profile.php");
    exit();
}
