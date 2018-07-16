<?php include_once('include_header.php'); ?>
<div id="content" class="col-lg-10 col-sm-10">
<<<<<<< HEAD
   <div class="row">
      <div class="box col-md-12">
         <div class="box-inner">
            <div class="box-header well" data-original-title="">
               <h2><i class="glyphicon glyphicon-user"></i>Users Table Query</h2>
            </div>
            <div class="box-content">
               <form action="admin_post.php" method="post">
                  <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                     <thead style="background-color: #2fa4e7">
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
                           if (isset($_GET['pageno'])) {
                                      $pageno = $_GET['pageno'];
                                    } else {
                                      $pageno = 1;
                                    }
                                    $no_of_records_per_page = 10;
                                    $offset = ($pageno-1) * $no_of_records_per_page;
                                    $conn  = connDB();
                                    $sql="SELECT COUNT(*) FROM users";
                                    $rowCount =pagination($sql,[]);
                                    $total_pages = ceil($rowCount / $no_of_records_per_page);
                                    $User_data = getUsers();
                                    for($i=0; $i < count($User_data); $i++) {
                                                      ?>
                        <tr>
                           <td><?php echo htmlentities($User_data[$i]['id']); ?></td>
                           <td><?php echo htmlentities($User_data[$i]['username']); ?></td>
                           <td><input type="checkbox" name="ADMIN[<?php echo htmlentities($User_data[$i]['id']) ?>]" value="1" <?php echo htmlentities(($User_data[$i]['admin']==1 ? 'checked' : '')); ?> />&nbsp;</td>
                           <td><?php echo htmlentities($User_data[$i]['created_date']); ?></td>
                           <td><?php echo htmlentities($User_data[$i]['updated_date']); ?></td>
                           <td><input type='hidden' name="ID[]" value=<?php echo htmlentities($User_data[$i]['id']) ?> />&nbsp;</td>
                        </tr>
                        <?php } ?>
                        <ul class="pagination">
                           <li style="color: blue"><a href="?pageno=1" >First</a></li>
                           <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                              <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                           </li>
                           <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                              <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                           </li>
                           <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                        </ul>
                     </tbody>
                  </table>
                  <input type="submit" name="submit" value="Submit!" class="btn btn-primary">
               </form>
            </div>
         </div>
      </div>
   </div>
   <!--/row-->
</div>
<!--/#content.col-md-0-->
</div><!--/fluid-row-->
<hr>
<?php include_once('footer.php'); ?>

=======
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
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
