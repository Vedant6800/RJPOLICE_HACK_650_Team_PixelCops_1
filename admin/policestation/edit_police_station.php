<?php
require_once('../conn.php');
// session_start(); // Start the session

// $station_code=$_SESSION['station_code'];
// echo $station_code;

// Assuming you have a specific police station ID. Replace 'your_station_id' with the actual station ID.
$stationId = 11;

// Fetch police station details based on ID
$stmt = $conn->prepare("SELECT * FROM police_station WHERE id = ?");
$stmt->bind_param("i", $stationId);
$stmt->execute();
$result = $stmt->get_result();

// Check if the station exists
if ($result->num_rows > 0) {
    $stationDetails = $result->fetch_assoc();
} else {
    echo "Police station not found.";
    exit;
}

// Close the prepared statement
$stmt->close();

// Check if the form is submitted for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated form data
    $updatedStationName = $_POST['station_name'];
    $updatedStationAddress = $_POST['station_address'];
    $updatedStationCode = $_POST['station_code'];
    $updatedHeadName = $_POST['head_name'];
    $updatedEmailId = $_POST['email_id'];
    $updatedPhoneNumber = $_POST['phone_number'];
    $updatedPostalCode = $_POST['postal_code'];
    $updatedDistrictId = $_POST['district_id'];
    $updatedCityId = $_POST['city_id'];
    // $updatedPassword = isset($_POST['password']) ? $_POST['password'] : $stationDetails['password'];
    $updatedPassword = $_POST['password'];
    $updatedVerificationCode = isset($_POST['verification_code']) ? $_POST['verification_code'] : $stationDetails['verification_code'];

    // If the password is not changed, use the existing password from the database
    if (empty($_POST['password'])) {
        $updatedPassword = $stationDetails['password'];
    }

    // Update data in the police station table
    $updateStmt = $conn->prepare("UPDATE police_station SET station_name = ?, station_address = ?, station_code = ?, police_station_head_name = ?, email_id = ?, phone_number = ?, postal_code = ?, district_id = ?, city_id = ?, password = ?, verification_code = ? WHERE id = ?");
    $updateStmt->bind_param("sssssssssssi", $updatedStationName, $updatedStationAddress, $updatedStationCode, $updatedHeadName, $updatedEmailId, $updatedPhoneNumber, $updatedPostalCode, $updatedDistrictId, $updatedCityId, $updatedPassword, $updatedVerificationCode, $stationId);

    if ($updateStmt->execute()) {
        echo "Data updated successfully.";
    } else {
        echo "Error updating data: " . $updateStmt->error;
    }

    // Close the update statement
    $updateStmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand" style="background:#1F1C17;">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-white" href="index.php">Menu</a>
        <!-- Navbar Search-->
        <h2 style="color:white" ;>Admin Panel</h2>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <!-- <h3>Admin Panel</h3> -->
                <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
            </div>
        </form>

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw text-white"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../index.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="../admin_edit_profile.php">Edit Profile</a></li>
                 
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../../assets/php/actions.php?logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">

                    <div class="nav">
                        <a class="nav-link" href="../index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link" href="../admin_edit_profile.php">
                            <div class="sb-nav-link-icon"><i class="fa-regular fa-pen-to-square"></i></div>
                            Edit Profile
                        </a>

                        <a class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapsePoliceStations" aria-expanded="false" aria-controls="collapsePoliceStations">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Police Stations
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>

                        <div class="collapse" id="collapsePoliceStations" aria-labelledby="headingPoliceStations" data-bs-parent="#sidenavAccordion">
                        <a class="nav-link" href="create_police_station.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                            Create Police Station
                        </a>
                        <a class="nav-link" href="edit_police_station.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                            Edit Police Station
                        </a>
                    </div>
                    <a class="nav-link" href="../reports/report.php">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-pen-to-square"></i></div>
                        Reports
                    </a>
                    </div>

                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <h1 class="mt-4"><i class="fa-regular fa-pen-to-square"></i>Edit Police Station Account</h1>
                    <?php //echo "station_code = ".$station_code;?>
                    <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                    <div class="row">
                        <div class="col-xl-12 col-md-6 mt-4">
                            <form method="post" action="edit_police_station.php">
                                <div class="mb-3">
                                    <label for="stationName">Station Name:</label>
                                    <input type="text" class="form-control" id="stationName" name="station_name" value="<?php echo $stationDetails['station_name']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stationAddress">Station Address:</label>
                                    <input type="text" class="form-control" id="stationAddress" name="station_address" value="<?php echo $stationDetails['station_address']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stationCode">Station Code:</label>
                                    <input type="text" class="form-control" id="stationCode" name="station_code" value="<?php echo $stationDetails['station_code']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="headName">Police Station Head Name:</label>
                                    <input type="text" class="form-control" id="headName" name="head_name" value="<?php echo $stationDetails['police_station_head_name']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="emailId">Email ID:</label>
                                    <input type="email" class="form-control" id="emailId" name="email_id" value="<?php echo $stationDetails['email_id']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phone_number" value="<?php echo $stationDetails['phone_number']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="postalCode">Postal Code:</label>
                                    <input type="text" class="form-control" id="postalCode" name="postal_code" value="<?php echo $stationDetails['postal_code']; ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="districtId">District:</label>
                                    <select class="form-control" id="districtId" name="district_id" required>
                                        <!-- Replace the following with PHP code to fetch district options from the database -->
                                        <option value="1" <?php echo ($stationDetails['district_id'] == 1) ? 'selected' : ''; ?>>District 1</option>
                                        <option value="2" <?php echo ($stationDetails['district_id'] == 2) ? 'selected' : ''; ?>>District 2</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="cityId">City:</label>
                                    <select class="form-control" id="cityId" name="city_id" required>
                                        <!-- Replace the following with PHP code to fetch city options from the database -->
                                        <option value="1" <?php echo ($stationDetails['city_id'] == 1) ? 'selected' : ''; ?>>City 1</option>
                                        <option value="2" <?php echo ($stationDetails['city_id'] == 2) ? 'selected' : ''; ?>>City 2</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="mb-3">
                                    <label for="verificationCode">Verification Code:</label>
                                    <input type="text" class="form-control" id="verificationCode" name="verification_code" value="<?php echo $stationDetails['verification_code']; ?>">
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="../assets/demo/chart-area-demo.js"></script>
    <script src="../assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>