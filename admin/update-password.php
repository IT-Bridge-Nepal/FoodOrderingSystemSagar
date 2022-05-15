<?php include('partials/menu.php'); ?>  
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br>
        <br>
        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
        <table class="tbl-30 "  >
           <tr>
               <td>Current Password:</td>
               <td>
                   <input type="password" name="current_password" placeholder="current password" >
                </td>
               <td></td>
           </tr>
           <tr>
               <td>New Password :</td>
               <td>
                   <input type="pasword" name="new_password" placeholder="new password">
                </td>
               <td></td>
           </tr>
           <tr>
               <td>Confirm Password : </td>
               <td>
                   <input type="password" name="confirm_password" placeholder="confirm password">
                </td>
               <td></td>
           </tr>
           
           
           <tr>
               <td colspan="2">
               <input type="hidden" name="id"  value="<?php echo $id; ?>">
                   <input type="submit" name="submit" value="Change password" class="btn-secondary">
               </td>
           </tr>

        </table>
        </form>
    </div>
</div>

<?php
// check whether button is clicked
if(isset($_POST['submit']))
{
    // echo "clicked";
    // get data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // check whether current id password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // execute query
    $res = mysqli_query($conn ,$sql);

    if($res==TRUE)
    {
        // check whether data availabe or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            // user exists and password can be changed
            // echo "user exist";
            // check if new and confirm password match

            if($new_password==$confirm_password)
            {
                // update password
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id=$id
                ";

            // execute query
            $res2 = mysqli_query($conn ,$sql2);

            // check if query executed
            if($res2==TRUE)
            {
                // display success message
                $_SESSION['change-password'] = "<div class='success'>Password changes successfully</div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                // display error message
                $_SESSION['change-password'] = "<div class='error'>Password not changed</div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-admin.php');
            }
            }
            else
            {
                // user doesnot exist / redirect
            $_SESSION['password-not-match'] = "<div class='error'>Password didn't match</div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            // user doesnot exist / redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
            // redirect 
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
        
    }

    

}
?>
<?php include('partials/footer.php'); ?>
