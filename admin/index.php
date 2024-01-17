<?php require_once('conn.php') ?>
<?php include('../assets/php/functions.php');
include('adminfunctions.php');
?>
<?php $userData = getUsers(); ?>
<?php $countUsers = countUsers(); ?>
<?php $policeStationCount = countPoliceStations(); ?>
<?php $postCount = countPosts(); ?>
<?php $blockedUserCount = countBlockedUsers(); ?>
<?php require_once('adminheader.php'); ?>
<?php require_once('admin_navbar.php'); ?>

<!-- style="background-color:#e8e6ea" -->






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
                <!-- <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol> -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <?php

                        ?>
                        <div class="card bg-white text-white mb-4 border">
                            <div class="card-body" style="background-color:blue">
                                <h3><?php echo $countUsers; ?></h3>
                                Total Users
                            </div>

                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-white text-white mb-4 border">

                            <div class="card-body" style="background-color:orange">
                                <h3> <?php echo $policeStationCount; ?></h3>
                                Total Police Stations
                            </div>

                            <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-white text-white mb-4 border">
                            <div class="card-body" style="background-color:indianred">
                                <h3><?php echo $postCount; ?></h3>
                                Total Posts
                            </div>
                            <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-white text-white mb-4 border">
                            <div class="card-body" style="background-color:#32CD32">
                                <h3><?php echo $blockedUserCount; ?></h3>
                                Blocked Accounts
                            </div>
                            <!-- <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div> -->
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Users Table
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($userData as $user) : ?>
                                    <tr>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['email']; ?></td>
                                        <td>
                                            <?php
                                            if ($user['ac_status'] == 1) {
                                                echo '<button class="btn btn-danger blockBtn">Block</button>';
                                            } else if ($user['ac_status'] == 2) {
                                                echo '<button class="btn btn-success blockBtn">UnBlock</button>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                <!-- Add other rows if needed -->
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </main>
        <?php require_once('admin_footer.php'); ?>