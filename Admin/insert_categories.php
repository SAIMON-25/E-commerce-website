<?php
include('..\includes\connect.php');

if (isset($_POST['submit'])) {
    $cat_name = $_POST['category_name'];
    // select query
    $select_query = "SELECT * FROM categories WHERE category_name ='$cat_name'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo " <script> alert('The category is already presented in Database') </script>";
    } else {
        $insert_query = "INSERT INTO categories (category_name) VALUES ('$cat_name') ";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo " <script> alert('Category has been inserted successfully!') </script>";
        }
    }
}


?>



<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="md-2">
    <div class="form-group">
        <label for="category_name">Category Name</label>
        <input type="text" name="category_name" id="category_name" class="form-control" required>
    </div>
    <!-- <div class="form-group">
        <label for="category_description">Category Description</label>
        <textarea name="category_description" id="category_description" class="form-control" required></textarea>
    </div>   -->
    <div class="form-group">
        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
    </div>
</form>