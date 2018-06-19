<?php include_once('include_header.php'); ?>
<div id="content" class="col-lg-10 col-sm-10">
	 <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Users Table Query</h2>
        </div>
        <div class="box-content">
        	<form action="admin_post.php" method="post">

          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
              <tr>
               <th>ID</th>
               <th>USERNAME</th>
               <th>ADMIN ACCESS</th>
               <th>CREATED DATE</th>
               <th>UPDATED DATE</th>
              </tr>
           </thead>
           <tbody>
            <?php
            $User_data = getUsers();
            for($i=0; $i < count($User_data); $i++) {
            	?>
				<tr>
                <td><?php echo $User_data[$i]['id']; ?></td>
                <td><?php echo $User_data[$i]['username']; ?></td>

                <td><input type="checkbox" name="ADMIN[<?php echo $User_data[$i]['id'] ?>]" value="1" <?php echo ($User_data[$i]['admin']==1 ? 'checked' : ''); ?> />&nbsp;</td>
                <td><?php echo $User_data[$i]['created_date']; ?></td>
                <td><?php echo $User_data[$i]['updated_date']; ?></td>
                <td><input type='hidden' name="ID[]" value=<?php echo $User_data[$i]['id'] ?> />&nbsp;</td>
            </tr>
				<?php } ?>
			</tbody>
          </table>
          <input type="submit" name="submit" value="Submit!">
      </form>
        </div>
      </div>
    </div>
    <!--/span-->
  </div><!--/row-->
 <!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<hr>
<?php include_once('footer.php'); ?>