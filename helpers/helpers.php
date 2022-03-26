<?php

// Function to get the tourpackage info 
function getTourInfo($tourid,$connection){

    $stmt = $connection->prepare("SELECT * FROM tourpackages WHERE tour_id = ? AND status =1;");
    $stmt->bind_param("i",$tourid);
    $stmt->execute();
    $result = $stmt->get_result();
    // check if the tour package is displayed
    if ($length === 0){
        return null;
    }else{
        while ($row = $result->fetch_assoc()){
            $tourbox = [];
            $tourPackageId = $row['tour_id'];
            $tourName = $row['name'];
            $totalPrice = $row['price'];
        }
    }
    $stmt->close();
}

?>