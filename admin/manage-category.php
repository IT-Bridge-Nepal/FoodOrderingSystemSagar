<?php include('partials/menu.php'); ?>  
  <!-- content   -->
<div class="main-content">
<div class="wrapper"> 
  <h1>Add Category</h1>

  <br/> <br/> <br/>
  <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add']; //Display session
            unset($_SESSION['add']); //Remove session
        }
        if(isset($_SESSION['remove'])){
            echo $_SESSION['remove']; //Display session
            unset($_SESSION['remove']); //Remove session
        }
        if(isset($_SESSION['delete'])){
            echo $_SESSION['delete']; //Display session
            unset($_SESSION['delete']); //Remove session
        }
        if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found']; //Display session
            unset($_SESSION['no-category-found']); //Remove session
        }
        if(isset($_SESSION['update'])){
            echo $_SESSION['update']; //Display session
            unset($_SESSION['update']); //Remove session
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload']; //Display session
            unset($_SESSION['upload']); //Remove session
        }
        if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove']; //Display session
            unset($_SESSION['failed-remove']); //Remove session
        }
  ?><br><br>
  <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
  <br/> 
  <br/> <br/> 
       <table class="tbl-full"  >
           <tr>
               <th>S.N</th>
               <th>Title</th>
               <th>Image</th>
               <th>Featured</th>
               <th>Active</th>
               <th>Actions</th>
           </tr>
           <?php
        //    query to get all data
            $sql = "SELECT * FROM tbl_category";

            // execute query
            $res = mysqli_query($conn, $sql);
            // check whether query is executed or not
            
                $count = mysqli_num_rows($res);//function to get all rows in db
                $sn=1; // create variable and assign value
                // CHECK NO OF ROWS
                if($count>0)
                {
                    // we have data in db
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        // using while loop to get all data
                        // get individual data
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
                        ?>
                        <tr>
                        <td><?php echo $sn++; ?></td>
                          <td><?php echo $title; ?></td>
                          <td>
                              <?php
                                if($image_name!="")
                                {
                                    // display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"width="100px">
                                    <?php

                                }
                                else
                                {
                                    // display error message
                                    echo "<div class=error>Image not added</div>";

                                }
                              ?>
                          </td>
                          <td><?php echo $featured; ?></td>
                          <td><?php echo $active; ?></td>
               <td>
                   <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary"> Update Category</a>
                   <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Category</a>
               </td>

           </tr>
           <?php
                    }
                }
                
                else
                {
                    // we dont have data
                    // we will display message inside table
                
                        // display the values in table
                        ?>
                        <tr>
                            <td colspan="6"><div class="error">No category added</div>

                            </td>
                        </tr>
                        <?php
                        }
           ?>
           
       </table>     
    <div class="clearfix"></div> 
    </div>        
</div>

  <!-- content ends -->
  <?php include('partials/footer.php'); ?>