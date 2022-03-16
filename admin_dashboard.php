<?php 
session_start();
require_once "./components/header+offcanvas.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}
?>

<!-- Page Header-->
<header class="section page-header">
    
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-corporate" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="106px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
        <div class="rd-navbar-collapse-toggle rd-navbar-fixed-element-1" data-rd-navbar-toggle=".rd-navbar-collapse"><span></span></div>
        <div class="rd-navbar-aside-outer">
            <div class="rd-navbar-aside">
            <!-- RD Navbar Panel-->
            <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                <!--Brand--><a class="brand" href="index.html"><img src="images/logo-default-450x37.png" alt="" width="225" height="18"/></a>
                </div>
            </div>
            </div>

        </div>
        <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
            <div class="rd-navbar-nav-wrap">
                <ul class="list-inline list-inline-md rd-navbar-corporate-list-social">
                <li><a class="icon fa fa-facebook" href="#"></a></li>
                <li><a class="icon fa fa-twitter" href="#"></a></li>
                <li><a class="icon fa fa-google-plus" href="#"></a></li>
                <li><a class="icon fa fa-instagram" href="#"></a></li>
                </ul>

                <!-- Account Button -->
                <ul>
                <li class="rd-nav-item">
                    <a class="rd-nav-link" data-bs-toggle="offcanvas" href="#accountCanvas" role="button" aria-controls="accountCanvas">Account</a>
                </li>
                </ul>

                <!-- RD Navbar Nav-->
                <ul class="rd-navbar-nav">

                <!-- Find a way to have the tab of the current page highlighted (rd-nav-item active) 
                without having to cut & paste this entire <ul> code in each php file-->
                <!-- <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">Home</a> 
                </li> -->

                <li class="rd-nav-item"><a class="rd-nav-link" href="admin_dashboard.php">Welcome Admin</a>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="about.php"></a>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="tours.php"></a>
                </li>
                <li class="rd-nav-item"><a class="rd-nav-link" href="typography.php"></a>
                </ul>

            </div>
            </div>
        </div>
        </nav>
    </div>
</header>

<div class="d-flex justify-content-center" style="padding:50px 0px 50px 0px ">
    <a type="button" class="btn-lg btn-primary mx-3" href="register_staff.php">Create Office Staff Account</a>
    <a type="button" class="btn-lg btn-primary mx-3" href="register_agent.php">Create Travel Agent Account</a>
    <a type="button" class="btn-lg btn-primary mx-3" href="sales.php">View Sales Report</a>
</div>


<?php require_once "./components/scripts.php"; ?>


