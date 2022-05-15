<?php include('partials/menu.php'); ?>  

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //Display session
            unset($_SESSION['add']); //Remove session
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload']; //Display session
            unset($_SESSION['upload']); //Remove session
        }
  ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30 " >
           <tr>
               <td>Title :</td>
               <td>
                   <input type="text" name="title" placeholder="Category Title">
                </td>
               
           </tr>
           <tr>
               <td>Select Image :</td>
               <td>
                   <input type="file" name="image" >
                </td>
               
           </tr>
           <tr>
               <td>Featured :</td>
               <td>
                   <input type="radio" name="featured" value="Yes">Yes
                   <input type="radio" name="featured" value="No">No

                </td>
               
           </tr>
           <tr>
               <td>Active :</td>
               <td>
                   <input type="radio" name="active" value="Yes">Yes
                   <input type="radio" name="active" value="No">No

                </td>
               
           </tr>
           
           <tr>
               <td colspan="2">
                   <input type="submit" name="submit" value="Add Category" class="btn-secondary">
               </td>
           </tr>

        </table>
        </form>

<?php

// process value and check
if(isset($_POST['submit']))
{
// echo "Button clicked";
// get value from category
$title = $_POST['title'];

// for radio button we should check if value is selected or not
if(isset($_POST['featured']))
{
    // get value from form
    $featured = $_POST['featured'];
}
else
{
    // get default value
    $featured = "No";
}
if(isset($_POST['active']))
{
    // get value from form
    $active = $_POST['active'];
}
else
{
    // get default value
    $active = "No";
}

// check whether image is selected or not
// print_r($_FILES['image']);

// die();//break the code here
if(isset($_FILES['image']['name']))
{
    // upload image
    // to upload image we need image source and destination
    $image_name = $_FILES['image']['name']; 

    //auto rename image get extension of image
    $ext = end(explode('.',$image_name)); 

    // rename image
    $image_name = "Food_Category_".rand(000,999).'.'.$ext;

    $source_path = $_FILES['image']['tmp_name'];
    $destination_path = "../images/category/".$image_name;

    // finally upload image
    $upload = move_uploaded_file($source_path, $destination_path);

    // check whether image is uploaded or not
    // if image is not uploaded then the stop process and redirect error message
    if($upload==false)
    {
        $_SESSION['upload'] = "<div class='error'>Image uploaded failed</div>";
    // redirect to add category  page
    header('location:'.SITEURL.'admin/add-category.php');

    die();
    }
}
else
{
    // donot upload image and set image as blank
    $image_name="";
}

// create sql query to insert category into database
$sql = "INSERT INTO tbl_category SET
title = '$title',
image_name = '$image_name',
featured = '$featured',
active = '$active'
";

// execute query
$res = mysqli_query($conn, $sql);

// check if query is executed successfuly
if($res==TRUE)
{
    // Query executed and category added
    $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    // query not executed
    $_SESSION['add'] = "<div class='error'>Category Failed to Added</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/add-category.php');
}
}
?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

