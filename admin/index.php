<?php include('partials/menu.php'); ?>  
  <!-- content   -->
<div class="main-content">
<div class="wrapper"> 
  <h1>DASHBOARD</h1>
  <br><br>
 <?php
  if(isset($_SESSION['login']))
  {
      echo $_SESSION['login']; //Display session
      unset($_SESSION['login']); //Remove session
  }
  ?>
  <br><br>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br/>
            Categories   
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br/>
            Categories   
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br/>
            Categories   
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            <br/>
            Categories   
        </div>
    <div class="clearfix"></div> 
    </div>        
</div>

  <!-- content ends -->
  <?php include('partials/footer.php'); ?> 
  