<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php

include 'config.php';

if (isset($_POST['save'])) {
    $cat      = mysqli_real_escape_string($connection,$_POST['cat']);
    

    $query1     = "SELECT Category_Name FROM category WHERE Category_Name = '$cat'";
    $result     = mysqli_query($connection,$query1) or die("Connection Failed.");

    $count      = mysqli_num_rows($result);

    if ($count > 0) {
        echo "This Category Already Exists";
    }else {
        $query2  = "INSERT INTO category (Category_Name) VALUES ('$cat')";
        $result2 = mysqli_query($connection,$query2) or die("Connection Failed.");

        if ($result2) {
            header('location: category.php');
        }
    }
}

?>


                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
