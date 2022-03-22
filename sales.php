<?php
session_start();
require_once "./components/header+offcanvas.php";

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <p>Sales Data Stuff</p>
</div>










<?php require_once "./components/scripts.php"; ?>