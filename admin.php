<?php
session_start();
require_once "./components/header+offcanvas.php";
?>

<div class="btn-group btn-group-lg" role="group" aria-label="admin-button-group">
    <a type="button" class="btn btn-primary" href="register_staff.php">Create Office Staff Account</a>
    <button type="button" class="btn btn-primary" href="register_agent.php">Create Travel Agent Account</button>
    <button type="button" class="btn btn-primary" href="sales.php">View Sales Report</button>
</div>