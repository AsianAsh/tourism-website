<?php 
session_start();
require_once "./components/header+offcanvas.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["agent"]["agentID"])) {
    header("Location: index.php");
    exit();
}
?>

<div class="d-flex justify-content-center">
    <a type="button" class="btn-lg btn-primary mx-3" href="create_tours.php">Create Tour Package</a>
    <a type="button" class="btn-lg btn-primary mx-3" href="">View Account</a>
    <!-- <a type="button" class="btn-lg btn-primary mx-3" href="sales.php">View Sales Report</a> -->
</div>

<?php require_once "./components/scripts.php"; ?>
