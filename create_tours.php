<?php
session_start();
// Return to index.php if not logged into a travel agent account
if (!isset($_SESSION["agent"]["agentID"])) {
    header("Location: index.php");
    exit();
}

// require_once "./helpers/helpers.php";
require_once "./connection/db.php";
require_once "./components/header+offcanvas.php";
?>

<div class="container my-5 px-5">
    <h1 class = "text-center mb-5 title-heading">Create New Tour Package</h1>
    <form action="./includes/create_tours.inc.php" class = "row g-3" method="POST">
        <!-- Tour Name Field -->
        <div class="col-md-8">
            <label for="inputTourName" class="input-label">Name</label>
            <?php
                if(isset($_GET["name"])){
                    $name = $_GET["name"];
                    echo '<input type="text" class="form-control" id="inputTourName" placeholder="Tour Name" name="tourName" value="'.$name.'">';
                } else{
                    echo '<input type="text" class="form-control" id="inputTourName" placeholder="Tour Name" name="tourName">';
                }
            ?>
        </div>
        <!-- Price Field -->
        <div class="col-md-4">
            <label for="inputTourPrice" class="input-label">Price(RM)</label>
            <?php
                if(isset($_GET["price"])){
                    $price = $_GET["price"];
                    echo '<input type="number" min="1" max="100000" step="0.01" class="form-control" id="inputTourPrice" placeholder="Price" name="tourPrice" value="'.$price.'">';
                } else{
                    echo '<input type="number" min="1" max="100000" step="0.01" class="form-control" id="inputTourPrice" placeholder="Price" name="tourPrice">';
                }
            ?>          
        </div>
        <!-- Description Field -->
        <div class="col-md-12">
            <label for="inputDescription" class="input-label">Description</label>
            <?php
                if(isset($_GET["description"])){
                    $description = $_GET["description"];
                    echo '<textarea class="form-control" id="inputDescription" rows="10" name="description">'.$description.'</textarea>';
                } else{
                    echo '<textarea class="form-control" id="inputDescription" rows="10" name="description"></textarea>';
                }
            ?> 
        </div>

        <!-- <div class="col-md-6">
            <label for="inputTelephone" class="">Status</label>
            <select class="form-select" aria-label="Default select example" name = "status" required>
            <option value = "1" selected >Available</option>
            <option value="0" >Not Available</option>
            </select>
        </div> -->
        
        <!-- Trip Duration Field -->
        <div class="col-md-6">
            <label for="inputTripDuration" class="input-label">Trip Duration(Days & Nights)</label>
            <?php
                if(isset($_GET["duration"])){
                    $duration = $_GET["duration"];
                    echo '<input type="text" class="form-control" id="inputTripDuration" placeholder="2 Days 1 Night" name="tripDuration" value="'.$duration.'">';
                } else{
                    echo '<input type="text" class="form-control" id="inputTripDuration" placeholder="2 Days 1 Night" name="tripDuration">';
                }
            ?> 
        </div>
        <!-- Location Field -->
        <div class="col-md-6">
            <label for="inputLocation" class="input-label">Location</label>
            <?php
                if(isset($_GET["location"])){
                    $location = $_GET["location"];
                    echo '<input type="text" class="form-control" id="inputLocation" placeholder="Location" name="location" value="'.$location.'">';
                } else{
                    echo '<input type="text" class="form-control" id="inputLocation" placeholder="Location" name="location">';
                }
            ?>            
        </div>
        <!-- Min Pax Field -->
        <div class="col-md-3">
            <label for="minPax" class="input-label">Min Pax</label>
            <?php
                if(isset($_GET["min"])){
                    $min = $_GET["min"];
                    echo '<input type="number" min ="1" max="1000" class="form-control" id="minPax" placeholder="Minimum Pax" name="minPax" value="'.$min.'">';
                } else{
                    echo '<input type="number" min ="1" max="1000" class="form-control" id="minPax" placeholder="Minimum Pax" name="minPax">';
                }
            ?> 
        </div>
        <!-- Max Pax Field -->
        <div class="col-md-3">
            <label for="maxPax" class="input-label">Max Pax</label>
            <?php
                if(isset($_GET["max"])){
                    $max = $_GET["max"];
                    echo '<input type="number" min="1" max="1000" class="form-control" id="maxPax" placeholder="Maximum Pax" name="maxPax" value="'.$max.'">';
                } else{
                    echo '<input type="number" min="1" max="1000" class="form-control" id="maxPax" placeholder="Maximum Pax" name="maxPax">';
                }
            ?> 
        </div>
        <!-- Tour Start Time Field-->
        <div class="col-md-2">
            <label for="inputStartTime" class="mt-1 input-label">Start Time:</label>
            <?php
                if(isset($_GET["starttime"])){
                    $startTime = $_GET["starttime"];
                    echo '<input type="time" id="inputStartTime" name="startTime" value="'.$startTime.'">';
                } else{
                    echo '<input type="time" id="inputStartTime" name="startTime">';
                }
            ?> 
        </div>
        <!-- Tour End Time Field -->
        <div class="col-md-2">
            <label for="inputEndTime" class="mt-1 input-label">End Time:</label>
            <?php
                if(isset($_GET["endtime"])){
                    $endTime = $_GET["endtime"];
                    echo '<input type="time" id="inputEndTime" name="endTime" value="'.$endTime.'">';
                } else{
                    echo '<input type="time" id="inputEndTime" name="endTime">';
                }
            ?> 
        </div>
        <!-- Create Tour Button -->
        <button class="btn btn-primary" type="submit" name="createTour">Create Tour</button>
    </form>

    <?php
        if(!isset($_GET["tour"])){
            exit();
        } else{
            $creationCheck = $_GET["tour"];
            
            if($creationCheck == "empty"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Please fill in all fields!</p>";
                exit();
            } elseif($creationCheck == "description"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Description has exceeded the 1000 character limit.</p>";
                exit();
            } elseif($creationCheck == "pax"){
                echo "<p class='mt-2 text-danger text-center mb-0 ps-1 d-block'>Minimum pax cannot be more than maximum pax.</p>";
                exit();
            } elseif($creationCheck == "success"){
                echo "<p class='mt-2 text-success text-center mb-0 ps-1 d-block'>Tour Package Creation Successful!</p>";
                exit();
            }
        }
    ?>
</div>

<?php require_once "./components/scripts.php"; ?>