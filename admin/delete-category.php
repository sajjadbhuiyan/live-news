<?php
include "config.php";

$cat_id = $_REQUEST['category_ID'];

$query2 = "DELETE FROM category WHERE Category_ID = '{$cat_id}'";
$result2 = mysqli_query($connection,$query2);

if ($result2) {
   header("location: category.php");
}


?>