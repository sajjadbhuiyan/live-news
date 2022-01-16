<?php include "header.php"; ?>



<?php
   include "config.php";
if (isset($_POST['sumbit'])) {
    $cat_id     = mysqli_real_escape_string($connection,$_POST['cat_id']);
    $cat_name   = mysqli_real_escape_string($connection,$_POST['cat_name']);

    $query2     = "UPDATE category SET Category_Name = '{$cat_name }' WHERE Category_ID = '{$cat_id}'";
    $result2     = mysqli_query($connection,$query2) or die("Connection Failed.");
    if ($result2) {
        header("location: category.php");
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
<?php
   include "config.php";
   $Category_ID = $_REQUEST['category_ID'];

   
   $query   = "SELECT * FROM category WHERE Category_ID = {$Category_ID}";
   $result  = mysqli_query($connection,$query) or die("Connection Failed.");
   $count   = mysqli_num_rows($result);

   if ($count > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $cat_id          = $row['Category_ID'];
        $Category_Name   = $row['Category_Name'];
    
?>
                  <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $cat_id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $Category_Name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
            <?php
             }
            
            } 
            ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
