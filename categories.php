<?php include('partials-front/menu.php') ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
    // create sql query to display category from database
    $sql = "SELECT * FROM tbl_category WHERE featured='Yes' AND active='Yes' LIMIT 3 ";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    // var_dump($conn);
    // die();
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];

    ?>
        <a href="category-foods.php">
          <div class="box-3 float-container">
            <?php
            if ($image_name == "") {
              echo 'Image not available';
            } else {
            ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <?php
            }
            ?>

            <h3 class="float-text text-white"><?php echo $title; ?></h3>
          </div>
        </a>
    <?php

      }
    } else {
      echo 'Category not available';
    }
    ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   

    <?php include('partials-front/footer.php') ?>
