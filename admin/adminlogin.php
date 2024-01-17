<?php require_once('conn.php') ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["inputEmail"];
        $password = $_POST["inputPassword"];
    
        // To enhance security, you should hash the password and compare it with the hashed value stored in the database.
        // This is a simple example, and you should use a secure hashing algorithm like password_hash().
    
        // This query assumes you have a 'users' table with 'email' and 'password' columns.
        $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // Authentication successful
            // Redirect to the dashboard or another page
            header("Location: index.php");
            exit();
        } else {
            // Authentication failed
            $error_message = "Invalid email or password";
        }
    }
    
    //$conn->close();
    ?>
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #222471">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header justify-content-center text-center d-flex"> <img class="mb-4" src="../assets/images/Rajasthan-Police-RAJ-Police.webp" alt="" height="50"></div>
                                <div class="card-body">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" required />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Password" required />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="admin_forget_password.php">Forgot Password?</a>
                                            <button class="btn btn-success" type="submit">Login</button>
                                        </div>
                                    </form>
                                    <?php if (isset($error_message)) : ?>
                                        <div class="alert alert-danger mt-3" role="alert">
                                            <?php echo $error_message; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
