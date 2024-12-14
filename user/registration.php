<?php
include("..\includes\connect.php");
include("../functions/common_function.php");


// if (isset($_POST['register'])) {
//     $name = $_POST['user_name'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $mobileno = $_POST['mobile'];
//     $image = $_FILES['user_image']['name'];
//     $tmp_image = $_FILES['user_image']['tmp_name'];

//     // check if email already exists
//     $sql = "SELECT * FROM user WHERE user_email='$email'";
//     $result = mysqli_query($con, $sql);
//     if (mysqli_num_rows($result) > 0) {
//         echo "<script>alert('Email already exists')</script>";
//         exit();
//     }

//     // check if password and confirm password are same
//     if ($password != $_POST['confirmPassword']) {
//         echo "<script>alert('Password and Confirm Password are not same')</script>";
//         exit();
//     }

    

//     if ($name == '' or $email == '' or $password == '' or $mobileno == '' or $image == '') {
//         echo "<script>alert('All fields are required')</script>";
//         exit();
//     } else {
//         move_uploaded_file($tmp_image, "./user_image/$image");

//         // inserting data into database
//         $sql = "INSERT INTO user (user_name,user_email , user_password, user_image, user_mobile) VALUES ('$name', '$email', '$password','$image','$$mobileno')";
//         $result = mysqli_query($con, $sql);
//         if ($result) {
//             echo "<script>alert('Product inserted successfully')</script>";
//             header("location:login.php");
//             exit();
//         }
//     }
// }


session_start(); 

if (isset($_POST['register'])) {
    $name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mobileno = $_POST['mobile'];
    $image = $_FILES['user_image']['name'];
    $tmp_image = $_FILES['user_image']['tmp_name'];
    $ip_address = get_client_ip();

    // Check if email already exists
    $sql = "SELECT * FROM user WHERE user_email='$email'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Email already exists";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // // Check if password and confirm password are the same
    // if ($password != password_hash($_POST['confirmPassword'], PASSWORD_DEFAULT)) {
    //     $_SESSION['message'] = "Password and Confirm Password are not the same";
    //     header("Location: " . $_SERVER['PHP_SELF']);
    //     exit();
    // }

    // Check if all fields are filled
    if ($name == '' || $email == '' || $password == '' || $mobileno == '' || $image == '') {
        $_SESSION['message'] = "All fields are required";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        move_uploaded_file($tmp_image, "./user_image/$image");

        // Insert data into database
        $sql = "INSERT INTO user (ip_address,user_name, user_email, user_password, user_image, user_mobile) 
                VALUES ('$ip_address','$name', '$email', '$password', '$image', '$mobileno')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $_SESSION['message'] = "Registration successful! Please log in.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: Could not insert data.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// Show alert message if set
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear message after displaying
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

<body>


    <section class="vh-100" style="background-color: #001f3f;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <h1 class="text-center text-white" style="font-family: 'Pacifico', cursive; background-color:#001f3f;">
                    <i class="fas fa-laptop-code"></i> Computer Island <i class="fas fa-laptop-code"></i></h1>
                <div class="col-xl-9">
                    <h2 class="text-white mb-4">User Registration</h2>



                    <?php
                    
                    ?>




                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6 text-white">
                                <label for="Name" class="form-label">User Name</label>
                                <input type="text" name="user_name" class="form-control" id="user_name" required autocomplete="off">
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required autocomplete="off">
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required autocomplete="off">
                            </div>
                            <div class="col-md-6 text-white">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword"
                                    required>
                            </div>
                            <!-- Mobile -->
                            <div class="col-md-6 text-white">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile" required autocomplete="off">
                            </div>
                            <!-- user_image -->
                            <div class="col-md-6 text-white">
                                <label for="user_image" class="form-label">User Image</label>
                                <input type="file" name="user_image" class="form-control" id="user_image" required autocomplete="off">
                            </div>
                        </div>

                        <!-- submit button -->
                        <div class="col-12 text-center mt-4">
                            <input type="submit" value="registration" class="btn btn-primary btn-lg" name="register">
                            <p class="text-white mt-3">Already have an account? <a href="login.php"
                                    class="text-white">Login</a></p>
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