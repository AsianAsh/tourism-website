<?php
session_start();
// Return to index.php if not logged into a travel agent or staff account
if (!isset($_SESSION["agent"]["agentID"]) && !isset($_SESSION["staff"]["staffID"]) && !isset($_GET["id"])) {
    header("Location: index.php");
    exit();
} else{
    // require_once "./helpers/helpers.php";
    require_once "./connection/db.php";
    require_once "./components/header+offcanvas.php";
    $tourDetails = [];
    $id = $_GET["id"];
    $sql = "SELECT t.*, i.* FROM tour_packages t LEFT JOIN trip_images i ON t.tour_id = i.tour_id WHERE t.tour_id = ?;";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $tourDetails = $result->fetch_assoc();
    $stmt->close();
    $description = str_replace('[NEWLINE]', "\n", $tourDetails['description']);

    // var_dump($tourDetails);
    // die;
}
?>

<div class="container my-5 px-5">
    <h1 class = "text-center mb-5 title-heading">Edit Tour Package</h1>
    <form action="./includes/edit_tour.inc.php?id=<?php echo $id ?>" enctype="multipart/form-data" class="row g-3" method="POST">
        <!-- Tour Image -->
        <div class="unit flex-column flex-md-row align-items-md-stretch">
            <div class="unit-left">
                <img src=
                <?php if(!isset($tourDetails["image"])){
                    echo "images/Melaka-index.jpeg";
                } else{
                    $image = base64_encode($tourDetails["image"]);
                    echo "'data:image/jpg;charset=utf8;base64, $image'"; //$image is a longblob(bunch of random symbols) so this converts it to image
                }?> 
                alt="" class="img-thumbnail" width="450" height="400">
            </div>
        </div>
        <div class="col-md-8">
            <label for="editMainImage" class="mt-1 input-label">Main Tour Image:</label>
            <input type="file" class="fileInput" id="editMainImage" name="editMainImage" value="" accept="image/png, image/jpg, image/jpeg">
        </div>
        <!-- Tour Name Field -->
        <div class="col-md-8">
            <label for="editTourName" class="input-label">Name</label>
            <input type="text" class="form-control" id="editTourName" placeholder="Tour Name" name="tourName" value="<?php echo $tourDetails["name"];?>">
        </div>
        <!-- Price Field -->
        <div class="col-md-4">
            <label for="editTourPrice" class="input-label">Price(RM)</label>
            <input type="number" min="1" max="100000" step="0.01" class="form-control" id="editTourPrice" placeholder="Price" name="tourPrice" value="<?php echo $tourDetails["price"];?>">
        </div>
        <!-- Description Field -->
        <div class="col-md-12">
            <label for="editDescription" class="input-label">Description</label>
            <textarea class="form-control" id="editDescription" rows="15" name="description"><?php echo $description;?></textarea>
        </div>       
        <!-- Trip Duration Field -->
        <div class="col-md-6">
            <label for="editTripDuration" class="input-label">Trip Duration(Days & Nights)</label>
            <input type="text" class="form-control" id="editTripDuration" placeholder="2D1N" name="tripDuration" value="<?php echo $tourDetails["trip_duration"];?>">
        </div>
        <!-- Location Field -->
        <div class="col-md-6">
            <label for="editLocation" class="input-label">Location</label>
            <input type="text" class="form-control" id="editLocation" placeholder="Location" name="location" value="<?php echo $tourDetails["location"];?>">       
        </div>
        <!-- Min Pax Field -->
        <div class="col-md-3">
            <label for="minPax" class="input-label">Min Pax</label>
            <input type="number" min ="1" max="1000" class="form-control" id="minPax" placeholder="Minimum Pax" name="minPax" value="<?php echo $tourDetails["min_pax"];?>">
        </div>
        <!-- Max Pax Field -->
        <div class="col-md-3">
            <label for="maxPax" class="input-label">Max Pax</label>
            <input type="number" min="1" max="1000" class="form-control" id="maxPax" placeholder="Maximum Pax" name="maxPax" value="<?php echo $tourDetails["max_pax"];?>">
        </div>
        <!-- Tour Start Time Field-->
        <div class="col-md-2">
            <label for="editStartTime" class="mt-1 input-label">Start Time:</label>
            <input type="time" id="editStartTime" name="startTime" value="<?php echo $tourDetails["start_time"];?>">
        </div>
        <!-- Tour End Time Field -->
        <div class="col-md-2">
            <label for="editEndTime" class="mt-1 input-label">End Time:</label>
            <input type="time" id="editEndTime" name="endTime" value="<?php echo $tourDetails["end_time"];?>">
        </div>
        <!-- Create Tour Button -->
        <button class="btn btn-primary" type="submit" name="updateTour">Confirm Changes</button>
    </form>

    <?php /*
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
        }*/
    ?>
</div>

<?php require_once "./components/scripts.php"; ?>