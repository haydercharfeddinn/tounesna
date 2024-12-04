<?php 
include "../../controller/blogc.php";
$b = new BlogC();
$b->deleteBlog($_GET['id']);
header("location:dashboard.php");
?>