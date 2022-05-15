<?php include('partials/menu.php'); ?> 
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>
        <br>
        <?php
        // get id of selected admin
        $id=$_GET['id'];

        // sql query to get deatils
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // execute
        $res = mysqli_query($conn , $sql);

        // check if executed
        if($res==true)
        {
            // check if data available
            $count = mysqli_num_rows($res);

            // check if admin available
            if($count==1)
            {
                // Get details
                // echo "Admin available";
                $row = mysqli_fetch_assoc($res);
                
                $full_name = $row['full_name'];
                $username = $row['username'];
            }
            else{
                // redirect
                header("location:".SITEURL.'admin/manage-admin.php');
            }
        }

        ?>
        <form action="" method="POST">
        <table class="tbl-30 "  >
           <tr>
               <td>Full Name:</td>
               <td>
                   <input type="text" name="full_name" placeholder="Enter your Name!!!" value="<?php echo $full_name; ?>">
                </td>
               <td></td>
           </tr>
           <tr>
               <td>Username :</td>
               <td>
                   <input type="text" name="username" placeholder="Enter your UserName!!!" value="<?php echo $username; ?>">
                </td>
               <td></td>
           </tr>
           
           
           <tr>
               <td colspan="2">
               <input type="hidden" name="id"  value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
               </td>
           </tr>

        </table>
        </form>
    </div>
</div>

<?php
// check whether button clicked
if(isset($_POST['submit']))
{
    // echo "Button cliked";
    // get all values from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    // sql query to update admin
$sql = "UPDATE tbl_admin SET
full_name = '$full_name',
username = '$username'
where id = '$id'  
";
// execute query
$res = mysqli_query($conn, $sql);

// check whether query executed
if($res==true)
{
    // query executed and admin updated
    $_SESSION['update'] = "<div class='success'>Admin updated Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
    // not executed
    $_SESSION['update'] = "<div class='error'>Admin not updated Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
}



?>

<?php include('partials/footer.php'); ?>