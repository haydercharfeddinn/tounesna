<?php

include "../../controller/rep.php";
include "../../Model/reponse.php";

$error = "";


// create an instance of the controller
$rep = new reponse();
if (
    isset($_POST["reponse"]) 
) {
    if (
        !empty($_POST["reponse"]) 
       
    ) {
        $reponse = new rep(
            $_POST['id'],
            $_POST['reponse'],
            $_POST['idrec'],
        );
        $rep->updatereponse($reponse, $_POST["id"]);
        header('Location:listerep.php');
    } else
        $error = "Missing information";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css.css" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>Historique</title>
    <style>
        .f{
            margin-top: 200px;
            margin-left: 600px;
            background-color: #f2f2f2;
            border-radius: 10px;
            width: 450px;
            height: 300px;
        }
        .b{                             
            margin-left: 150px;
        }
        .i{
            margin-left: 10px;
        }
        .l{
            margin-left: 20px;
        }
    </style>
</head>
 <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">MartMint</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>           
        </nav>
      
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="listeRec.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Reclamations
                            </a>
                            <a class="nav-link" href="listerep.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Reponses
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Admin
                    </div>
                </nav>
            </div>


<div class="registration form">
      <form action="" method="POST" class="f">
        <br>
      <center><h3>Modification de la reponse</h3></center><br>
      <?php
    if (isset($_POST['id'])) {
        $reponse = $rep->showrep($_POST['id']);}

    ?>
        <label for="" class="l"><b>ID reponse</b></label>
        <input type="text" name="id" id="id"  readonly value=" <?php echo $reponse['idrep']; ?>" class="i">
        <br><br>
        <label for="" class="l"><b>ID Reclamationnse</b></label>
        <input type="text" name="idrec" id=""  readonly value=" <?php echo $reponse['idrec']; ?>" class="i">
        <br><br>
        <label for="" class="l"><b>Reponse</b></label>
        <input type="text" name="reponse" id=""  value=" <?php echo $reponse['reponse']; ?>" class="i">
        <br><br>
        <input type="submit"  value="Update" class="b">
        <br>
      </form>
      </div>
    <?php
    
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="assets/demo/chart-area-demo.js"></script>
  <script src="assets/demo/chart-bar-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
  <script src="js/datatables-simple-demo.js"></script>
