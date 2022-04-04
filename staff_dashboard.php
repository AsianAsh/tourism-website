<?php 
session_start();
// Return to index.php if not logged into account
if (!isset($_SESSION["staff"]["staffID"])) {
    header("Location: index.php");
    exit();
} else{
    require_once "./connection/db.php";
    // Get array of tours created by all travel agents ($tours)
    $staffID = $_SESSION["staff"]["staffID"];
    $tours = [];
    $sql = "SELECT * FROM tour_packages ORDER BY tour_id DESC;";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        array_push($tours, $row);
    }
    $stmt->close(); 
    // View the contents of $tours array
    // echo "<pre>";
    //     var_dump($tours);
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
    <!-- Publish Tour Confirmation Modal from Publish Button -->
    <div class="modal fade" id="publishTourModal" tabindex="-1" aria-labelledby="publishTourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Publish Tour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="addTourName"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                    <form action="./includes/tour_status.inc.php" method="POST">
                        <!-- <input type="hidden" name = "type" value = "" id = "addItemTypeInput"> -->
                        <input type="hidden" name="tourID" id="publishTourIDInput" value = "">
                        <input type="hidden" name="staffID" id="publishTourStaffInput" value = ""> <!-- change this for staffID -->
                        <button type="submit" class="btn btn-success" name="publishTour">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Unpublish Tour Confirmation Modal from Unpublish Button -->
    <div class="modal fade" id="unpublishTourModal" tabindex="-1" aria-labelledby="unpublishTourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unpublish Tour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="removeTourName"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                    <form action="./includes/tour_status.inc.php" method="POST">
                        <!-- <input type="hidden" name = "type" value = "" id = "deleteItemTypeInput"> -->
                        <input type="hidden" name = "tourID" id = "unpublishTourIDInput" value = "">
                        <input type="hidden" name = "staffID" value = "" id = "unpublishTourStaffInput"> <!-- change this for staffID -->
                        <button type="submit" class="btn btn-danger" name = "unpublishTour">Unpublish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
            <!-- <li>
            <a href="tours.php">
                <i class='bx bx-pie-chart-alt-2' ></i>
                <span class="links_name">View Tour Packages</span>
            </a>
            </li>
            <li>
            <a href="#">
                <i class='bx bx-pie-chart-alt-2' ></i>
                <span class="links_name">Modify Tour Packages</span>
            </a>
            </li> -->
            <!-- <li>
            <a href="#">
                <i class='bx bx-user' ></i>
                <span class="links_name">View Account</span>
            </a>
            </li> -->
            
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
                <span class="dashboard">Staff Dashboard</span>
            </div>       
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <h3 class="my-3">Manage Tours</h3>
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tour Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Location</th>
                        <th scope="col">Status</th>
                        <th scope="col">Last Updated</th>
                        <th scope="col">Travel Agent ID</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tours as $tour) : ?>
                        <tr class="align-middle">
                            <td><?php echo $tour["tour_id"]?></td>
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
                            <td class="text-center"><?php echo $tour["agent_id"]?></td>
                            <?php if($tour["status"] === 0):?>
                            <td class="text-center"><button type="button" class="btn btn-primary publishTourBtn"data-bs-toggle="modal" data-bs-target="#publishTourModal" data-staffid="<?php echo $staffID; ?>" data-tourid = "<?php echo $tour["tour_id"]; ?>" data-name = "<?php echo $tour["name"]; ?>">Publish</button></td>
                            <?php else: ?>
                            <td class="text-center"><button type="button" class="btn btn-primary unpublishTourBtn"data-bs-toggle="modal" data-bs-target="#unpublishTourModal" data-staffid="<?php echo $staffID ?>" data-tourid = "<?php echo $tour["tour_id"] ?>" data-name = "<?php echo $tour["name"] ?>">Unpublish</button></td>
                            <?php endif; ?>
                            <td><a href="./edit_tour.php?id=<?php echo $tour["tour_id"];?>" class="btn btn-primary">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>   
            </div>
        </div>
        
            
<!-- Sidebar Interactions -->
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

<!-- Change Status of Tours (Publish/Unpublish)-->
<script>
    // const searchButton = document.querySelector(".q")

    // When staff clicks the publish button, the tour ID, staff ID and tour name is retrieved (tour name is displayed in the modal)
    const publishTourBtn = document.querySelectorAll(".publishTourBtn")
    const publishTourIDInput = document.querySelector("#publishTourIDInput")
    const publishTourStaffInput = document.querySelector("#publishTourStaffInput")
    const addTourName = document.querySelector("#addTourName")

    for(const btn of publishTourBtn){
      btn.addEventListener("click", function(){
        publishTourStaffInput.value = this.dataset.staffid
        publishTourIDInput.value = this.dataset.tourid
        addTourName.innerHTML = this.dataset.name
      })
    }
 
    // When staff clicks the unpublish button, the tour ID, staff ID and tour name is retrieved (tour name is displayed in the modal)
    const unpublishTourBtn = document.querySelectorAll(".unpublishTourBtn")
    const unpublishTourIDInput = document.querySelector("#unpublishTourIDInput")
    const unpublishTourStaffInput = document.querySelector("#unpublishTourStaffInput")
    const removeTourName = document.querySelector("#removeTourName")

    for(const btn of unpublishTourBtn){
      btn.addEventListener("click", function(){
        unpublishTourStaffInput.value = this.dataset.staffid
        unpublishTourIDInput.value = this.dataset.tourid
        removeTourName.innerHTML = this.dataset.name
      })
    }
</script>

<?php require_once "./components/scripts.php"; ?>
