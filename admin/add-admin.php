<?php include('partials/menu.php'); ?>  

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //Display session
            unset($_SESSION['add']); //Remove session
        }
  ?>
        <form action="" method="POST">
        <table class="tbl-30 "  >
           <tr>
               <td>Full Name:</td>
               <td>
                   <input type="text" name="full_name" placeholder="Enter your Name!!!">
                </td>
               <td></td>
           </tr>
           <tr>
               <td>Username :</td>
               <td>
                   <input type="text" name="username" placeholder="Enter your UserName!!!">
                </td>
               <td></td>
           </tr>
           <tr>
               <td>Password:</td>
               <td>
                   <input type="password" name="password" placeholder="Enter your Password!!!">
                </td>
               <td></td>
           </tr>
           
           <tr>
               <td colspan="2">
                   <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
               </td>
           </tr>

        </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
// process value and check
if(isset($_POST['submit']))
{
// echo "Button clicked";

// get data from form
    $full_name= $_POST["full_name"];
    $username= $_POST["username"];
    $password= md5($_POST["password"]);  //Password encryption

    // sql query to save data in db

    $sql = "INSERT INTO tbl_admin SET 
    full_name = '$full_name',
    username = '$username',
    password = '$password'
    ";
    // execute query and add to db 
    $res = mysqli_query($conn, $sql) or die(mysqli_error($e));

    // check if data is inserted
    if($res==TRUE)
    {
        // echo "Data Inserted";
        // session
        $_SESSION['add'] = "Admin added successfully";
        // redirect page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // echo "Data not inserted";
        // session
        $_SESSION['add'] = "Failed to add admin";
        // redirect page
        header("location:".SITEURL.'admin/add-admin.php');
    }
}

?>