<?php
include("..\includes\connect.php");
include("../functions/common_function.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #001f3f;
            color: white;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #d1d1d1;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #004080;
            color: white;
            border-radius: 5px;
        }

        .card-header {
            background-color: #001f3f;
            color: white;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-warning {
            background-color: #ffc107;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .fa-solid {
            cursor: pointer;
        }
        .fa{
            margin-bottom: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 sidebar p-3">
                <div class="text-center mb-4">
                    <?php 
                    // user profile picture and name
                    $get_ip_add = get_client_ip();
                    $user_id = get_user_id_by_ip($get_ip_add);
                    $sql = "SELECT * FROM user WHERE ip_address='$get_ip_add' AND user_id='$user_id'";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['user_name'];
                    $profile_pic = $row['user_image'];
                    if ($profile_pic == "") {
                        $profile_pic = "https://via.placeholder.com/100";
                    }
                    echo "<img src='../user/user_image/$profile_pic' alt='Customer Profile' class='rounded-circle mb-2' style='width: 150px; height: 150px;'>";
                    echo "<h4>$name</h4>";
                    echo "<p>Welcome to your dashboard</p>";
                    ?>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php"><i class="fa fa-home me-2"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php?order"><i class="fa fa-shopping-cart me-2"></i>My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-heart me-2"></i>Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-user me-2"></i>Profile Settings</a>
                    </li>
                </ul>
                <div class="mt-auto">
                    <a class="nav-link" href="#" class="btn btn-outline-light"><i class="fa fa-money-bill-alt me-2 fs-4 fw-4"></i>Checkout</a>
                </div>
                <div class="mt-auto">
                    <a class="nav-link" href="#"><i class="fa fa-sign-out-alt me-2  fs-4 fw-4"></i>Logout</a>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="pt-3">
                <a href="index.php" class="text-decoration-none text-dark"><h2>Welcome to Computer Island</h2></a>
                    <p>Here is an overview of your recent activities.</p>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Total Orders</h5>
                                <p class="display-6"><?php echo get_total_orders(); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Total Price</h5>
                                <p class="display-6"><?php echo get_total_price_cart();?> BDT</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5>Wishlist Items</h5>
                                <p class="display-6">5</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Your Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                global $con;
                                $get_ip_add = get_client_ip();
                                $total_price = 0;
                                $sql = "SELECT * FROM cart WHERE ip_address ='$get_ip_add'";
                                $result = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($result);
                                if ($count > 0) {
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $product_id = $row['product_id'];
                                        $product_name = get_product_name_by_id($product_id);
                                        $qty = $row['quantity'];
                                        $price = get_product_price_by_id($product_id);
                                        $total = $qty * $price;
                                        $total_price += $total;
                                        $i++;
                                        echo "<tr>
                                            <td>$i</td>
                                            <td>$product_name</td>
                                            <td>$qty</td>
                                            <td>$price</td>
                                            <td>$total</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr>
                                        <td colspan='6'>Your cart is empty</td>
                                    </tr>";
                                }
                                echo "<tr>
                                    <td colspan='4' class='fs-4'>Total Price :</td>
                                    <td class='fs-4 fw-3'>$total_price BDT</td>
                                    <td></td>
                                </tr>";


                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>




    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>