<?php session_start();

if (!isset($_SESSION["user"]["userID"])) {
    header("Location: ../index.php");
    exit();
} else{
    require_once "../connection/db.php";
    $id = $_SESSION["user"]["userID"];
    $errArray = [];
}

// If Save profile button was clicked
if (isset($_POST["saveProfile"])){
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $nameRegEx = "/^([a-zA-Z' ]+)$/";

    // Check for any empty input fields
    if (empty($firstName) || empty($lastName)){
        array_push($errArray, "profileEmpty");
    } elseif(!preg_match($nameRegEx, $firstName)){
        // Validate First & Last Name
        array_push($errArray, "firstName");
    } elseif(!preg_match($nameRegEx, $lastName)){
        array_push($errArray, "lastName");
    } else{
        $stmt = $connection->prepare("UPDATE customer SET first_name = ?, last_name = ? WHERE customer_id = ?;");
        $stmt->bind_param("ssi", $firstName, $lastName, $id);
        $stmt->execute();
        $stmt->close();

        // Set new account details to the session
        $stmt = $connection->prepare("SELECT * FROM customer WHERE customer_id = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
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
        header("Location: ../profile.php?profile=success");
        exit();
    }
    $_SESSION["errorsArray"] = $errArray;
    header("Location: ../profile.php");
    exit();

// If Change Password button was clicked
} elseif(isset($_POST["changePwd"])){
    $currentPwd = $_POST["oldPassword"];
    $newPwd = $_POST["newPassword"];
    $confirmPwd = $_POST["confirmPassword"];

    $stmt = $connection->prepare("SELECT customer_password FROM customer WHERE customer_id = ?;");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $dbPwd = $row["customer_password"];
    $verifyPassword = password_verify($currentPwd, $dbPwd);
    $passwordRegEx = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z~!@#$%^&*-_?]{8,64}$/';
    // Password Validation
    if (empty($currentPwd) || empty($newPwd) || empty($confirmPwd)){ // Check if all 3 input fields are empty
        array_push($errArray, "pwdEmpty");
    } elseif($verifyPassword === false){ // Check if input password is same as current password in DB
        array_push($errArray, "wrongPwd");
    } elseif($currentPwd === $newPwd){ //Check if current passwod and new password entered are the same
        array_push($errArray, "samePwd");
    } elseif(!preg_match($passwordRegEx, $newPwd)) { // Check if the characters in new password valid   
        array_push($errArray, "invalidPwd");                            
    } elseif($confirmPwd !== $newPwd){ // Check if new password and confirm password fields are the same
        array_push($errArray, "diffPwd");
    } else{
        $hashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("UPDATE customer SET customer_password = ? WHERE customer_id = ?");
        $stmt->bind_param("si", $hashedPwd, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: ../profile.php?profilepwd=success");
        exit();
    }
    $_SESSION["errorsArray"] = $errArray;
    header("Location: ../profile.php?profilepwd");
    exit();

// If Upload Profile Pic button is clicked
} elseif(isset($_POST["uploadProfilePic"])){
    // Create a Unique Name for the image using time()
    $profilePicName = time() . "_" . $_FILES["inputProfilePic"]["name"]; // time() returns the current time(number of seconds from January 1 1970 00:00:00 GMT)
    $path = "../images/profile-pics/" . $profilePicName;
    if (move_uploaded_file($_FILES["inputProfilePic"]["tmp_name"], $path)){
        $pathDB = substr($path, 1);
        $stmt = $connection->prepare("UPDATE customer SET profile_pic = ? WHERE customer_id = ?");
        $stmt->bind_param("si", $pathDB, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION["user"]["profilePic"] = $pathDB;
        header("Location: ../profile.php?profilepic=success");
        exit();
    } else{
        array_push($errArray, "profilePic");
    }
    $_SESSION["errorsArray"] = $errArray;
    header("Location: ../profile.php");
    exit();

// If Remove Current Pic button is clicked
} elseif(isset($_POST["removeProfilePic"])){
    $defaultPicPath = "./images/svg/profile-pic-default.svg";
    $stmt = $connection->prepare("UPDATE customer SET profile_pic = ? WHERE customer_id = ?");
    $stmt->bind_param("si", $defaultPicPath, $id);
    $stmt->execute();
    $stmt->close();
    $_SESSION["user"]["profilePic"] = $defaultPicPath;
    header("Location: ../profile.php");
    exit();
} else{
    header("Location: ../index.php");
    exit();
}