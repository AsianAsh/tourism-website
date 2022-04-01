<?php

// Validate credit card info
function validateCreditCard($cardNumber, $cardType, $expiryMonth, $expiryYear, $cvv)
{
    // Error message
    $invalidCardMsg = "Invalid card number.";
    $expiredCardMsg = "Your card is expired.";
    $InvalidCVVMsg = "Invalid CVV.";
    // Card format
    $cardValidationArray = [
        "VISA Card"  => "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "MasterCard" => "/^5[1-5][0-9]{14}$/",
    ];
    // Check for card type
    foreach ($cardValidationArray as $key => $value) {
        if (preg_match($value, $cardNumber)) {
            $card = $key;
        }
    }
    // Invalid card type
    if (isset($card)) {
        if ($card === $cardType) {
            $invalidCardMsg = NULL;
        }
    }
    // Check for card expiry month/year
    $cardExpiryDate = DateTime::createFromFormat('my', $expiryMonth . $expiryYear);
    $now = new DateTime();
    if ($cardExpiryDate > $now) {
        $expiredCardMsg = NULL;
    }

    // Validate cvv format
    $cvvFormat = "/^[0-9]{3,4}$/";
    if (preg_match($cvvFormat, $cvv)) {
        $InvalidCVVMsg = NULL;
    }

    // Compile error msg
    $errMsgArray = [
        "cardErr" => $invalidCardMsg,
        "expiryErr" => $expiredCardMsg,
        "CVVErr" => $InvalidCVVMsg
    ];

    // Check error messages
    foreach ($errMsgArray as $key => $value) {
        if (is_null($value)) {
            unset($errMsgArray[$key]);
        }
    }

    // Return result
    if (!empty($errMsgArray)) {
        return $errMsgArray;
    } else {
        return false;
    }
}

// Function to get the tourpackage info 
// function getTourInfo($tourid,$connection){

//     $stmt = $connection->prepare("SELECT * FROM tourpackages WHERE tour_id = ? AND status =1;");
//     $stmt->bind_param("i",$tourid);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     // check if the tour package is displayed
//     if ($length === 0){
//         return null;
//     }else{
//         while ($row = $result->fetch_assoc()){
//             $tourbox = [];
//             $tourPackageId = $row['tour_id'];
//             $tourName = $row['name'];
//             $totalPrice = $row['price'];
//         }
//     }
//     $stmt->close();
// }

// ?>