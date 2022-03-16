<?php
session_start();
require_once "./components/header+offcanvas.php";

// Return to index.php if not logged into account
if (!isset($_SESSION["agent"]["agentID"])) {
    header("Location: index.php");
    exit();
}
?>

<div>Create Tours Here</div>

<?php require_once "./components/scripts.php"; ?>