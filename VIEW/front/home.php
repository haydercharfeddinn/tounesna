<?php
include 'config.php';
session_start(); // Start the session to access user data

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in first."); // Redirect or prompt for login if not logged in
}

try {
    $conn = config::getConnexion(); // Database connection
    
    $userId = $_SESSION['user_id']; // Get the logged-in user's ID

    // Check if the user is banned
    $checkBanStmt = $conn->prepare("SELECT banned FROM users WHERE id = :user_id"); // Corrected column name
    $checkBanStmt->execute([':user_id' => $userId]);
    $user = $checkBanStmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['banned'] == 1) {
        // User is banned, redirect them to login.php
        header('Location: ../back/admin/pages/login.php');
        exit(); // Make sure to stop script execution after the redirect
    }

    // Get the current date
    $today = date('Y-m-d');

    // Check if there's already an entry for today and the specific user
    $stmt = $conn->prepare("SELECT * FROM views WHERE view_date = :view_date AND user_id = :user_id");
    $stmt->execute([':view_date' => $today, ':user_id' => $userId]);

    if ($stmt->rowCount() > 0) {
        // Record already exists for today for this user, don't increment
        echo "You have already viewed this page today.";
    } else {
        // Insert a new record for today
        $insertStmt = $conn->prepare("INSERT INTO views (view_date, view_count, user_id) VALUES (:view_date, 1, :user_id)");
        $insertStmt->execute([':view_date' => $today, ':user_id' => $userId]);
        echo "View recorded.";
    }

    // Fetch users with user_type 'admin' from the database
    $query = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'admin'");
    $query->execute();
    $admins = $query->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Mico</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container">
          <div class="contact_nav">
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +216 54795175
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : MohamedAli.Dahmani@esprit.tn
              </span>
            </a>
            <a href="">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Location
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="home.php">
              <img src="../../images/logo.jpg" alt="">
            </a>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                  <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="about.php"> About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="event.html">events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="quizList.php">reservation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php">SHOP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.html">Réclamation</a>
                  </li>
                </ul>
              </div>
              <div class="quote_btn-container">
                <a href="../back/admin/pages/login.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>
                <a href="../back/admin/pages/register.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>
                <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div class="dot_design">
        <img src="../../images/dots.png" alt="">
      </div>
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <div class="play_btn">
                    <button>
                        <a class="fa fa-play" aria-hidden="true" href="https://youtu.be/Jucl8N9vrws?si=2jrpdnCH4vvLpAlN" target="_blank"></a>
                      </button>
                    </div>
                    <h1>
                      Tounesna<br>

                    </h1>
                    <p>
                    Tounesna is your gateway to discovering the beauty and culture of Tunisia, providing insightful resources and guidance for both locals and visitors. Explore our rich heritage, traditions, and landmarks with us!
                    </p>
                    <a href="./contact.html">
                      Réclamation
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="https://media.istockphoto.com/id/157215464/fr/photo/sidi-bou-sa%C3%AFd-%C3%A0-tunis.jpg?s=612x612&w=0&k=20&c=-R3K5xJhRWPCfGDead64h8gR86r-k2axNydDbtQ0Vno=" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                  <div class="play_btn">
                    <button>
                        <a class="fa fa-play" aria-hidden="true" href="https://youtu.be/Jucl8N9vrws?si=2jrpdnCH4vvLpAlN" target="_blank"></a>
                      </button>
                    </div>
                    <h1>
                      Tounesna <br>

                    </h1>
                    <p>
                    Tounesna is your gateway to discovering the beauty and culture of Tunisia, providing insightful resources and guidance for both locals and visitors. Explore our rich heritage, traditions, and landmarks with us!
                    </p>
                    <a href="./contact.html">
                      Contact Us
                    </a>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="https://ccsav.ca/wp-content/uploads/2022/11/voyage-tunisie.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <img src="../../images/prev.png" alt="">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <img src="../../images/next.png" alt="">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- book section -->

  <!-- <section class="book_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col">
          <form>
            <h4>
              BOOK <span>APPOINTMENT</span>
            </h4>
            <div class="form-row ">
              <div class="form-group col-lg-4">
                <label for="inputPatientName">Patient Name </label>
                <input type="text" class="form-control" id="inputPatientName" placeholder="">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDoctorName">Doctor's Name</label>
                <select name="" class="form-control wide" id="inputDoctorName">
                  <option value="Normal distribution ">Normal distribution </option>
                  <option value="Normal distribution ">Normal distribution </option>
                  <option value="Normal distribution ">Normal distribution </option>
                </select>
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDepartmentName">Department's Name</label>
                <select name="" class="form-control wide" id="inputDepartmentName">
                  <option value="Normal distribution ">Normal distribution </option>
                  <option value="Normal distribution ">Normal distribution </option>
                  <option value="Normal distribution ">Normal distribution </option>
                </select>
              </div>
            </div>
            <div class="form-row ">
              <div class="form-group col-lg-4">
                <label for="inputPhone">Phone Number</label>
                <input type="number" class="form-control" id="inputPhone" placeholder="XXXXXXXXXX">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputSymptoms">Symptoms</label>
                <input type="text" class="form-control" id="inputSymptoms" placeholder="">
              </div>
              <div class="form-group col-lg-4">
                <label for="inputDate">Choose Date </label>
                <div class="input-group date" id="inputDate" data-date-format="mm-dd-yyyy">
                  <input type="text" class="form-control" readonly>
                  <span class="input-group-addon date_icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="btn-box">
              <button type="submit" class="btn ">Submit Now</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section> -->


  <!-- end book section -->


  <!-- about section -->
