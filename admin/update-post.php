<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">

<?php
include "config.php";
  $post_ID = $_REQUEST['post_id'];  

  $query   = "SELECT post.Post_ID, post.Title, post.Post_Description, post.Category, post.Post_Image, 
                category.Category_Name FROM post 
                LEFT JOIN category ON post.Category = category.Category_ID
                LEFT JOIN add_user ON post.Author   = add_user.ID
                WHERE post.Post_ID = {$post_ID}";

  $result  = mysqli_query($connection,$query) or die("Connection Failed.");
  $count   = mysqli_num_rows($result);

  if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result))  { 
        
    $Post_ID            = $row['Post_ID'];
    $Title              = $row['Title'];
    $Post_Description   = $row['Post_Description'];
    $Category           = $row['Category_Name'];
    $Post_Image         = $row['Post_Image'];
?>

        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php $Post_ID; ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $Title; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                <?php echo $Post_Description; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="Category">
                <option disabled selected> Select Category</option>

                <?php
                include "config.php";
                $query2  = "SELECT * FROM category";
                $result2 = mysqli_query($connection,$query2) or die("Connection Failed.");
                $count2   = mysqli_num_rows($result2);

                if ($count2 > 0){
                while ($row2 = mysqli_fetch_assoc($result2)){

                    if ($row['Category'] == $row2['Category_ID']) {
                        $selected = "selected";
                    }else {
                        $selected = "";
                    }
                    $Category_ID   = $row2['Category_ID'];
                    $Category_Name = $row2['Category_Name'];
                    echo "<option {$selected} value='{$Category_ID}'>{$Category_Name}</option>";
                }
                }

                ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['Category']; ?>">

            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <img  src="images/<?php $Post_Image; ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php $Post_Image; ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>

        <?php
  }
}else {
    echo "Data Not Found";
}
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
