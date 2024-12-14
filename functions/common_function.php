<?php

include("..\includes\connect.php");



// Function to fetch and display paginated products
function get_Products()
{
    global $con;

    if (!isset($_GET['category_name'])) {
        $products_per_page = 9; // Set a default or global value
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $offset = ($page - 1) * $products_per_page;
        $query = "SELECT * FROM product ORDER BY RAND() LIMIT $products_per_page OFFSET $offset";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row["product_id"];
            $name = $row['product_name'];
            $description = $row['product_description'];
            $image = $row['product_image'];
            $price = $row['price'];

            echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='../Admin/product_images/$image' class='card-img-top' alt='Product Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>$name</h5>
                                <p class='card-text overflow-hidden'>$description</p>
                                <p class='card-text fw-bold'>Price: $price<span class='fw-bolder'>&#2547;</span></p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary me-2'>Add to cart</a>
                                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View Detail</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}



function get_product_by_category()
{
    global $con;

    if (isset($_GET['category_name'])) {
        $category_name = $_GET['category_name'];
        $products_per_page = 9;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $products_per_page;
        $query = "SELECT * FROM product WHERE category_name = '$category_name' ORDER BY RAND() LIMIT $products_per_page OFFSET $offset";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['product_name'];
            $description = $row['product_description'];
            $image = $row['product_image'];
            $price = $row['price'];
            $product_id = $row['product_id'];

            echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='../Admin/product_images/$image' class='card-img-top' alt='Product Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>$name</h5>
                                <p class='card-text'>$description</p>
                                <p class='card-text fw-bold'>Price: $price<span class='fw-bolder'>&#2547;</span></p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary me-2'>Add to cart</a>
                                 <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View Detail</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}

// search data
function search_data()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $value = $_GET['search_data'];
        $products_per_page = 9;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $products_per_page;
        $query = "SELECT * FROM product WHERE product_name LIKE '%$value%' ORDER BY RAND() LIMIT $products_per_page OFFSET $offset";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['product_name'];
            $description = $row['product_description'];
            $image = $row['product_image'];
            $price = $row['price'];
            $product_id = $row['product_id'];

            echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                            <img src='../Admin/product_images/$image' class='card-img-top' alt='Product Image'>
                            <div class='card-body'>
                                <h5 class='card-title'>$name</h5>
                                <p class='card-text'>$description</p>
                                <p class='card-text fw-bold'>Price: $price<span class='fw-bolder'>&#2547;</span></p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary me-2'>Add to cart</a>
                                                               <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View Detail</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}




// Function to generate and display pagination
function display_pagination()
{
    global $con;
    $products_per_page = 9; // Set a default or global value
    $current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    if ($current_page < 1)
        $current_page = 1;

    // Get total number of products
    $query = "SELECT COUNT(*) AS total FROM product";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $total_products = $row['total'];

    $total_pages = ceil($total_products / $products_per_page);

    echo '<nav class="m-4"><ul class="pagination justify-content-center">';

    // Previous button
    if ($current_page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
    }

    // Page numbers
    for ($i = 1; $i <= $total_pages; $i++) {
        $active_class = ($i == $current_page) ? 'active' : '';
        echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }

    // Next button
    if ($current_page < $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
    }

    echo '</ul></nav>';
}

// get ip address 

function get_client_ip()
{
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if (isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if (isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

//  add to cart function
function add_to_cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $product_id = $_GET['add_to_cart'];
        $ip_address = get_client_ip(); //::1 ip address for local host
        $query = "SELECT * FROM cart WHERE ip_address='$ip_address' AND product_id='$product_id'";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            echo "<script>alert('Product already added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $query = "INSERT INTO cart(product_id,ip_address,quantity) VALUES('$product_id','$ip_address',1)";
            mysqli_query($con, $query);
            echo "<script>alert('Product added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

// function to get cart item number
function get_cart_item_number()
{
    global $con;
    $ip_address = get_client_ip(); //::1 ip address for local host
    $query = "SELECT * FROM cart WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    return $count;
}



// total price of cart
// function get_total_price()
// {
//     global $con;
//     $total_price = 0;
//     $ip_address = get_client_ip(); // ::1 IP address for localhost
//     $query = "SELECT product_id from cart WHERE ip_address='$ip_address'";
//     $result = mysqli_query($con, $query);
//     while ($row = mysqli_fetch_array($result)) {
//         $product_id = $row['product_id'];
//         $query1 = "SELECT price from product WHERE product_id='$product_id'";
//         $result2 = mysqli_query($con, $query1);
//         while ($row2 = mysqli_fetch_array($result2)) {
//             if (!isset($row['product_id'])) {
//                 continue; // Skip this iteration if product_id is missing
//             }
//             $product_id = $row2["product_id"];
//             $price = $row2["price"];
//             $query2 = "SELECT quantity from cart WHERE product_id='$product_id' AND ip_address='$ip_address'";
//             $result3 = mysqli_query($con, $query2);
//             while ($row3 = mysqli_fetch_array($result3)) {
//                 $quantity = $row3["quantity"];
//                 $total_price += $price * $quantity;
//             }
//         }
//     }

//     echo $total_price;
// }



function get_total_price()
{
    global $con;
    $total_price = 0;
    $ip_address = get_client_ip(); // ::1 IP address for localhost

    // Fetch all products from cart associated with the current IP
    $query = "SELECT product_id FROM cart WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }

    while ($row = mysqli_fetch_array($result)) {
        // Check if product_id exists
        if (!isset($row['product_id'])) {
            continue; // Skip this iteration if product_id is missing
        }

        $product_id = $row['product_id'];

        // Fetch price of the product
        $query2 = "SELECT price FROM product WHERE product_id='$product_id'";
        $result2 = mysqli_query($con, $query2);

        if (!$result2) {
            die("Query Failed: " . mysqli_error($con));
        }

        while ($row2 = mysqli_fetch_array($result2)) {
            if (!isset($row2['price'])) {
                continue;
            }

            $price = $row2["price"]; // Corrected: Ensure price is fetched properly

            // Fetch quantity of the product from the cart
            $query3 = "SELECT quantity FROM cart WHERE product_id='$product_id' AND ip_address='$ip_address'";
            $result3 = mysqli_query($con, $query3);

            if (!$result3) {
                die("Query Failed: " . mysqli_error($con));
            }

            while ($row3 = mysqli_fetch_array($result3)) {
                if (!isset($row3['quantity'])) {
                    continue;
                }

                $quantity = $row3["quantity"];
                $total_price += $price * $quantity; // Ensure price is treated as an integer
            }
        }
    }

    echo $total_price;
}

function get_product_name_by_id($product_id) {
    global $con;  // Make sure you have a global database connection ($con)

    // Query to get product name
    $query = "SELECT product_name FROM product WHERE product_id = '$product_id' LIMIT 1";
    $result = mysqli_query($con, $query);

    // Check if the query was successful and if the product exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['product_name'];  // Return the product name
    } else {
        return "Product Not Found";  // Return a default message if product doesn't exist
    }
}


function get_product_price_by_id($product_id) {
    global $con;  // Make sure you have a global database connection ($con)

    // Query to get product price
    $query = "SELECT price FROM product WHERE product_id = '$product_id' LIMIT 1";
    $result = mysqli_query($con, $query);

    // Check if the query was successful and if the product exists
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['price'];  // Return the product price
    } else {
        return 0;  // Return 0 if product doesn't exist
    }
}

// function to get total price of cart
function get_total_price_cart()
{
    global $con;
    $total_price = 0;
    $ip_address = get_client_ip(); // ::1 IP address for localhost

    // Fetch all products from cart associated with the current IP
    $query = "SELECT product_id FROM cart WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }

    while ($row = mysqli_fetch_array($result)) {
        // Check if product_id exists
        if (!isset($row['product_id'])) {
            continue; // Skip this iteration if product_id is missing
        }

        $product_id = $row['product_id'];

        // Fetch price of the product
        $query2 = "SELECT price FROM product WHERE product_id='$product_id'";
        $result2 = mysqli_query($con, $query2);

        if (!$result2) {
            die("Query Failed: " . mysqli_error($con));
            }
            while ($row2 = mysqli_fetch_array($result2)) {
                if (!isset($row2['price'])) {
                    continue;
                }

                $price = $row2["price"]; // Corrected: Ensure price is fetched properly

                // Fetch quantity of the product from the cart
                $query3 = "SELECT quantity FROM cart WHERE product_id='$product_id' AND ip_address='$ip_address'";
                $result3 = mysqli_query($con, $query3);

                if (!$result3) {
                    die("Query Failed: " . mysqli_error($con));
                }

                while ($row3 = mysqli_fetch_array($result3)) {
                    if (!isset($row3['quantity'])) {
                        continue;
                    }

                    $quantity = $row3["quantity"];
                    $total_price += $price * $quantity; // Ensure price is treated as an integer
                }
            }
        }

    return $total_price;
}


// total orders of cart
function get_total_orders()
{
    global $con;
    $ip_address = get_client_ip(); // ::1 IP address for localhost
    $query = "SELECT * FROM cart WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    return $count;
}

// show all cart items
function show_cart_items()
{
    global $con;
    $ip_address = get_client_ip(); // ::1 IP address for localhost
    $query = "SELECT * FROM cart WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $query1 = "SELECT * FROM product WHERE product_id='$product_id'";
        $result1 = mysqli_query($con, $query1);
        while ($row1 = mysqli_fetch_array($result1)) {
            $product_name = $row1['product_name'];
            $price = $row1['price'];
            $quantity = $row['quantity'];
            $total_price = $price * $quantity;
            echo "<tr>
                    <td>$product_name</td>
                    <td>$price</td>
                    <td>$quantity</td>
                    <td>$total_price</td>
                    <td><a href='cart.php?remove=$product_id' class='btn btn-danger'>Remove</a></td>
                </tr>";
        }
    }   
}

// get user by ip address
function get_user_by_ip()
{
    global $con;
    $ip_address = get_client_ip(); // ::1 IP address for localhost
    $query = "SELECT * FROM users WHERE ip_address='$ip_address'";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['user_id'];
    } else {
        return false;
    }
}

function get_user_id_by_ip($get_ip_add){
    global $con;
    $ip_address = $get_ip_add; // ::1 IP address for localhost
    $query = "SELECT * FROM user WHERE ip_address='$ip_address' LIMIT 1";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['user_id'];
}