<?php 
session_start();
require_once "./components/header+offcanvas.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">

        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="app.css">
    </head>
    <style>


    </style>
    <body>
    <div class="sidebar">
        <div class="logo-details">
        <!-- image -->
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">Travel Time</span>
        </div>
        <ul class="nav-links">
            <li>
            <a href="#" class="active">
                <i class='bx bx-grid-alt' ></i>
                <span class="links_name">Dashboard</span>
            </a>
            </li>
            <li>
            <a href="register_staff.php">
                <i class='bx bx-user' ></i>
                <span class="links_name">Create Staff Account</span>
            </a>
            </li>
            <li>
            <a href="register_agent.php">
                <i class='bx bx-user' ></i>
                <span class="links_name">Create Agent Account </span>
            </a>
            </li>
            <li>
            <a href="sales.php">
                <i class='bx bx-coin-stack' ></i>
                <span class="links_name">Sales Report</span>
            </a>
            </li>
            <li>
            <a href="#">
                <i class='bx bx-log-out' ></i>
                <span class="links_name">Log Out</span>
            </a>
        </ul>
    </div>
    <section class="home-section">
        <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Admin Homepage</span>
        </div>
        
        </nav>

        <div class="home-content">
        <div class="overview-boxes">
            <div class="box">
            <div class="right-side">
                <div class="box-topic">Latest New In Malaysia</div>
                <div class="number"></div>
            </div>
            </div>
        </div>

        <!-- <div class="sales-boxes">
            <div class="recent-sales box"> -->
            <!-- <div class="title">Whats Hot?</div> -->
            
            <!-- </div>
            </div> -->
            
    <!-- for sidebar interaction -->
    <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    }else
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
    </script>

</body>
</html>
<?php require_once "./components/scripts.php"; ?>


