<?php
include("..\includes\connect.php");
include("../functions/common_function.php");
add_to_cart();
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="100">
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

  <style>
    .card {
      width: 300px;
      height: 450px;
      position: relative;
      overflow: hidden;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
      background: #ffffff;
      margin-bottom: 20px;
      object-fit: contain;
    }

    .card-img-top {
      width: 100%;
      height: 200px;
      object-fit: contain;
      transition: all 0.5s ease;
    }

    .card:hover {
      scale: 1.05;
      transition: all 0.5s ease;
    }

    .card-body {
      position: relative;
      background: #001f3f;
      border-radius: 0px 25px 7px 7px;
      transition: background 0.3s ease, background-position 0.3s ease;
      background-size: 300% 300%;
      color: white;
      padding: 20px;
      text-align: center;

    }


    .card-body:hover {
      background: radial-gradient(circle at var(--x, 20%) var(--y, 20%), #00bcd4, #001f3f);
      background-position: var(--x, 20%) var(--y, 20%);
    }




    .hover-effect {
      position: relative;
      background: #001f3f;
      transition: background 0.3s ease, background-position 0.3s ease;
      background-size: 300% 300%;
      color: white;
      overflow: hidden;

    }

    .hover-effect:hover {
      background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), #00bcd4, #001f3f);
      background-position: var(--x, 50%) var(--y, 50%);
    }

    .navbar {
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      padding: 10px;
    }
  </style>



</head>

