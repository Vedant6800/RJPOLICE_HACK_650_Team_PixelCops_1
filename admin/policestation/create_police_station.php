<?php
require_once('../conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $stationName = $_POST['station_name'];
    $stationAddress = $_POST['station_address'];
    $stationCode = $_POST['station_code'];
    $headName = $_POST['headName'];
    $emailId = $_POST['email_id'];
    $phoneNumber = $_POST['phone_number'];
    $postalCode = $_POST['postal_code'];
    $districtId = $_POST['district_id'];
    $cityId = $_POST['city_id'];
    $password = $_POST['password'];
    $verificationCode = $_POST['verification_code'];

    // Insert data into the police_station table
    $stmt = $conn->prepare("INSERT INTO police_station (station_name, station_address, station_code, police_station_head_name, email_id, phone_number, postal_code, district_id, city_id, password, verification_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $stationName, $stationAddress, $stationCode, $headName, $emailId, $phoneNumber, $postalCode, $districtId, $cityId, $password, $verificationCode);

    if ($stmt->execute()) {
        // Insert data into the users table
        $userStmt = $conn->prepare("INSERT INTO users (first_name, last_name, gender, email, username, password, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $defaultProfilePic = 'default_profile.jpg';
        $gender = '3'; // '3' corresponds to 'others' in the users table

        // Insert data into the users table
$userStmt = $conn->prepare("INSERT INTO users (first_name, last_name, gender, email, username, password, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
$defaultProfilePic = 'default_profile.jpg';
$gender = 3; // '3' corresponds to 'others' in the users table
$last_name = NULL;

$userStmt->bind_param("ssissss", $stationName, $last_name, $gender, $emailId, $stationCode, $password, $defaultProfilePic);

if ($userStmt->execute()) {
    echo "Data inserted successfully into both tables.";
} else {
    echo "Error inserting data into users table: " . $userStmt->error;
}
    }
}

// Fetch district options from the database
$districtOptions = "";
$queryDistrict = "SELECT id, district_name FROM district";
$resultDistrict = $conn->query($queryDistrict);

while ($rowDistrict = $resultDistrict->fetch_assoc()) {
    $districtOptions .= "<option value='{$rowDistrict['id']}'>{$rowDistrict['district_name']}</option>";
}

// Fetch city options from the database
$cityOptions = "";
$queryCity = "SELECT id, city_name FROM city";
$resultCity = $conn->query($queryCity);

while ($rowCity = $resultCity->fetch_assoc()) {
    $cityOptions .= "<option value='{$rowCity['id']}'>{$rowCity['city_name']}</option>";


}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />x
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
                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li> -->
                    <!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
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

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePoliceStations" aria-expanded="false" aria-controls="collapsePoliceStations">
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

                        <!-- <a class="nav-link" href="login.html">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Create New Admin
                    </a> -->

                        <!-- <a class="nav-link" href="register.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                        Register
                    </a>

                    <a class="nav-link" href="password.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                        Forgot Password
                    </a>

                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>

                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a> -->
                    </div>

                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-4">
                    <h1 class="mt-4"><i class="fa-regular fa-pen-to-square"></i>Create Police Station Account</h1>
                    <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                    <div class="row">
                        <div class="col-xl-12 col-md-6 mt-4">
                            <form method="post" action="create_police_station.php">
                                <div class="mb-3">
                                    <label for="stationName">Station Name:</label>
                                    <input type="text" class="form-control" id="stationName" name="station_name" placeholder="Enter station name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stationAddress">Station Address:</label>
                                    <input type="text" class="form-control" id="stationAddress" name="station_address" placeholder="Enter station address" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stationCode">Station Code:</label>
                                    <input type="text" class="form-control" id="stationCode" name="station_code" placeholder="Enter station code" required>

                                </div>

                                <div class="mb-3">
                                    <label for="headName">Police Station Head Name:</label>
                                    <input type="text" class="form-control" id="headName" placeholder="Enter police station head name" name="headName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="emailId">Email ID:</label>
                                    <input type="email" class="form-control" id="emailId" name="email_id" placeholder="Enter email ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phoneNumber">Phone Number:</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phone_number" placeholder="Enter phone number" required>
                                </div>
                                <div class="mb-3">
                                    <label for="postalCode">Postal Code:</label>
                                    <input type="text" class="form-control" id="postalCode" name="postal_code" placeholder="Enter postal code" required>
                                </div>

                                <div class="mb-3">
                                    <label for="districtId">District:</label>
                                    <select class="form-control" id="districtId" name="district_id" required>
                                        <?php
                                        echo $districtOptions;

                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="cityId">City:</label>
                                    <select class="form-control" id="cityId" name="city_id" required>
                                        <?php echo $cityOptions; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="verificationCode">Verification Code:</label>
                                    <input type="text" class="form-control" id="verificationCode" name="verification_code" placeholder="Enter verification code" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
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