<?php
include("..\includes\connect.php");

if (isset($_POST['insert_product'])) {
    // accessing the values from the form using post method
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $category = $_POST['category'];
    $image = $_FILES['product_image']['name'];
    $tmp_image = $_FILES['product_image']['tmp_name'];

    // checking empty condition
    if ($name == '' or $price == '' or $description == '' or $category == '' or $image == '') {
        echo "<script>alert('All fields are required')</script>";
        exit();
    } else {
        move_uploaded_file($tmp_image, "./product_images/$image");

        // inserting data into database
        $sql = "INSERT INTO product (product_name, product_description, price, category_name, product_image,date,status) VALUES ('$name', '$description', '$price', '$category', '$image',NOW(),'true')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<script>alert('Product inserted successfully')</script>";

        }
        header('location:../Admin/insert_product.php');

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="<KEY>" crossorigin="anonymous">
    <!-- font awesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css link -->
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            width: 50%;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container">
        <h1 class="text-center mb-5 text-white" style="font-family: 'Pacifico', cursive; background-color:#001f3f;"><i
                class="fas fa-laptop-code"></i> Computer Island <i class="fas fa-laptop-code"></i></h1>
        <h2 class="text-center mb-5">Insert Product</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- product name  -->
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name"
                    placeholder="Enter Product name" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="product_price">Product Price</label>
                <input type="number" class="form-control" id="product_price" name="product_price" required>
            </div>
            <!-- category -->

            <select name="category" class="form-select w-100 mb-2 " id="" class="category">
                <option value="">Select Category</option>
                <?php
                $select_cat = "SELECT * FROM categories";
                $result = mysqli_query($con, $select_cat);
                while ($row = mysqli_fetch_assoc($result)) {
                    $cat_name = $row['category_name'];
                    echo "<option value='$cat_name'> $cat_name</option>";
                }
                ?>
            </select>

            <!-- Product discription -->
            <div class="form-group">
                <label for="product_description">Product Description</label>
                <textarea class="form-control" id="product_description" name="product_description" rows="3"
                    required></textarea>
            </div>
            <!-- product image -->
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image" required>
            </div>

            <div class="form-group " style="margin-top: 20px; background-color: #001f3f;">
                <input type="submit" name="insert_product" class="btn btn-secondary text-white w-100"
                    value="Insert Product"></input>
            </div>
        </form>
        <!-- footer -->
        <div class="container text-white mt-5 p-3" style="background-color:#001f3f; width:100%">
            <div class="row">
                <div class="col-md-12 mt-5 text-center">
                    <p class="text-center">&copy; 2024 Computer Island. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>




















    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>