<body onload="updateBangladeshTime()">

  <div class="container-fluid p-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg hover-effect">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="..\Images\logo.jpg" class="logo" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item" style="    color: whitesmoke;">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="..\user\registration.php">Register</a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="search.php" method="GET">

            <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
            <input type="submit" value="Search" class="btn btn-outline-secondary" name="search_data_product">
          </form>
          <div class="ms-3">
          <span style="text-align:center;font-size: 16px;font-weight: bold;" class="ms-auto">Total Price :
          <?php get_total_price(); ?> BDT</span>
          </div>
          <div class="icons">

            <a href="cart.php" class="text-dark">
              <i class="fa-solid fa-cart-shopping"><sup
                  style="color: white; font-size: 12px; margin-left: 5px;"><?php $cnt = get_cart_item_number();
                  echo "$cnt" ?></sup></i>
            </a>
            <a href="#" class="text-dark">
              <i class="fa-solid fa-bookmark"></i>
            </a>
            <a href="..\user\login.php" class="text-dark">
              <i class="fa-solid fa-user"></i>
            </a>
            <a href="#" class="text-dark">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Navbar End  -->

    <!-- welcome message -->
    <div class="welcome text-center mt-3">
      <p id="bangladesh-time"></p>
      <h1>Welcome to Computer Island</h1>
      <p>✨✨✨We provide the best computer products at the best prices✨✨✨</p>
      <a href="#" class=" btn btn-outline-dark" id="shop-btn">Shop Now</a>
    </div>


    <!-- sidebar and Products section -->
    <div class="container-fluid mt-5">
      <div class="row">
        <!-- sidebar -->
        <div class="sidebar col-md-3 hover-effect" style="border-radius:0px 25px 0px 0px;">
          <ul class="navbar-nav me-auto text-center">
            <li class="nav-item text-light">
              <div class="text-center mt-3 pb-2" style="border-bottom: 3px solid white;">
                <h3 class="m-auto">Categories</h3>
              </div>
            </li>
            <!-- <hr class="bg-light"> -->
            <?php

            $query = "Select * from categories";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              $category_id = $row['category_id'];
              $category_name = $row['category_name'];
              echo "<li class='nav-item'><a href='index.php?category_name=$category_name' class='nav-link'>$category_name</a></li>
              <hr class='bg-secondary'>
              ";
            }
            ?>


          </ul>
        </div>
        <!-- Products section -->
        <!-- <div class="col-md-9"> -->

        <!-- row  -->
        <!-- <div class="row">
           <?php
           $products_per_page = 9;
           $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
           if ($page < 1)
             $page = 1;

           $offset = ($page - 1) * $products_per_page;

           $total_products_query = "SELECT COUNT(*) AS total FROM product";
           $result_total = mysqli_query($con, $total_products_query);

           $total_products_row = mysqli_fetch_assoc($result_total);
           $total_products = $total_products_row['total'];

           $total_pages = ceil($total_products / $products_per_page);

           $select_product = "SELECT * FROM product order by rand() LIMIT $products_per_page OFFSET $offset";
           $result = mysqli_query($con, $select_product);

           while ($row = mysqli_fetch_assoc($result)) {
             $name = $row['product_name'];
             $description = $row['product_description'];
             $image = $row['product_image'];
             $price = $row['price'];

             echo "
        <div class='col-md-4'>
          <div class='card'>
            <img src='../Admin/product_images/$image' class='card-img-top' alt='...' >
            <div class='card-body'>
              <h5 class='card-title'>$name</h5>
              <p class='card-text'>$description</p>
              <p class='card-text fw-bold'>Price: $price<span class='fw-bolder'>&#2547;</span></p>
              <a href='#' class='btn btn-primary me-2'>Add to cart</a>
              <a href='#' class='btn btn-secondary'>View Detail</a>
            </div>
          </div>
        </div>";
           }
           ?> 
          </div> -->
        <!-- Pagination -->
        <!-- <nav class="m-4">
            <ul class="pagination justify-content-center">
              <?php if ($page > 1): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page)
                  echo 'active'; ?>">
                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>

              <?php if ($page < $total_pages): ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
              <?php endif; ?>
            </ul>
          </nav> -->

        <!-- </div> -->


        <div class="col-md-9">
          <!-- Products Row -->
          <div class="row">
            <?php
            get_Products();
            get_product_by_category();

            ?>
          </div>

          <!-- Pagination -->
          <?php
          display_pagination();
          ?>
        </div>



      </div>

    </div>
  </div>
  <!-- footer -->
  <div class="footer  text-light container-fluid p-0 m-0 hover-effect" id="contact">
    <div class="row p-0 m-0">
      <div class="col-md-4">
        <h4>About Us</h4>
        <p>We are a leading computer manufacturer and supplier of high-quality products at the best prices. We
          offer a
          wide range of products including laptops, desktops, gadgets, and accessories.</p>
      </div>
      <div class="col-md-4">
        <h4>Contact Us</h4>
        <p>Address: University of Chittagong, Bangladesh</p>
        <p>Phone: +8801824-323912</p>
        <p>Email: saimon.csecu@gmail.com</p>
      </div>
      <div class="col-md-4">
        <h4>Follow Us</h4>
        <div class="icons">
          <!-- social media icons -->
          <a href="#" class="text-dark"> <i class="fa-brands fa-facebook"></i></a>
          <!-- instagram -->
          <a href="#" class="text-dark">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#" class="text-dark">
          </a>
          <a href="#" class="text-dark">
          </a>
          <!-- linkedin -->
          <a href="#" class="text-dark">
            <i class="fa-brands fa-linkedin"></i>
          </a>
          <!--youtube  -->
          <a href="#" class="text-dark">
            <i class="fa-brands fa-youtube"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="text-center p-3">
      <p>© 2021 Computer Island. All rights reserved.</p>
    </div>
  </div>








  <script>

    document.querySelectorAll('.card-body').forEach(cardBody => {
      cardBody.addEventListener('mousemove', e => {
        const rect = cardBody.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        cardBody.style.setProperty('--x', `${x}%`);
        cardBody.style.setProperty('--y', `${y}%`);
      });
    });


    document.querySelectorAll('.hover-effect').forEach(element => {

      element.addEventListener('mousemove', e => {
        const rect = element.getBoundingClientRect();
        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;
        element.style.setProperty('--x', `${x}%`);
        element.style.setProperty('--y', `${y}%`);
      });
    });
    window.addEventListener('load', () => {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('category') || urlParams.has('page')) {
        const productList = document.querySelector('.row'); // Adjust to match your product container
        if (productList) {
          productList.scrollIntoView({
            behavior: 'smooth'
          });
        }
      }
    });
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          window.scrollTo({
            top: target.offsetTop - 50, // Offset to account for fixed headers
            behavior: 'smooth'         // Smooth scrolling
          });
        }
      });
    });

    // time function
    function updateBangladeshTime() {
            const options = {
                timeZone: "Asia/Dhaka",
                weekday: "long", // Day name
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false
            };
            const now = new Date().toLocaleString("en-US", options);
            document.getElementById("bangladesh-time").innerText = now;
          }
          setInterval(updateBangladeshTime, 1000);
  </script>
  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>

</html>