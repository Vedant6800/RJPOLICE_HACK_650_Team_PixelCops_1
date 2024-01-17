<div class="login">
    <div class="col-4 bg-white border rounded p-4 shadow-sm">
        <?php
        // if(isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])){
        //     $action = 'verifycode';
        if (isset($_SESSION['forgot_email']) && isset($_SESSION['auth_temp'])) {
            $action = 'changepassword';
        } else {
            $action = 'forgotpassword';
        }
        ?>
        <form method="post" action="assets/php/actions.php?<?= $action ?>">
            <div class="d-flex justify-content-center">


            </div>
            <h1 class="h5 mb-3 fw-normal">Forgot Your Password ?</h1>
            <?php
            if ($action == 'forgotpassword'){
            ?>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">enter your email</label>
                </div>
                <?= showError('email') ?>

                <br>
                <button class="btn btn-primary" type="submit">Enter new password</button>
            <?php
            }
            ?>
            <?php
            if ($action == 'changepassword') {
            ?>
                <p>Enter your new password - <?= $_SESSION['forgot_email'] ?></p>
                <div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">new password</label>
                </div>
                <?= showError('password') ?>

                <br>
                <button class="btn btn-primary" type="submit">Change Password</button>


            <?php
            }
            ?>

            <!-- <div class="form-floating">
                <input type="email" name="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">Enter your email</label>
                </div> -->

            <!-- <div class="form-floating mt-1">
                    <input type="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">New password</label>
                </div> -->
            <!-- <p>Enter 6 Digit Code Sended to You</p>
                <div class="form-floating mt-1">

                    <input type="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div> -->
            <!-- <div class="mt-3 d-flex justify-content-between align-items-center"> -->
            <!-- <button class="btn btn-primary" type="submit">Send Verification Code</button> -->
            <!-- <button class="btn btn-primary" type="submit">Change Password</button> -->
            <!-- <button class="btn btn-primary" type="submit">Verify Code</button> -->





            <!-- </div> -->
            <br>
            <br>

            <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Go Back
                To
                Login</a>
        </form>
    </div>
</div>