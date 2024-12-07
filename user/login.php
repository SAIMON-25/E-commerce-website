<?php
include("..\includes\connect.php");
include("../functions/common_function.php");


if(isset($_POST["login"])){
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    if($name == "" or $password == "" or $email == ''){
        echo" <script> alert('all field is required!')</script>";
    }
    else{
        $sql = "SELECT * FROM user WHERE user_name='$name' and user_email='$email' and user_password='$password'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) == 0){
            header("..\user\registration.php");
        }else{
            header("..\user\user_page.php");
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
    <!-- bootstrap cdns -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="style.css">

</head>

<body style="background:#001f3f;">

    <!-- login page -->
    

    <section class="vh-100" style="background-color: #001f3f;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <h1 class="text-center text-white" style="font-family: 'Pacifico', cursive; background-color:#001f3f;">
                    <i class="fas fa-laptop-code"></i> Computer Island <i class="fas fa-laptop-code"></i></h1>
                <div class="col-xl-9">
                    <h2 class="text-white mb-4">User Login</h2>

                    <form action="" method="POST">
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 text-white">
                                <label for="Name" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required autocomplete="off">
                            </div>
                            <div class=" col-md-6 text-white">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required autocomplete="off">
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword"
                                    required>
                            </div>

                        <!-- submit button -->
                        <div class="col-12 text-center mt-4">
                            <input type="submit" value="Login" class="btn btn-primary btn-lg" name="register">
                            <p class="text-white mt-3">Don't have an account yet ? <a href="registration.php"
                                    class="text-white">Register</a></p>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>