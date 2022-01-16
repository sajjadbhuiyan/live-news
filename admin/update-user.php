<?php include "header.php"; 
if ($_SESSION['User_Role'] == 0) {
    header("location: post.php");
  }

?>
<?php
   include "config.php";
if (isset($_POST['submit'])) {
    $rec_id     = mysqli_real_escape_string($connection,$_POST['user_id']);
    $fname      = mysqli_real_escape_string($connection,$_POST['f_name']);
    $lname      = mysqli_real_escape_string($connection,$_POST['l_name']);
    $user       = mysqli_real_escape_string($connection,$_POST['username']);
    $role       = mysqli_real_escape_string($connection,($_POST['role']));

    $query2     = "UPDATE add_user SET First_Name = '{$fname}', Last_Name = '{$lname}', User_Name ='{$user}',
     User_Role='{$role}' WHERE ID = '{$rec_id}'";
    $result2     = mysqli_query($connection,$query2) or die("Connection Failed.");
    if ($result2) {
        header("location: users.php");
    }
}
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
<?php
   include "config.php";
   $ID = $_REQUEST['id'];

   
   $query   = "SELECT * FROM add_user WHERE ID = {$ID}";
   $result  = mysqli_query($connection,$query) or die("Connection Failed.");
   $count   = mysqli_num_rows($result);

   if ($count > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $ID          = $row['ID'];
        $First_Name  = $row['First_Name'];
        $Last_Name   = $row['Last_Name'];
        $User_Name   = $row['User_Name'];
        $User_Role   = $row['User_Role'];
    
?>


                  <form  action="<?php $_SERVER['PHP_SELF']?>" method ="post">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $ID; ?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $First_Name; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $Last_Name; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $User_Name; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $User_Role; ?>">

                          <?php
                          if ($User_Role == 1) {
                            echo   "<option value='0'>Normal User</option>";
                           echo   "<option value='1' selected >Admin</option>";
                        }else {
                            echo   "<option value='0' selected>Normal User</option>";
                           echo   "<option value='1'>Admin</option>";
                        }
                          ?>
                        
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
               <?php
             }
            
            } 
            ?> 
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
