<?php
session_start();
require_once "./components/header+offcanvas.php";

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}else{
    require_once "./connection/db.php";
    // Get array of sales from database
    $adminID =$_SESSION["admin"]["adminID"];
    $sales = [];
    $sql = "SELECT * FROM orders ORDER BY  order_date ASC;";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        array_push($sales,$row);
    }
    $stmt->close();
    // View the contents of $tours array
    // echo "<pre>";
    //     var_dump($tours);
    // echo "</pre>";
    // die;
}
// require_once  "./components/header+offcanvas.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>

    .my-4{
        padding-left:7px
    }

    .back{
        width:45px;
        height:45px;
        /* padding:10px */
    }
</style>
<body>

    <div class="home-content">
        <div class="overview boxes">
            <h3 class="my-4"><span><a href="admin_dashboard.php"><img src="images/Goback.png " alt="#" class="back"></a></span>Sales Report</h3>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Tour ID</th>
                        <th scope="col">Customer ID</th>
                        <th scope="col">No. of Adult</th>
                        <th scope="col">No. of Children</th>
                        <!-- <th scope="col">Check Out Date</th> -->
                        <th scope="col">Total Price</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale):?>
                        <td><?php echo $sale["order_id"]?></td>
                        <td><?php echo $sale["order_date"]?></td>
                        <td><?php echo $sale["tour_id"]?></td>
                        <td><?php echo $sale["customer_id"]?></td>
                        <td><?php echo $sale["adult_num"]?></td>
                        <td><?php echo $sale["child_num"]?></td>
                        <td><?php echo $sale["total_price"]?></td>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>










<?php require_once "./components/scripts.php"; ?>