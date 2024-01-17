<div class="login">
    <div class="col-12 col-md-6 mx-auto bg-white border rounded p-4 shadow-sm">
        <form method="post" action="assets/php/actions.php?login">
            <div class="text-center mb-4">
                <img class="mb-4" src="assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="45">
                <h1 class="h5 fw-normal">Please sign in</h1>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="username_email" value="<?=showFormData('username_email')?>" class="form-control rounded-0" placeholder="Username/Email">
                <label for="floatingInput">Username/Email</label>
                <?=showError('username_email')?>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <?=showError('password')?>
                <?=showError('checkuser')?>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">Sign in</button>
                <a href="?signup" class="btn btn-outline-secondary">Create New Account</a>
            </div>

            <div class="mt-3 text-center">
                <a href="?forgotpassword&newfp" class="text-decoration-none">Forgot password?</a>
            </div>
        </form>

        <!-- "Login as Admin" link -->
        <div class="text-center mt-3">
            <a href="admin/adminlogin.php" class="text-decoration-none">Login as Admin</a>
        </div>
        <!-- <div class="text-center mt-3">
            <a href="admin/policestation/ps_login.php" class="text-decoration-none">Login as Police Station</a>
        </div> -->
    </div>
</div>
