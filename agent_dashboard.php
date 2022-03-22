<?php 
session_start();
// Return to index.php if not logged into account
if (!isset($_SESSION["agent"]["agentID"])) {
    header("Location: index.php");
    exit();
} else{
    require_once "./connection/db.php";
    // Get array of tours created by the travel agent ($agentTours)
    $agentID = $_SESSION["agent"]["agentID"];
    $agentTours = [];
    $sql = "SELECT * FROM tour_packages WHERE agent_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $agentID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($agentTours, $row);
    }
    $stmt->close(); 
    // View the contents of $agentTours array
    // echo "<pre>";
    //     var_dump($agentTours);
    // echo "</pre>";
    // die;
}
require_once "./components/header+offcanvas.php"; 
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">

        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="preloader">

        </div>
    <!-- Left Sidebar -->
    <div class="sidebar">
        <div class="logo-details">
        <!-- image -->
        <i class='bx bxl-c-plus-plus'></i>
        <span class="logo_name">Travel Time </span>
        </div> 
        <ul class="nav-links">
            <li>
                <a href="agent_dashboard.php" class="active">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="create_tours.php">
                    <i class='bx bx-pie-chart-alt-2' ></i>
                    <span class="links_name">Create Tour Package</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-book-alt' ></i>
                    <span class="links_name">Created Tour history</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-user' ></i>
                    <span class="links_name">View Account</span>
                </a>
            </li>
            <li>
                <a href="./includes/logout.inc.php">
                    <i class='bx bx-log-out' ></i>
                    <span class="links_name">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Left Sidebar -->

    <section class="home-section">
        <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Welcome Travel Agent </span> 
        </div>
        
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <h3 class="my-3">Manage Your Tours</h3>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Tour Name</th>
                        <th scope="col">Price (per person)</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col" colspan=2>Last Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($agentTours as $tour) : ?>
                        <tr class="align-middle">
                            <td><?php echo $tour["name"]?></td>
                            <td>RM<?php echo $tour["price"]?></td>
                            <td><?php echo $tour["location"]?></td>
                            <td><?php if ($tour["status"] == 1){
                                echo "Public";
                            } else{
                                echo "Not Public";
                            } 
                            ?></td>
                            <td><?php echo $tour["updated_date"]?></td>
                            <td><a href="./edit_tour.php?id=<?php echo $tour["tour_id"];?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>   
            </div>
            
            <!-- <div class="overview-boxes">
                <div class="box">
                <div class="right-side">
                    <div class="box-topic">Recent Articles</div>
                    <div class="number"></div>
                </div>
                </div>
            </div>

            <div class="article-box">
                <div class="article-content">
                    
                    <img src=" images/article5" alt="" width="100%" height="100%">
                </div>
            </div>

            <div class="article-box">
                <div class="article-content">
                    <img src=" images/article4" alt="" width="100%" height="100%">
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
            </div> -->
        </div>
    </section>
        
            
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

<?php require_once "./components/scripts.php"; ?>
