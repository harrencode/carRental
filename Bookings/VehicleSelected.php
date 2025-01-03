<?php
// Connect to the database
include "../config.php";

session_start();

/*$customerID = $_SESSION['CustomerID'];
$vehicleID = $_SESSION['VehicleID'];*/

// Check if vehicleID is set in the URL
if (isset($_GET['vehicleID'])) {
    $vehicleID = $_GET['vehicleID'];

    // Prepare the query to fetch the specific vehicle's details
    $query = "SELECT * FROM registered_vehicles WHERE VehicleID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $vehicleID); 
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the vehicle details
    if ($result->num_rows > 0) {
        $vehicle = $result->fetch_assoc();
        // Now you have all details of the selected vehicle in $vehicle
    } else {
        echo "Vehicle not found.";
    }

    $stmt->close();
} else {
    echo "No vehicle selected.";
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VRS select vehicle</title>
    <link rel="stylesheet" href="CarSelectstyles.css">
    <script  src="CarSelectScript.js"></script>
</head>
<body>
    <div class="banner">
        <div class="navbar">

             <a href="../Homepage/index.php"> <img src= 'vrslogo.png' class="logo" alt="VRS logo"></a> <!-- need to go to homepage when click the logo-->
            
            <div class="hamburger">
                <div>
                </div>

            </div>

            <div class="navbar_list">
                <ul>
                    <li><br></li>
                    <li><a href="#"></a></li>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Vehicles</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
           
        </div>




        
        <section class="items">                          
            <div class="gallery">
                <div class="content">
                <!-- Display the selected vehicle's details -->
                        <div class="textstyle">
                            <?php if (isset($vehicle)) { ?>
                                <h1><?php echo $vehicle['Vehicle_make'] . " " . $vehicle['Vehicle_model']; ?></h1>
                                
                                    <div class="image-gallery">
                                        <!-- Main large image on the left -->
                                        <img id="largeImage" class="large-image" src="../vehicleRegister/<?php echo $vehicle['image_1']; ?>" alt="Vehicle Image">
                                        
                                        <!-- Container for smaller images on the right -->
                                        <div class="small-images-container">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_1']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_2']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_3']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_4']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_5']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            <img class="smallimages" src="../vehicleRegister/<?php echo $vehicle['image_6']; ?>" alt="Vehicle Image" onclick="changeLargeImage(this)">
                                            
                                        </div>
                                        
                                    </div>
                        
                                <p>Year: <?php echo $vehicle['Model_year']; ?></p>
                                <p>Engine Capacity: <?php echo $vehicle['Engine_capacity']; ?></p>
                                <p>Fuel type: <?php echo $vehicle['Fuel_type']; ?></p>
                                <p>Rental Price: <?php echo $vehicle['Renatal_charge']; ?></p>
                                <p>Current Mileage: <?php echo $vehicle['Milage']; ?> km</p>
                                <p>Transmission: <?php echo $vehicle['transmission']; ?></p>
                                <p>Vehicle Colour: <?php echo $vehicle['colour']; ?></p>
                                <p>Vehicle Availability: <?php echo $vehicle['availability']; ?></p>

                                <form action="Booking.php" method="$_POST">
                                <div> <button type="submit" class="btn" name="btnBooknow">BOOK NOW</button> </div> </form>
                                <!-- Add other vehicle details as needed -->
                            <?php }
                            $_SESSION['VehicleID'] = $vehicleID;
                             ?>

            

                        </div>
                        
                        </div>
                  

            </div>

        </div>

        </section>
            

    </div>
    
   
</body>
</html>