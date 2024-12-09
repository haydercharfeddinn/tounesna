<?php

include_once '../../CONTROLLER/eventcontroller.php';  // Path to the controller
include_once '../../MODEL/event.php';  // Path to the Event class

$error = "";

$event= null;
// create an instance of the controller
$eventcontroller = new eventcontroller();


if (isset($_GET["type_"])  && $_GET["nom_eve"] && $_GET["date_"] && $_GET["price"]) {
    if (!empty($_GET["type_"])  && !empty($_GET["nom_eve"]) && !empty($_GET["date_"]) && !empty($_GET["price"])
    
    ) {
        $event = new event(
            null,
            $_GET['type_'],
            $_GET['nom_eve'],
            new DateTime($_GET['date_']),
            $_GET['price']
        );
        //
        
        $eventcontroller->updateevent($event, $_GET['id']);

       header('Location:affiche.php');//3ayet lel fichier eventlist
    } else
        $error = "Missing information";
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>Update event - Dashboard</title>


        <Style>
            /* Global */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fc; /* Fond léger */
                color: #5a5c69; /* Couleur principale du texte */
                margin: 0;
                padding: 0;
            }

            h1 {
                font-size: 24px;
                font-weight: bold;
                color: #4e73df; /* Bleu clair */
                margin-bottom: 20px;
            }

            /* Sidebar */
            .sidebar {
                width: 250px;
                background-color: #4e73df; /* Bleu */
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                padding: 15px 0;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                color: #fff;
            }

            .sidebar a {
                display: block;
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                padding: 10px 20px;
                transition: background-color 0.3s ease;
            }

            .sidebar a:hover {
                background-color: #2e59d9; /* Bleu plus foncé */
                border-radius: 5px;
            }

            /* Content */
            #content-wrapper {
                margin-left: 260px; /* Décalage à droite pour éviter la sidebar */
                padding: 20px;
                background-color: #f8f9fc;
            }

            .container-fluid {
                max-width: 900px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff; /* Fond blanc */
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            /* Card */
            .card {
                border: 1px solid #d1d3e2; /* Gris clair */
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                background-color: #fff;
            }

            .card-header {
                background-color: #4e73df; /* Bleu */
                color: #fff;
                padding: 10px 15px;
                border-bottom: 1px solid #d1d3e2;
                font-weight: bold;
            }

            .card-body {
                padding: 20px;
            }

            /* Formulaire */
            form {
                display: flex;
                flex-direction: column;
                gap: 15px; /* Espacement entre les champs */
            }

            label {
                font-weight: bold;
                color: #5a5c69;
            }

            input,
            select {
                padding: 10px;
                font-size: 16px;
                border: 1px solid #d1d3e2;
                border-radius: 5px;
                background-color: #f8f9fc;
                color: #6e707e;
                outline: none;
                transition: border-color 0.3s ease;
            }

            input:focus,
            select:focus {
                border-color: #4e73df;
                box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
            }

            /* Bouton */
            button {
                background-color: #4e73df;
                color: #fff;
                border: none;
                padding: 12px;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            button:hover {
                background-color: #2e59d9;
            }

            /* Footer */
            footer {
                text-align: center;
                background-color: #f8f9fc;
                padding: 10px 0;
                border-top: 1px solid #d1d3e2;
                margin-top: 20px;
                color: #5a5c69;
            }

            /* Responsive Design */
            @media screen and (max-width: 768px) {
                .sidebar {
                    width: 100%;
                    height: auto;
                    position: relative;
                }

                #content-wrapper {
                    margin-left: 0;
                }
            }

        </style>
    
        <!-- Custom fonts for this template
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
-->
        <!-- Custom styles for this template-->
        <!--<link href="css/sb-admin-2.min.css" rel="stylesheet">-->
    
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../front/index.html">
                    
                    <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
                </a>
    
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
    
                <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                
    
                <li class="nav-item active">
                    <a class="nav-link" href="affiche.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Back to event List</span></a>
                </li>
    
    
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
    
                       
    
                       
    
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
    
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Update the travel event with Id = <?php echo $_GET['id'] ?> </h1>
                                  </div>
    
                        <!-- Content Row -->
                        <div class="row">
    
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-12 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                        <?php
    if (isset($_GET['id'])) {
        $event = $eventcontroller->showevent($_GET['id']);
       
    ?>
                                            <form id="addTraveleventForm" action="" method="POST">
                                            <label for="id">ID event:</label><br>
                                            <input class="form-control form-control-user" type="text" id="id" name="id" readonly value="<?php echo $_GET['id'] ?>"><br>
                                                <label for="type_">Type:</label><br>
                                                <select class="form-control form-control-user" id="category" name="category" value="<?php echo $event['category'] ?>">
                                                <option value="Cinema">Cinema</option>
                                                <option value="Theatre">Theatre</option>
                                                <option value="Concert">Concert</option>
                                                </select>
                                                <span id="type_error"></span><br>
                                             
                                        
                                                <label for="nom_eve">nom_eve:</label><br>
                                                <input class="form-control form-control-user" type="text" id="nom_eve" name="nom_eve" value="<?php echo $event['nom_eve'] ?>" >
                                                <span id="nom_eve_error"></span><br>
                                        
                                                <label for="date_">Departure Date:</label><br>
                                                <input class="form-control form-control-user" type="date" id="date_" name="date_" value="<?php echo $event['date_'] ?>" >
                                                <span id="date_error"></span><br>
                                    
                                        
                                                <label for="price">Price :</label><br>
                                                <input class="form-control form-control-user"  type="number" id="price" name="price" step="0.01" value="<?php echo $event['price'] ?>">
                                                <span id="price_error"></span><br>
                                        
                                           <br>
                                        
                                                <button type="submit" 
                                                class="btn btn-primary btn-user btn-block" 
                                                onClick="validerFormulaire()"
                                                >Add event</button> 
                                                <!-- <button type="submit" 
                                                class="btn btn-primary btn-user btn-block" 
                                                
                                                >Add event</button> -->
                                            </form>
                                            <?php
    }
    ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                          
                        </div>
    
                      
    
                    </div>
                   
    
                </div>
               
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Travel Booking 2024</span>
                        </div>
                    </div>
                </footer>
              
    
            </div>
         
    
        </div>
       
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="js/addevent.js"></script>
    
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
    
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    
    </body>

</html>
