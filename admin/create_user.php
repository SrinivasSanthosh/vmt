<?php include_once('include_header.php');
include_once('functions.php') ?>
<div id="content" class="col-lg-10 col-sm-10">

	 <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Users Insert date</h2>
        </div>
        <div class="box-content">
        <form action="" method="post">
        	<h2>Enter User details</h2>	
        	<label>Username</label>
        	<input class="input" name="name" type="text" value="">
        	<input class="submit" name="submit" type="submit" value="Insert">
		</form>
          
        </div>
      </div>
    </div>
    <!--/span-->

  </div><!--/row-->

<?php
if (isset($_POST['name'])){

$email = $_POST['name'];
  $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
 if (preg_match($regex, $email)) {
 // echo $email . " is a valid email. We can accept it.";
 createuser($_POST['name']);
 } else { 
  echo $email . " is an invalid email. Please try again.";
 }  
}
?> 


  <!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<hr>
<?php include_once('footer.php'); ?>
