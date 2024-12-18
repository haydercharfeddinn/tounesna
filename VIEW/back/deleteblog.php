<?php 
include "C:/xampp/htdocs/mico-html11/CONTROLLER/blogc.php";
$b = new BlogC();
$b->deleteBlog($_GET['id']);
header("location:dashboardblog.php");
?>