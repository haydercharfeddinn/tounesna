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
  <link rel="stylesheet" href="css/css.css" />
  <link rel="stylesheet" href="css/css11.css" />
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script src="js/recl.js" async defer></script>

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
                Call : +01 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : demo@gmail.com
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
              <img src="../../images/logo.png" alt="">
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
                    <a class="nav-link" href="about.php"> About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="event.html">events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="quizList.php">reservation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="testimonial.html">Testimonial</a>
                  </li>
                  <li class="nav-item active">
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
  </div>


  <!-- contact section -->
  <h1 style="text-align: center;">Reclamation</h1>

  <div class="container">
      <form action="addRec.php" method="post" onsubmit="return test()">
          <!-- Existing form fields -->
          <div class="row">
              <div class="col-25">
                  <label for="nom">Nom</label>
              </div>
              <div class="col-75">
                  <input type="text" id="nom" name="nom" placeholder="votre nom..">
              </div>
          </div>
          <div class="row">
              <div class="col-25">
                  <label for="prenom">Prenom</label>
              </div>
              <div class="col-75">
                  <input type="text" id="prenom" name="prenom" placeholder="votre prenom..">
              </div>
          </div>
          <div class="row">
              <div class="col-25">
                  <label for="email">Email</label>
              </div>
              <div class="col-75">
                  <input type="text" id="email" name="email" placeholder="votre email..">
              </div>
          </div>
          <div class="row">
              <div class="col-25">
                  <label for="ville">Problème avec</label>
              </div>
              <div class="col-75">
                  <select id="ville" name="ville">
                      <option value="Réservation">Réservation</option>
                      <option value="e-commerce">e-commerce</option>
                      <option value="Problème général">Problème général</option>
                  </select>
              </div>
          </div>
          <div class="row">
              <div class="col-25">
                  <label for="sujet">Sujet du réclamation</label>
              </div>
              <div class="col-75">
                  <textarea id="sujet" name="sujet" placeholder="votre réclamation.." style="height:200px"></textarea>
              </div>
          </div>

          <!-- New Star Rating Section -->
          <div class="row">
              <div class="col-25">
                  <label for="rating">Votre évaluation :</label>
              </div>
              <div class="col-75">
                  <div class="stars">
                      <span class="star" onclick="setRating(1)">&#9733;</span>
                      <span class="star" onclick="setRating(2)">&#9733;</span>
                      <span class="star" onclick="setRating(3)">&#9733;</span>
                      <span class="star" onclick="setRating(4)">&#9733;</span>
                      <span class="star" onclick="setRating(5)">&#9733;</span>
                  </div>
                  <input type="hidden" id="ratingValue" name="rating" value="0">
              </div>
          </div>

          <div class="row">
              <div class="form-group" style="margin-left: 300px;">
                  <div class="g-recaptcha" data-sitekey="6LfFgCopAAAAAL_Ll_Mftl65Y0IBd4zP2fe3RasP"></div>
              </div>
          </div>
          <br>
          <div class="row">
              <div class="col-25">
                  <a href="historique.html" class="but">Historique</a>
              </div>
              <div class="col-75">
                  <input type="submit" value="Submit" id="submit" name="send">
              </div>
          </div>
      </form>
  </div>
  <!-- end contact section -->
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