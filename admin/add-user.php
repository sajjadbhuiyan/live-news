<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $fname      = mysqli_real_escape_string($connection,$_POST['fname']);
    $lname      = mysqli_real_escape_string($connection,$_POST['lname']);
    $user       = mysqli_real_escape_string($connection,$_POST['user']);
    $password   = mysqli_real_escape_string($connection,md5($_POST['password']));
    $role       = mysqli_real_escape_string($connection,($_POST['role']));

    $query1     = "SELECT User_Name FROM add_user WHERE User_Name = '$user'";
    $result     = mysqli_query($connection,$query1) or die("Connection Failed.");

    $count      = mysqli_num_rows($result);

    if ($count > 0) {
        echo "This User Name Already Exists";
    }else {
        $query2  = "INSERT INTO add_user (First_Name, Last_Name, User_Name, Password, User_Role) 
        VALUES ('$fname','$lname','$user','$password','$role')";
        $result2 = mysqli_query($connection,$query2) or die("Connection Failed.");

        if ($result2) {
            header('location: users.php');
        }
    }
}

?>



                  <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="submit" class="btn btn-primary" value="Add" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
