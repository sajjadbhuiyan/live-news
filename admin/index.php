<?php
session_start();
if (isset($_SESSION['User_Name'])) {
    header("location: post.php");
}

?>


<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']?>" method ="post">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        
                        include "config.php";
                        if (isset($_POST['login'])) {
                          $username =  mysqli_real_escape_string($connection,$_POST['username']);
                          $password =  md5($_POST['password']);

                          $query = "SELECT * FROM add_user WHERE User_Name = '{$username}' && Password = '{$password}'" ;

                          $result = mysqli_query($connection,$query) or die("Connection Failed.");
                          $count  = mysqli_num_rows($result);

                          if ($count > 0) {
                            while($row = mysqli_fetch_assoc($result)){

                               session_start();

                               $_SESSION['User_Name'] = $row['User_Name'];
                               $_SESSION['ID']  = $row['ID'];
                               $_SESSION['User_Role'] = $row['User_Role'];

                               header("location: users.php");
                            }
                          }else {
                              echo "Username And Password not Match";
                          }
                          
                        }
                        
                        
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
