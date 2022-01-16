<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <?php

              
              include "config.php";
            //   pagination var and condition

              $limit = 5;
              
              if (isset($_GET['page'])) {
                  $Page_number = $_GET['page'];
              }else{
                $Page_number = 1;
              }
              $offset  = ($Page_number-1) * $limit;
              
              if ($_SESSION['User_Role'] == '1'){
                $query   = "SELECT post.Post_ID, post.Title, post.Post_Description, post.Category, post.Date, 
                category.Category_Name, add_user.User_Name FROM post 
                LEFT JOIN category ON post.Category = category.Category_ID
                LEFT JOIN add_user ON post.Author   = add_user.ID
                
                ORDER BY post.Post_ID DESC LIMIT {$offset} , {$limit}";
              }elseif ($_SESSION['User_Role'] == '0') {
                $query   = "SELECT post.Post_ID, post.Title, post.Post_Description, post.Category, post.Date, 
                category.Category_Name, add_user.User_Name FROM post 
                LEFT JOIN category ON post.Category = category.Category_ID
                LEFT JOIN add_user ON post.Author   = add_user.ID
                WHERE post.Author = {$_SESSION['ID']}
                ORDER BY post.Post_ID DESC LIMIT {$offset} , {$limit}";
              }

              
              $result  = mysqli_query($connection,$query) or die("Connection Failed.");
              $count   = mysqli_num_rows($result);

              if ($count > 0) {
                  
              

?>
<div class="col-md-12">
<table class="content-table">
<thead>
    <th>S.No.</th>
    <th>Title</th>
    <th>POST DESCRIPTION</th>
    <th>Category</th>
    <th>Date</th>
    <th>Author</th>
    <th>Edit</th>
    <th>Delete</th>
</thead>

<?php



while ($row = mysqli_fetch_assoc($result)) {
    $Post_ID            = $row['Post_ID'];
    $Title              = $row['Title'];
    $Post_Description   = $row['Post_Description'];
    $Category           = $row['Category_Name'];
    $Date               = $row['Date'];
    $Author             = $row['User_Name'];

?>

<tbody>
<tr>
<td class='id'><?php echo $Post_ID; ?></td>
<td><?php echo $Title ; ?></td>
<td><?php echo $Post_Description; ?></td>
<td><?php echo $Category; ?></td>
<td><?php echo $Date; ?></td>
<td><?php echo $Author; ?></td>



 
 </td>
<td class='edit'><a href='update-post.php?post_id=<?php echo$Post_ID?> '><i class='fa fa-edit'></i></a></td>
<td class='delete'><a onclick="return confirm('Are you Sure?')" href='delete.php?post_id=<?php echo$Post_ID?> '><i class='fa fa-trash-o'></i></a></td>
</tr>
</tbody>


                      
                      
        <?php 
        
      }  
    
    } 
        
        
        ?>
                              
                  </table>
                

            <?php
            include "config.php";
            $query2   = "SELECT * FROM post";
            $result2  = mysqli_query($connection,$query2) or die("Connection Failed.");
            $count    = mysqli_num_rows($result2);

              if ($count){
                  $total_records = $count;
                  $totlal_page = ceil($total_records/$limit);
                  
                 echo "<ul class='pagination admin-pagination'>";
                 if ($Page_number > 1) {
                    echo '<li><a href="post.php?page='.($Page_number - 1).'">Prev</a></li> ';
                 }  
                  for ($i=1; $i <= $totlal_page; $i++) { 

                    if ($i == $Page_number) {
                        $active = "active";
                    }
                    else{
                        $active = "";
                    }
                    echo '<li class='.$active.'><a href="post.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if ($Page_number < $totlal_page) {
                    echo '<li><a href="post.php?page='.($Page_number + 1).'">Next</a></li>';
                 } 
                  
                  echo "</ul>";
              }

            ?>

</div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
