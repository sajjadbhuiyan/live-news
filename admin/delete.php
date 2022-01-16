<?php
include "config.php";


// DELETE FROM `login` WHERE 0
$catch = $_REQUEST['id'];


$query = "DELETE FROM add_user WHERE ID = $catch";
$result = mysqli_query($connection,$query);

if ($result) {
   header("location: users.php?deleted");
}

mysql_close($connection);

?>