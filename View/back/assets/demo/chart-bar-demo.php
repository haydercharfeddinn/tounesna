<?php
require 'C:\xampp\htdocs\projetWeb2A\config.php';

$db = config::getConnexion();
$sql = "SELECT COUNT(ville) AS nombreReclamations FROM reclamation WHERE ville='e-commerce'";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);
$nombreReclamations = $result['nombreReclamations'];

$sql1 = "SELECT COUNT(ville) AS nombreReclamations FROM reclamation WHERE ville='Réservation'";
$query1 = $db->prepare($sql1);
$query1->execute();
$result1 = $query1->fetch(PDO::FETCH_ASSOC);
$nombreReclamations2 = $result1['nombreReclamations'];


$sql2 = "SELECT COUNT(ville) AS nombreReclamations FROM reclamation WHERE ville='Problème général'";
$query2 = $db->prepare($sql2);
$query2->execute();
$result2 = $query2->fetch(PDO::FETCH_ASSOC);
$nombreReclamations3 = $result2['nombreReclamations'];

?>


// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Réservation", "e-commerce", "problème général"],
    datasets: [{
      label: "Reclamation",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data: [<?php echo"$nombreReclamations2";  ?>, <?php echo"$nombreReclamations" ;?>, <?php echo"$nombreReclamations3" ; ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'ville'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 3
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

