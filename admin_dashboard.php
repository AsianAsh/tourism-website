<?php 
session_start();
require_once "./components/header+offcanvas.php"; 
?>

<div class="d-flex justify-content-center">
    <a type="button" class="btn-lg btn-primary mx-3" href="register_staff.php">Create Office Staff Account</a>
    <a type="button" class="btn-lg btn-primary mx-3" href="register_agent.php">Create Travel Agent Account</a>
    <a type="button" class="btn-lg btn-primary mx-3" href="sales.php">View Sales Report</a>
</div>

<?php require_once "./components/scripts.php"; ?>
