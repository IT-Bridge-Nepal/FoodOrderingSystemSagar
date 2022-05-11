<?php include('../config/constants.php'); ?> 
<?php
// get id of admin to be deleted
$id = $_GET['id'];

// sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// execute query
$res = mysqli_query($conn , $sql);

// check whether query executed succesfully
if($res==true)
{
    // query executed successfully
    // echo "Deleted successfully";
    // session
    $_SESSION['delete'] = "<div class='success'>Admin deleted Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // query not executed
    // echo "Not deleted";
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. TRY AGAIN</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}

// redirect to manage admin page with msg

?>