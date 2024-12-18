<?php
// Configuration de la base de données
require_once '../../config.php'; // Remplacez par votre fichier de connexion

if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);

    try {
        $db = config::getConnexion();
        $query = $db->prepare("SELECT * FROM events WHERE nom_eve LIKE :search");
        $query->execute(['search' => "%$search%"]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
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
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      padding: 20px;
  }

  h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
  }

  .event-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
  }

  .event-card {
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
      text-align: center;
  }

  .event-card h3 {
      margin-top: 0;
      color: #333;
  }

  .event-card p {
      margin: 10px 0;
      font-size: 14px;
      color: #555;
  }

  .event-card .actions {
      margin-top: 15px;
  }

  .event-card .btn {
      padding: 8px 12px;
      font-size: 14px;
      border: 1px solid;
      border-radius: 4px;
      cursor: pointer;
  }

  .event-card .btn-outline-success {
      color: #28a745;
      border-color: #28a745;
      background: none;
  }

  .event-card .btn-outline-success:hover {
      background-color: #28a745;
      color: white;
  }

  .event-card .btn-outline-danger {
      color: #dc3545;
      border-color: #dc3545;
      background: none;
  }

  .event-card .btn-outline-danger:hover {
      background-color: #dc3545;
      color: white;
  }

  </style>

</head>

<body class="sub_page">
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
          <div class="header_top">
            <div class="container">
              <div class="contact_nav">
                <a href="">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    Call : +216 94 558 031
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>
                    Email : dhia.elghak19@gmail.com
                  </span>
                </a>
                <a href="">
                  <i class="fa fa-map-marker" aria-hidden="true"></i>
                  <span>
                    Location : Cite IBN Khouldoun
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
                </a>
    
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                </button>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                    <ul class="navbar-nav  ">
                      <li class="nav-item ">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="about.html"> About</a>
                      </li>
                      <li class="nav-item active">
                        <a class="nav-link" href="event.html">Events</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="reservation.html">Reservation</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="testimonial.html">Testimonial</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
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
      </div>


      <div class="container mt-4">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
        <div class="row">
          <?php if (!empty($results)): ?>
            <?php foreach ($results as $event): ?>
              <div class="col-md-4">
                <div class="card mb-4">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($event['nom_eve']); ?></h5>
                    <p class="card-text">
                      <strong>Type:</strong> <?php echo htmlspecialchars($event['type_']); ?><br>
                      <strong>Date:</strong> <?php echo htmlspecialchars((new DateTime($event['date_']))->format('Y-m-d')); ?><br>
                      <strong>Price:</strong> <?php echo htmlspecialchars($event['price']); ?> TND
                    </p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-muted">No events found for "<?php echo htmlspecialchars($search); ?>"</p>
          <?php endif; ?>
        </div>
      </div>





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
                  Call +216 94 558 031
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope"></i>
                <span>
                  dhia.elghak19@gmail.com
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
                <a href="index.html">
                  Home
                </a>
                <a href="about.html">
                  About
                </a>
                <a href="event.html" class="active">
                  Event
                </a>
                <a href="reservation.html">
                  Reservation
                </a>
                <a href="testimonial.html">
                  Testimonial
                </a>
                <a href="contact.html">
                  Contact us
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