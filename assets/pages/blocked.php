<?php
global $user;
?>
<div class="login">
    <div class="col-4 bg-white border rounded p-4 shadow-sm">
        <form>
            <div class="d-flex justify-content-center">
                <img class="mb-4" src="assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="45">
            </div>
            <h1 class="h5 mb-3 fw-normal">Hello, <?=$user['first_name'].' '.$user['last_name'].' ('.$user['email'].') '?>Your Account Is Blocked By Admin</h1>
            
            <div class="mt-3 d-flex justify-content-between align-items-center">
                <a href="assets/php/actions.php?logout" class="btn btn-danger" type="submit">Logout</a>
                <a href="index.php?enquiry" class="btn btn-primary" type="submit">Add Enquiry</a>
            </div>
        </form>
    </div>
</div>
