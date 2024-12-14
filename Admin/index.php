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

</head>

<body>

<div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block sidebar d-flex flex-column p-3 animated-sidebar">
        <!-- Profile Section -->
        <div class="profile-section mb-4 text-center">
          <img src="..\Admin\product_images\IMG_4197.jpg" class="rounded-circle" alt="User Image" style="width: 100px; height: 100px;">
          <h5>Saimanul hoque</h5>
          <p class="welcome-text">Welcome back!</p>
        </div>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <i class="fa fa-home"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?insert_categories">
              <i class="fa fa-folder-plus"></i> Insert Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?view_categories">
              <i class="fa fa-list"></i> View Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="insert_product.php">
              <i class="fa fa-plus-square"></i> Insert Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-th"></i> View Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-shopping-cart"></i> All Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-wallet"></i> All Payments
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fa fa-users"></i> User List
            </a>
          </li>
        </ul>
        <a class="nav-link logout-link mt-auto" href="#">
          <i class="fa fa-sign-out-alt"></i> Logout
        </a>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="main-content animated-content">
          <h2 class="mb-4">Welcome to the Dashboard</h2>
          <p class="lead">Select an option from the sidebar to manage your e-commerce platform.</p>
          <div class="row">
            <div class="col-md-6">
              <div class="card stats-card shadow">
                <div class="card-body">
                  <h5 class="card-title">Total Orders</h5>
                  <p class="card-text display-6">1,245</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card stats-card shadow">
                <div class="card-body">
                  <h5 class="card-title">Total Payments</h5>
                  <p class="card-text display-6">$50,842</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid mt-5">
          <?php 
          if(isset($_GET['insert_categories'])){
            include('insert_categories.php');
            }
          ?>
        </div>
      </main>
    </div>
  </div>



  <!-- php link -->
   

    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>