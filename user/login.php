<?php
session_start(); // Ensure session is started
include("../includes/connect.php");
include("../functions/common_function.php");

if (isset($_POST["login"])) {
    $name = trim($_POST["user_name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        echo "<script>alert('All fields are required!');</script>";
    } else {
        // Prevent SQL injection
        $name = mysqli_real_escape_string($con, $name);
        $email = mysqli_real_escape_string($con, $email);
        $password = mysqli_real_escape_string($con, $password);

        // Validate user credentials
        $sql = "SELECT * FROM user WHERE user_name='$name' AND user_email='$email' AND user_password='$password'";
        $result = mysqli_query($con, $sql);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            // Set session variables
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_name"] = $row["user_name"];
            $_SESSION["user_email"] = $row["user_email"];

            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.location.href='../Main/index.php';</script>";
        } else {
            echo "<script>alert('Invalid User Name, Email, or Password!');</script>";
            echo "<script>window.location.href='./registration.php';</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Island</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body style="background:#001f3f;">

    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <h1 class="text-center text-white" style="font-family: 'Pacifico', cursive;">
                    <i class="fas fa-laptop-code"></i> Computer Island <i class="fas fa-laptop-code"></i>
                </h1>
                <div class="col-xl-9">
                    <h2 class="text-white mb-4">User Login</h2>

                    <form action="" method="POST">
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 text-white">
                                <label for="user_name" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" required>
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <input type="submit" value="Login" class="btn btn-primary btn-lg" name="login">
                            <p class="text-white mt-3">Don't have an account yet? <a href="registration.php" class="text-white">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
