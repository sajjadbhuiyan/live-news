<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $new_name = $_POST['old-image'];
}else {
    $errors  = array();

        $file_name      = $_FILES['new-image']['name'];
        $tmp_name       = $_FILES['new-image']['tmp_name'];
        $file_size      = $_FILES['new-image']['size']; 
        $file_type      = $_FILES['new-image']['type'];
        $file_ext_devide= explode('.', $file_name);
        $catch_ext      = end($file_ext_devide);


        $extention     = array("jpeg", "jpg", "png");

        if (in_array($catch_ext,$extention) === false)  {
            $errors[] = "This extention file is not allowed. Please choose a jpeg/jpg or png file.";
        }

        if ($file_size < 8000000) {
            $errors[] = "Flie size must be 7mb or lower.";
        }
        $new_name      = time(). "-" .basename($file_name);
        $file_location = "images/".$new_name;

        if (empty($errors) == true) {
            move_uploaded_file($tmp_name,$file_location);
        }else{
            print_r($errors);
            
        }
}

        $query     = "UPDATE post SET Title = '{$_POST["post_title"]}', Post_Description = '{$_POST["postdesc"]}',
        Category ='{$_POST["Category"]}', Post_Image = '{$new_name}'WHERE Post_ID = {$_POST["post_id"]};";

        if ($_POST['old_category'] != $_POST['Category']) {
            $query .= "UPDATE category SET Num_of_Post = Num_of_Post - 1  WHERE Category_ID = {$_POST['old_category']};";
            $query .= "UPDATE category SET Num_of_Post = Num_of_Post + 1  WHERE Category_ID = {$_POST['Category']};";
        }

                $result = mysqli_multi_query($connection,$query);

                if ($result) {
                    header("location: ../admin/post.php");
                }else {
                    echo "Query Failed";
                }
?>