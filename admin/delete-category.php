<?php include('../config/constants.php'); ?> 

<?php
// echo "delete";
// check whether the id and image_name are set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // get value and delete
    // echo "get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // remove physical image is available
    if($image_name!=="")
    {
        // image available so delete it
        $path = "../images/category/".$image_name;

        // remove image
        $remove = unlink($path);

        // if failed to remove image then add error msg and stop process
        if($remove==false)
        {
            // set the session msg
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image</div>";
            // redirect to manage category 
            header('location:'.SITEURL.'admin/manage-category.php');
            // stop process
            die();
        }
    }
    // delete data from database
    // sql query to delete data from db
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // execute query
    $res = mysqli_query($conn, $sql);

    // check whether data deleted or not

    if($res==TRUE)
    {
        // success
        $_SESSION['delete'] = "<div class='success'>Category deleted Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        // failed msg
        $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-category.php');
    }

    

}
else
{
    // redirect to manage category
    header('location:'.SITEURL.'admin/manage-category.php');

}
?>