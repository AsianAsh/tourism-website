<?php 
session_start();
require_once "./components/header+offcanvas.php"; 

// Return to index.php if not logged into account
if (!isset($_SESSION["admin"]["adminID"])) {
    header("Location: index.php");
    exit();
}
?>

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
        <a href="./includes/logout.inc.php">
            <i class='bx bx-log-out' ></i>
            <span class="links_name">Log Out</span>
        </a>
    </ul>
</div>
<section class="home-section">
    <nav>
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Admin Dashboard</span>
    </div>
    
    </nav>

    <div class="home-content">
    <div class="overview-boxes">
        <div class="box">
        <div class="right-side">
            <div class="box-topic">Recent Article</div>
            <div class="number"></div>
        </div>
        </div>
    </div>

    <div class="article-box">
        <div class="article-content">
            
            <img src="images/article_img2" alt="" width="100%" height="100%">
        </div>
    </div>

    <div class="article-box">
        <div class="article-content">
            <img src="images/article3" alt="" width="100%" height="100%">
        </div>
    </div>

    <div class="article-box">
        <div class="article-content">
            
            <img src="images/article4" alt="" width="100%" height="100%">
        </div>
    </div>

    <div class="article-box">
        <div class="article-content">
            <img src="images/article5" alt="" width="100%" height="100%">
        </div>
    </div>
</section>
    
<!-- Sidebar Interaction -->
<script>
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
    sidebar.classList.toggle("active");
    if(sidebar.classList.contains("active")){
        sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
    } else{
        sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}
</script>

<?php require_once "./components/scripts.php"; ?>