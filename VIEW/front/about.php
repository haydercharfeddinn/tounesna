<?php
include_once "C:/xampp/htdocs/mico-html11/CONTROLLER/blogc.php";
include_once "C:/xampp/htdocs/mico-html11/MODEL/blogm.php";


$b=new BlogC;
$tab=$b->listBlogs();

$error="";

// create an instance of the controller
$comentairecontroller = new comentaireC(); 


if (isset($_POST["contenu_c"])   ) {
    if (
        !empty($_POST["contenu_c"])  
    
    ) {
        $comentaire = new comentaire(
            null,
            $_POST['contenu_c'],
            null,
            null
        );
        //
            
        $comentairecontroller->addcomentaire($comentaire); 

       header('Location:about.php');
    } else
        $error = "Missing information";
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
<style>
  #myInput {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid #ddd;
}

#blogContainer {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.blog-post {
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.blog-post h3 {
    margin: 0 0 10px;
    font-size: 22px;
}

.blog-post p {
    font-size: 16px;
}

.blog-post small {
    color: #777;
    font-size: 14px;
}

.add-comment-btn {
    display: inline-block;
    margin-top: 10px;
    background-color: #4e73df;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
}

.add-comment-btn:hover {
    background-color: #2e59d9;
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
                Call : +216 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : tounesna@gmail.com
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
            <a class="navbar-brand" href="index.php">
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
                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="about.php"> About</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="event.html">events</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="reservation.html">reservation</a>
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
                <a href="">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>
                <a href="">
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


  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="../../images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About <span>us</span>
              </h2>
            </div>
            <p>
              We are a group of passionate students from Esprit University in Tunisia, dedicated to showcasing the beauty, culture, and traditions of our country. Through this blog, we aim to share the vibrant experiences, hidden gems, and unique customs that make Tunisia a captivating place to explore. Join us on our journey to celebrate and discover everything our homeland has to offer!
            </p>
            <a href="">
              add comment 
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  <div class="pdf-container">
            <!-- Intégration du fichier PDF  -->
            <iframe src="Rapportdestage.pdf"></iframe>
        </div>
        <p>
            <a href="Rapportdestage.pdf" download>Télécharger</a>
        </p>
    </div>
    <style>
        .pdf-container {
    width: 80%; /* Largeur du conteneur */
    max-width: 800px; /* Largeur maximale */
    margin: 20px auto; /* Centrer le conteneur */
    border: 2px solid #2ecc71; /* Bordure verte */
    border-radius: 8px; /* Coins arrondis */
    overflow: hidden; /* Masquer le débordement */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
    background-color: #fff; /* Couleur de fond blanche */
}

.pdf-container iframe {
    width: 100%; /* Prendre toute la largeur du conteneur */
    height: 600px; /* Hauteur fixe pour l'iframe */
    border: none; /* Supprimer la bordure de l'iframe */
}

.pdf-container p {
    text-align: center; /* Centrer le texte */
    margin-top: 10px; /* Espace au-dessus du texte */
}

.pdf-container a {
    display: inline-block; /* Afficher comme un bloc pour le padding */
    padding: 10px 20px; /* Espacement interne */
    background-color: #2ecc71; /* Couleur de fond verte */
    color: white; /* Couleur du texte */
    text-decoration: none; /* Supprimer le soulignement */
    border-radius: 5px; /* Coins arrondis */
    transition: background-color 0.3s; /* Transition pour la couleur de fond */
}

.pdf-container a:hover {
    background-color: #27ae60; /* Couleur de fond au survol */
}
</style>
  <!-- about2 section -->

  <section class="about_section layout_padding">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="../../images/about-img1.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                <span>Exploring the Rich Tapestry of Tourism in Tunisia</span>
              </h2>
            </div>
            <p>
              This captivating photo, taken by a tourist, showcases a beautifully preserved and picturesque alleyway in a traditional Tunisian village. The walls, painted in a soft blue reminiscent of the famous town of Sidi Bou Said, are adorned with colorful bags, lanterns, and various objects that create an intriguing and eclectic scene. The contrast of the vibrant oranges and reds against the cool blue tones of the architecture gives the image a unique and inviting warmth.
            </p>
            <a href="">
              add comment
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->
<!-- Blog Section -->
<section class="about_section layout_padding">
  <div class="container">
    <div class="row">
    <input type="text" id="myInput" placeholder="Search by contenu..." onkeyup="myFunction()" class="form-control">

<div id="blogContainer">
<?php foreach ($tab as $blog): ?>
    <div class="blog-post" data-id="<?php echo $blog['id']; ?>" data-date="<?php echo $blog['date_pub']; ?>" data-contenu="<?php echo $blog['contenu']; ?>" data-image="<?php echo $blog['image']; ?>">
    <?php 
    // Construct the correct path dynamically
    $imagePath = "C:/xampp/htdocs/mico-html11/" . $blog['image']; 
    if (file_exists($imagePath)): ?>
        <img src="C:/xampp/htdocs/mico-html11/uploads/<?php echo $blog['image']; ?>" alt="Image Blog" style="width: 100px; height: 100px; object-fit: cover;">
    <?php else: ?>
        <p>Image not found</p>
    <?php endif; ?>
        <p class="blog-contenu"><?php echo $blog['contenu']; ?></p>
        <small class="blog-date">Publié le: <?php echo $blog['date_pub']; ?></small>
        
          <form action="" method="POST">
            <label for="comentairecontenu">contenu</label>
            <input type="text" id="contenu_c" name="contenu_c">
          

            <button type="submit">Ajouter</button>
          </form>
    </div>
<?php endforeach; ?>

</div>

    </div>
  </div>
</section>
<!-- End of Blog Section -->

<script>
  function myFunction() {
    var input, filter, blogContainer, blogPosts, blogContenu, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    blogContainer = document.getElementById("blogContainer");
    blogPosts = blogContainer.getElementsByClassName("blog-post");

    // Loop through all blog posts, and hide those who don't match the search query
    for (i = 0; i < blogPosts.length; i++) {
        blogContenu = blogPosts[i].getElementsByClassName("blog-contenu")[0];
        if (blogContenu) {
            txtValue = blogContenu.textContent || blogContenu.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                blogPosts[i].style.display = "";
            } else {
                blogPosts[i].style.display = "none";
            }
        }
    }
}

  // JavaScript pour afficher/masquer le formulaire de commentaire
  document.querySelectorAll('.add-comment-btn').forEach(button => {
    button.addEventListener('click', function() {
      const blogId = this.getAttribute('data-blog-id');
      const commentForm = document.getElementById('comment-form-' + blogId);
      
      // Toggle visibility of the comment form
      commentForm.style.display = (commentForm.style.display === 'none' || commentForm.style.display === '') ? 'block' : 'none';
    });
  });

  // Soumettre le commentaire via AJAX
  document.querySelectorAll('.submit-comment-btn').forEach(button => {
    button.addEventListener('click', function() {
      const blogId = this.getAttribute('data-blog-id');
      const commentText = document.getElementById('comment-text-' + blogId).value;
      
      if (commentText.trim() !== '') {
        // Envoi du commentaire via AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_comment.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (xhr.status === 200) {
            alert('Comment submitted successfully');
            document.getElementById('comment-form-' + blogId).style.display = 'none';
            document.getElementById('comment-text-' + blogId).value = '';  
          } else {
            alert('Error submitting comment');
          }
        };
        xhr.send('blog_id=' + blogId + '&comment=' + encodeURIComponent(commentText));
      } else {
        alert('Please write a comment before submitting.');
      }
    });
  });
</script>


  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="info_top">
        <div class="info_logo">
          <a href="">
            <img src="../../images/logo.png" alt="">
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
                <a href="index.html">
                  Home
                </a>
                <a class="active" href="about.php">
                  About
                </a>
                <a href="treatment.html">
                  Treatment
                </a>
                <a href="doctor.html">
                  Doctors
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