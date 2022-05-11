<?php include('partials/menu.php'); ?>  
  <!-- content   -->
<div class="main-content">
<div class="wrapper"> 
  <h1>Manage Admin</h1>
  <br/> <br/>
  <?php
  if(isset($_SESSION['add'])){
      echo $_SESSION['add']; //Display session
      unset($_SESSION['add']); //Remove session
  }
  if(isset($_SESSION['delete'])){
    echo $_SESSION['delete']; //Display session
    unset($_SESSION['delete']); //Remove session
}
  ?>
  <br>
  <br>
  
  <a href="add-admin.php" class="btn-primary">Add Admin</a>
  <br/> 
  <br/> <br/> 
       <table class="tbl-full"  >
           <tr>
               <th>S.N</th>
               <th>Full Name</th>
               <th>Username</th>
               <th>Actions</th>
           </tr>

           <?php
        //    query to get all data
            $sql = "SELECT * FROM tbl_admin";

            // execute query
            $res = mysqli_query($conn, $sql);
            // check whether query is executed or not
            if($res==TRUE)
            {
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
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // display the values in table
                        ?>
                        <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                        <a href="#" class="btn-secondary"> Update</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger"> Delete</a>
                        </td>

           </tr>

                        <?php
                    }
                }
                else
                {
                    // we donot have data in db
                }
            }
           ?>
            
            
       </table>
    <div class="clearfix"></div> 
    </div>        
</div>

  <!-- content ends -->
  <?php include('partials/footer.php'); ?>