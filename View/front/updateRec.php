<?php

include "../../controller/rec.php";
include "../../Model/reclamation.php";

$error = "";


$rec = new reclamation();
if (
    isset($_POST["sujet"]) 
) {
    if (
        !empty($_POST["sujet"]) 
       
    ) {
        $reclamation = new rec(
            $_POST['id'],
            $_POST['n'],
            $_POST['p'],
            $_POST['ville'],
            new DateTime($_POST['date']),
            $_POST['sujet']
        );
        $rec->updatereclamation($reclamation, $_POST["id"]);
        header('Location:reclamation.html');
    } else
        $error = "Missing information";
  }
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css.css" />
  <style>
        * {
          box-sizing: border-box;
        }
        
        input[type=text], select, textarea {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          resize: vertical;
        }
        
        label {
          padding: 12px 12px 12px 0;
          display: inline-block;
        }
        
        input[type=submit] {
          background-color: #9bc600;
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          float: right;
        }
        
        input[type=submit]:hover {
          background-color: #ddd;
        }
        
        .container {
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
        }
        
        .col-25 {
          float: left;
          width: 25%;
          margin-top: 6px;
        }
        
        .col-75 {
          float: left;
          width: 75%;
          margin-top: 6px;
        }
        
        /* Clear floats after the columns */
        .row::after {
          content: "";
          display: table;
          clear: both;
        }
        
        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
          .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
          }
        }
        .but{
          background-color: #9bc600;
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          text-align: left;
          text-decoration: none;
        }
        .but:hover{
          background-color: #ddd;
        }
        </style>
  <title>MediMart</title>
  

</head>

    <div id="error">
        <?php echo $error; ?>
    </div>

<br><br><br>
<center><h2>Modification de la reclamation</h2></center>

  <div class="container">
      <form action="" method="POST" >
      
      <?php
    if (isset($_POST['id'])) {
        $reclamation = $rec->showrec($_POST['id']);}

    ?>
       <div class="row">
        <div class="col-25">
         <label for="nom"> ID reclamation</label>
         </div>
        <div class="col-75">
          <input type="text" name="id" id="id"  readonly value=" <?php echo $reclamation['idrec']; ?>" >
        </div>
        </div>
        <div class="row">
      <div class="col-25">
        <label for="nom"> Nom</label>
      </div>
      <div class="col-75">
      <input type="text" name="n" id="n" readonly value=" <?php echo $reclamation['nom']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="prenom"> Prenom</label>
      </div>
      <div class="col-75">
      <input type="text" name="p" id="prenom"  readonly value=" <?php echo $reclamation['prenom']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="prenom"> Date</label>
      </div>
      <div class="col-75">
      <input type="text" name="date" id="date"  readonly value=" <?php echo $reclamation['date']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="ville">Problème</label>
      </div>
      <div class="col-75">
      <input type="text" name="ville" id="sujet"  readonly value=" <?php echo $reclamation['ville']; ?>">
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="sujet">Sujet du reclamation</label>
      </div>
      <div class="col-75">
      <input type="text" name="sujet" id="sujet"  value=" <?php echo $reclamation['sujetrec']; ?>">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-75">
      <input type="submit"  value="Update">
        </div>
    </div>
  </div>
</form>
    <?php
    
    ?>
</body>

</html>

   
    