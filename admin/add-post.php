<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">

              <?php

include 'config.php';

if (isset($_POST['submit'])) {
    
    $post_title = mysqli_real_escape_string($connection,$_POST['post_title']);
    $postdesc   = mysqli_real_escape_string($connection,$_POST['postdesc']);
    $category   = mysqli_real_escape_string($connection,$_POST['category']);
    $date       = date("d M, Y");
    // session_start();
    $author     = $_SESSION['ID'];

    // file part
    if (isset($_FILES['fileToUpload'])) {
        $errors  = array();

        $file_name     = $_FILES['fileToUpload']['name'];
        $tmp_name      = $_FILES['fileToUpload']['tmp_name'];
        $file_size     = $_FILES['fileToUpload']['size']; 
        $file_type     = $_FILES['fileToUpload']['type'];
        $tmp           = explode('.', $file_name);
        $file_extension= end($tmp);

        $extention     = array("jpeg", "jpg", "png");

        if (in_array($file_extension,$extention) === false)  {
            $errors[] = "This extention file is not allowed. Please choose a jpeg/jpg or png file.";
        }

        if ($file_size < 8000000) {
            $errors[] = "Flie size must be 7mb or lower";
        }
        $file_new_name = time()."-".basename($file_name);
        $file_location        = "images/".$file_new_name;

        if (empty($errors) == true) {
            move_uploaded_file($tmp_name,$file_location);
        }else{
            print_r($errors);
            
        }
    }

        $query2  = "INSERT INTO post (Title, Post_Description, Category, Date, Author, Post_Image) 
        VALUES ('{$post_title}','{$postdesc}','{$category}', '{$date}','{$author}','{$file_new_name}');";
        $query2 .= "UPDATE category SET Num_of_Post = Num_of_Post + 1 WHERE Category_ID = {$category}";

        $result2 = mysqli_multi_query($connection,$query2) or die("Connection Failed.");

        if ($result2) {
            header('location: post.php');
        }else {
            echo "Query failed";
        }

        
}


?>


                  <!-- Form -->
                  <form  action="add-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option disabled selected> Select Category</option>

                              <?php
                              include "config.php";
                              $query  = "SELECT * FROM category";
                              $result = mysqli_query($connection,$query) or die("Connection Failed.");
                              $count   = mysqli_num_rows($result);

                              if ($count > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                  $Category_ID   = $row['Category_ID'];
                                  $Category_Name = $row['Category_Name'];
                                  echo "<option value='{$Category_ID}'>$Category_Name</option>";
                                }
                              }
                              
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