<br>
<br>
<br>
<br>
<br>
<br>
  <section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="https://horizontunisia.org/wp-content/uploads/2024/06/Traditional-celebrations-in-Tunisia-1024x585.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>Tunisie</span>
              </h2>
            </div>
            <p>
            Tunisia is a country rich in history, culture, and natural beauty, located in the heart of North Africa. From the ancient ruins of Carthage to the stunning Mediterranean beaches, Tunisia offers a unique blend of Arab, Berber, and French influences. Its vibrant markets, historic cities, and vast deserts tell stories of centuries-old civilizations. With diverse landscapes, including the Sahara Desert and lush coastal regions, Tunisia is a destination that celebrates its past while embracing modernity, making it a perfect place for both history enthusiasts and adventure seekers alike.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->


  <!-- treatment section -->

  <section class="culture_section layout_padding">
  <div class="side_img">
    <img src="" alt="">
  </div>
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Explore <span>Tunisia's Culture</span>
      </h2>
      <br>
      <br>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-3">
        <div class="box">
          <div class="img-box">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5ou8_AuDbD02IOIOxaJyBPMdYFIIAk0xSSg&s" alt="">
          </div>
          <div class="detail-box">
            <h4>
              Historical Sites
            </h4>
            <p>
              Discover the ancient ruins and UNESCO World Heritage sites of Tunisia, including the legendary Carthage and El Djem amphitheater.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="box">
          <div class="img-box">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTMoNbB25K1gT-Ej9-gSxhlV3kgFmJrCh-Biw&s" alt="">
          </div>
          <div class="detail-box">
            <h4>
              Tunisian Cuisine
            </h4>
            <p>
              Taste the unique flavors of Tunisia with its famous dishes like couscous, brik, and the sweet treat makroud.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="box">
          <div class="img-box">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIeT9N1ooZ6bYqYB78h99Pppta78wKqWRPtg&s" alt="">
          </div>
          <div class="detail-box">
            <h4>
              Traditional Arts
            </h4>
            <p>
              Explore the colorful world of Tunisian arts, including intricate pottery, handwoven carpets, and beautiful mosaics.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="box">
          <div class="img-box">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQegPjPRJVtEvA9mFRpYZR38Mq9tsoUWao99w&s" alt="">
          </div>
          <div class="detail-box">
            
            <h4>
              Festivals & Events
            </h4>
            <p>
              Immerse yourself in Tunisia's vibrant festivals, from the ancient music festivals in Dougga to the lively celebrations of the Medina.
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


  <!-- end treatment section -->

  <!-- team section -->
  <section class="team_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Our <span>Guides</span>
      </h2>
    </div>
    <div class="carousel-wrap">
      <div class="owl-carousel team_carousel">
        <?php if (!empty($admins)): ?>
          <?php foreach ($admins as $admin): ?>
            <div class="item">
              <div class="box">
                <div class="img-box">
                  <!-- Display admin image -->
                  <img src="uploaded_img/<?php echo htmlspecialchars($admin['image']); ?>" alt="Admin Image" />


                </div>
                <div class="detail-box">
                  <h5>
                    <?php echo htmlspecialchars($admin['name']); ?>
                  </h5>
                  <h6>
                    <?php echo htmlspecialchars($admin['user_type']); ?>
                  </h6>
                  <div class="social_box">
                    <!-- Replace with actual social media links if available -->
                    <a href="">
                      <i class="fa fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="">
                      <i class="fa fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="">
                      <i class="fa fa-linkedin" aria-hidden="true"></i>
                    </a>
                    <a href="">
                      <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p>No admins found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
  <!-- end team section -->


  <!-- client section -->
  <section class="client_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          <span>Testimonial</span>
        </h2>
      </div>
    </div>
    <div class="container px-0">
      <div id="customCarousel2" class="carousel  carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    Morijorch
                  </h5>
                  <h6>
                    Default model text
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
                editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    Rochak
                  </h5>
                  <h6>
                    Default model text
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
                Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <div class="box">
              <div class="client_info">
                <div class="client_name">
                  <h5>
                    Brad Johns
                  </h5>
                  <h6>
                    Default model text
                  </h6>
                </div>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </div>
              <p>
                Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy, editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Variouseditors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various
              </p>
            </div>
          </div>
        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- end client section -->

  
  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="info_top">
        <div class="info_logo">
          <a href="">
            <img src="../../images/logo.jpg" alt="">
          </a>
        </div>
        <div class="info_form">
          <form action="">
            <input type="email" placeholder="Your email">
            <button>
              Subscribe
            </button>
          </form>
        </div>
      </div>
      <div class="info_bottom layout_padding2">
        <div class="row info_main_row">
          <div class="col-md-6 col-lg-3">
            <h5>
              Address
            </h5>
            <div class="info_contact">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
            <div class="social_box">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_links">
              <h5>
                Useful link
              </h5>
              <div class="info_links_menu">
                <a class="active" href="index.html">
                  Home
                </a>
                <a href="about.html">
                  About
                </a>
                <a href="treatment.html">
                  Treatment
                </a>
                <a href="doctor.html">
                  Doctors
                </a>
                <a href="index.php">
                  SHOP
                </a>
                <a href="contact.html">
                  Réclamation
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_post">
              <h5>
                LATEST POSTS
              </h5>
              <div class="post_box">
                <div class="img-box">
                  <img src="../../images/post1.jpg" alt="">
                </div>
                <p>
                  Normal
                  distribution
                </p>
              </div>
              <div class="post_box">
                <div class="img-box">
                  <img src="../../images/post2.jpg" alt="">
                </div>
                <p>
                  Normal
                  distribution
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_post">
              <h5>
                News
              </h5>
              <div class="post_box">
                <div class="img-box">
                  <img src="../../images/post3.jpg" alt="">
                </div>
                <p>
                  Normal
                  distribution
                </p>
              </div>
              <div class="post_box">
                <div class="img-box">
                  <img src="../../images/post4.png" alt="">
                </div>
                <p>
                  Normal
                  distribution
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>


</body>

</html>