<?php require_once('conn.php') ?>

<?php require_once('adminheader.php'); ?>
<?php require_once('admin_navbar.php'); ?>

<!-- style="background-color:#e8e6ea" -->






<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <?php require_once('admin_navbar.php'); ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 mt-4">
                        <h2>Create Admin Form</h2>
                        <form id="createAdminForm" method="post" action="create_admin.php">
                            <!-- Admin Name -->
                            <div class="form-group">
                                <label for="adminName">Name:</label>
                                <input type="text" class="form-control" name="Name" placeholder="Enter admin name" required>
                            </div>

                            <!-- Admin Username -->
                            <div class="form-group">
                                <label for="adminUsername">Username:</label>
                                <input type="text" class="form-control" name="Username" placeholder="Enter admin username" required>
                            </div>

                            <!-- Admin Password -->
                            <div class="form-group">
                                <label for="adminPassword">Password:</label>
                                <input type="password" class="form-control" name="Password" placeholder="Enter admin password" required>
                            </div>

                            <!-- Admin Email -->
                            <div class="form-group">
                                <label for="adminEmail">Email:</label>
                                <input type="email" class="form-control" name="Email" placeholder="Enter admin email" required>
                            </div>

                            <!-- Admin Role -->
                            <!-- <div class="form-group">
        <label for="adminRole">Admin Role:</label>
        <select class="form-control" name="adminRole" required>
          <option value="admin">Admin</option>
          <option value="superadmin">Super Admin</option>
        </select>
      </div> -->

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Create Admin</button>
                        </form>






                    </div>
                </main>
                <?php require_once('admin_footer.php'); ?>