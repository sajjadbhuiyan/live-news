<?php include "header.php"; 
if ($_SESSION['User_Role'] == 0) {
    header("location: post.php");
  }

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">

<?php

include "config.php";
//   pagination var and condition
$limit = 3;

if (isset($_GET['page'])) {
$Page_number = $_GET['page'];
}else{
$Page_number = 1;
}
$offset  = ($Page_number-1) * $limit;

$query   = "SELECT * FROM category ORDER BY Category_ID DESC LIMIT {$offset} , {$limit}";
$result  = mysqli_query($connection,$query) or die("Connection Failed.");
$count   = mysqli_num_rows($result);


if ($count > 0) {


?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>CATEGORY NAME</th>
                        <th><center>NUM of POST</center></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>

<?php

while ($row = mysqli_fetch_assoc($result)) {
$Category_ID   = $row['Category_ID'];
$Category_Name = $row['Category_Name'];
$Num_of_Post       = $row['Num_of_Post'];

?>      
                    <tbody>
                        <tr>
                            <td class='id'><?php echo $Category_ID; ?></td>
                            <td><center><?php echo $Category_Name; ?></center></td>
                            <td><?php echo $Num_of_Post; ?></td>
                            <td class='edit'><a href='update-category.php?category_ID=<?php echo $Category_ID ?> '><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are you Sure?')" href='delete-category.php?category_ID=<?php echo $Category_ID?> '><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    </tbody>
<?php
 }

}
?>                    
                </table>

<?php

            include "config.php";
            $query2   = "SELECT * FROM category";
            $result2  = mysqli_query($connection,$query2) or die("Connection Failed.");
            $count    = mysqli_num_rows($result2);

              if ($count){
                  $total_records = $count;
                  $totlal_page = ceil($total_records/$limit);
                  
                 echo "<ul class='pagination admin-pagination'>";
                 if ($Page_number > 1) {
                    echo '<li><a href="category.php?page='.($Page_number - 1).'">Prev</a></li> ';
                 }  
                  for ($i=1; $i <= $totlal_page; $i++) { 

                    if ($i == $Page_number) {
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    echo '<li class='.$active.'><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if ($Page_number < $totlal_page) {
                    echo '<li><a href="category.php?page='.($Page_number + 1).'">Next</a></li>';
                 } 
                  
                  echo "</ul>";
              }

?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
