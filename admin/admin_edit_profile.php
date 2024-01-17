<?php require_once('conn.php') ?>
<?php 
// Fetch data from the 'admin' table
$sql = "SELECT * FROM admin where id=1;"; // Assuming you want to fetch a specific admin by ID, adjust the query accordingly
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $username = $row['username'];
    $email = $row['email'];
    // Assuming you have a hashed password stored in the database
    $password = $row['password'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];

    // Assuming you have a hashed password stored in the database
    //$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    if($newPassword==null)
    {
        $updatedpassword=$password;
    }
    else{
        $updatedpassword=$newPassword;
    }

    // Update the admin table
    $updateSql = "UPDATE admin SET name = '$name', username = '$username', email = '$email', password = '$updatedpassword' WHERE id = 1";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
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
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <!-- style="background-color:#e8e6ea" -->
    <nav class="sb-topnav navbar navbar-expand" style="background:#1F1C17;">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3 text-white" href="index.php">Menu</a>
        <!-- Navbar Search-->
        <h2 style="color:white";>Admin Panel</h2>
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
                <li><a class="dropdown-item" href="index.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="admin_edit_profile.php">Edit Profile</a></li>
                    <!-- <li><a class="dropdown-item" href="#!">Settings</a></li> -->
                    <!-- <li><a class="dropdown-item" href="#!">Activity Log</a></li> -->
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../assets/php/actions.php?logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    
                <div class="nav">
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link" href="admin_edit_profile.php">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-pen-to-square"></i></div>
                        Edit Profile
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePoliceStations" aria-expanded="false" aria-controls="collapsePoliceStations">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Police Stations
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>

                    <div class="collapse" id="collapsePoliceStations" aria-labelledby="headingPoliceStations" data-bs-parent="#sidenavAccordion">
                        <a class="nav-link" href="policestation/create_police_station.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                            Create Police Station
                        </a>
                        <a class="nav-link" href="policestation/edit_police_station.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-angle-right"></i></div>
                            Edit Police Station
                        </a>
                    </div>
                    <a class="nav-link" href="reports/report.php">
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
                    <h1 class="mt-4"><i class="fa-regular fa-pen-to-square"></i> Edit Profile</h1>
                    <!-- <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                    <div class="row">
                        <div class="col-xl-12 col-md-6 mt-4">
                            <form method="post" action="admin_edit_profile.php">
                                <div class="mb-3">
                                    <label for="exampleInputName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="exampleInputName" placeholder="Enter your name" value="<?php echo $name; ?>" name="name">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="exampleInputUsername" placeholder="Enter your username" value="<?php echo $username; ?>" name="username">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter your email" name="email" value="<?php echo $email; ?>">
                                   
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputPassword" class="form-label">Change Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword" placeholder="Enter new password" name="new_password">
                                    <!-- It's not recommended to pre-fill the password field for security reasons -->
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
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>





</body>

</html>