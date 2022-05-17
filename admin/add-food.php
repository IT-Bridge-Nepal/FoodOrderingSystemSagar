<?php include('partials/menu.php'); ?>  

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food </h1>
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
                   <input type="text" name="title" placeholder=" Title">
                </td>
               
           </tr>
           <tr>
               <td>Description :</td>
               <td>
                   <textarea  name="description" cols="30" rows="5" placeholder="Description "></textarea>
                </td>
               
           </tr>
           <tr>
               <td>Price :</td>
               <td>
                   <input type="number" name="price" >
                </td>
               
           </tr>
           
           <tr>
               <td>Select Image :</td>
               <td>
                   <input type="file" name="image" >
                </td>
               
           </tr>
           <tr>
               <td> Category :</td>
               <td>
                   <select name="category">
                       <?php
                        // php code to display categories from db

                        // create sql to get all active categories from db
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        
                        // execute query
                        $res = mysqli_query($conn , $sql);

                        // count rows to check whether we have catogory or not
                        $count = mysqli_num_rows($res);

                        // if count > 0 we have  categories
                        if($count>0)
                        {
                            //we have categories
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // get details of categories
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>
                                <option value="<?php echo $id ;?>"><?php echo $title ;?></option>

                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <option value="0">No category found</option>
                            <?php

                        }
                        // display on dropdown


                        ?>
                       
                       

                   </select>
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
                   <input type="submit" name="submit" value="Add Food" class="btn-secondary">
               </td>
           </tr>

        </table>
        </form>

        <?php
        // check whether button is clicked
        if(isset($_POST['submit']))
        {
            // Add data to db
            // echo "clicked";

        // get value from category
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];


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

    // upload image if image is selected only
    if($image_name !='')
    {

    //auto rename image get extension of image
    $ext = end(explode('.',$image_name)); 

    // rename image
    $image_name = "Food_Category_".rand(0000,9999).'.'.$ext;

    $source_path = $_FILES['image']['tmp_name'];
    $destination_path = "../images/food/".$image_name;
    

    // finally upload image
    $upload = move_uploaded_file($source_path, $destination_path);

    // check whether image is uploaded or not
    // if image is not uploaded then the stop process and redirect error message
    if($upload==false)
    {
        $_SESSION['upload'] = "<div class='error'>Image uploaded failed</div>";
    // redirect to add category  page
    header('location:'.SITEURL.'admin/add-food.php');

    die();
    }
}
}
else
{
    // donot upload image and set image as blank
    $image_name="";
}

// create sql query to insert category into database
// for numerical value we dont need to pass inside ''  quote
$sql2 = "INSERT INTO tbl_food SET
title = '$title',
description = '$description',
price = $price,
image_name = '$image_name',
category_id = '$category',
featured = '$featured',
active = '$active'
";

// execute query
$res2 = mysqli_query($conn, $sql2);

// check if query is executed successfuly
if($res2==TRUE)
{
    // Query executed and category added
    $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    // query not executed
    $_SESSION['add'] = "<div class='error'>Food Failed to Added</div>";
    // redirect to manage admin page
    header('location:'.SITEURL.'admin/add-food.php');
}
}

        ?>



    </div>
</div>
<?php include('partials/footer.php'); ?>
