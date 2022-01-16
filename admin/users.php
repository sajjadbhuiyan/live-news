<?php include "header.php"; 
if ($_SESSION['User_Role'] == 0) {
  header("location: post.php");
}
?>




  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
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

              $query   = "SELECT * FROM add_user ORDER BY ID DESC LIMIT {$offset} , {$limit}";
              $result  = mysqli_query($connection,$query) or die("Connection Failed.");
              $count   = mysqli_num_rows($result);

              if ($count > 0) {
                  
              

?>
<div class="col-md-12">
<table class="content-table">
<thead>
<th>S.No.</th>
<th>Full Name</th>
<th>User Name</th>
<th>Role</th>
<th>Edit</th>
<th>Delete</th>
</thead>

<?php

while ($row = mysqli_fetch_assoc($result)) {
    $ID          = $row['ID'];
    $First_Name  = $row['First_Name'];
    $Last_Name   = $row['Last_Name'];
    $User_Name   = $row['User_Name'];
    $Password    = $row['Password'];
    $User_Role   = $row['User_Role'];

?>

<tbody>
<tr>
<td><?php echo $ID; ?></td>
<td><center><?php echo ("$First_Name $Last_Name"); ?></center></td>
<td><?php echo $User_Name; ?></td>
<td>

<?php 
if ($User_Role == 1) {
    echo "Admin";
}else {
    echo "Normal User";
}
?>
 
 </td>
<td class='edit'><a href='update-user.php?id=<?php echo$ID?> '><i class='fa fa-edit'></i></a></td>
<td class='delete'><a onclick="return confirm('Are you Sure?')" href='delete.php?id=<?php echo$ID?> '><i class='fa fa-trash-o'></i></a></td>
</tr>
</tbody>


                      
                      
        <?php 
      }  
    
    } 
        
        
        ?>
                              
                  </table>
                

            <?php
            include "config.php";
            $query2   = "SELECT * FROM add_user";
            $result2  = mysqli_query($connection,$query2) or die("Connection Failed.");
            $count    = mysqli_num_rows($result2);

              if ($count){
                  $total_records = $count;
                  $totlal_page = ceil($total_records/$limit);
                  
                 echo "<ul class='pagination admin-pagination'>";
                 if ($Page_number > 1) {
                    echo '<li><a href="users.php?page='.($Page_number - 1).'">Prev</a></li> ';
                 }  
                  for ($i=1; $i <= $totlal_page; $i++) { 

                    if ($i == $Page_number) {
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    echo '<li class='.$active.'><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if ($Page_number < $totlal_page) {
                    echo '<li><a href="users.php?page='.($Page_number + 1).'">Next</a></li>';
                 } 
                  
                  echo "</ul>";
              }

            ?>


                  
                      <!-- <li class="active"><a>1</a></li> -->
                      
                      
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>

