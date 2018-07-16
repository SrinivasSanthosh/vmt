<?php include_once('include_header.php'); ?>
<div id="content" class="col-lg-10 col-sm-10">
<<<<<<< HEAD
  <form action="" method="post" enctype="multipart/form-data">
    <input type="radio" name="load_type" value="Append Data" checked> Append To Existing Data
    <input type="radio" name="load_type" value="Fresh_Upload"> Fresh Upload Of Data<br><br>
    Select File to upload:
    <br><input type="file" name="fileToUpload" id="fileToUpload">
    <br><input type="submit" value="Upload File" name="submit">
  </form>
  <?php
    if (isset($_REQUEST['submit'])) {
    // print $_REQUEST('load_type');
    Validate_data('ibm_data_center');  //  Displaying Selected Value
    }
    ?>
=======
 

 <form action="" method="post" enctype="multipart/form-data">
  <input type="radio" name="load_type" value="Append Data" checked> Append To Existing Data
  <input type="radio" name="load_type" value="Fresh_Upload"> Fresh Upload Of Data<br><br>
    Select File to upload:
    <br><input type="file" name="fileToUpload" id="fileToUpload">
    <br><input type="submit" value="Upload File" name="submit">
</form>
  

<?php
if (isset($_REQUEST['submit'])) {
// print $_REQUEST('load_type');
Validate_data('ibm_data_center');  //  Displaying Selected Value
}
?>


>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Query from ibm Data Center</h2>
        </div>
        <div class="box-content">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
<<<<<<< HEAD
            <thead  style="background-color: #2fa4e7">
              <tr>
                <th>procurement_vendor</th>
                <th>supplier_name</th>
                <th>address_country</th>
                <th>service_area</th>
                <th>subcontract_vendor</th>
                <th>identify_customer</th>
                <th>imt</th>
                <th>iot</th>
                <th>note</th>
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
                $sql="SELECT COUNT(*) FROM ibm_data_center";
                $rowCount =pagination($sql,[]);
                $total_pages = ceil($rowCount / $no_of_records_per_page);
                 $globalTool = getdata_centre('ibm_data_center');
                 for($i=0; $i < count($globalTool); $i++) {
                   ?>
              <tr>
                <td><?php echo htmlentities($globalTool[$i]['procurement_vendor']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['supplier_name']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['address_country']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['service_area']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['subcontract_vendor']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['identify_customer']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['imt']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['iot']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['note']); ?></td>
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
=======
            <thead>
              <tr>
               <th>procurement_vendor</th>
               <th>supplier_name</th>
               <th>address_country</th>
               <th>service_area</th>
               <th>subcontract_vendor</th>
               <th>identify_customer</th>
               <th>imt</th>
               <th>iot</th>
               </tr>
           </thead>
           <tbody>
            <?php
            $globalTool = getdata_centre('ibm_data_center');
            for($i=0; $i < count($globalTool); $i++) {
              ?>
              <tr>
                <td><?php echo $globalTool[$i]['procurement_vendor']; ?></td>
                <td><?php echo $globalTool[$i]['supplier_name']; ?></td>
                <td><?php echo $globalTool[$i]['address_country']; ?></td>
                <td><?php echo $globalTool[$i]['service_area']; ?></td>
                <td><?php echo $globalTool[$i]['subcontract_vendor']; ?></td>
                <td><?php echo $globalTool[$i]['identify_customer']; ?></td>
                <td><?php echo $globalTool[$i]['imt']; ?></td>
                <td><?php echo $globalTool[$i]['iot']; ?></td>
               </tr>
              <?php } ?>

>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!--/span-->
<<<<<<< HEAD
  </div>
  <!--/row-->
  <!-- content ends -->
</div>
<!--/#content.col-md-0-->
</div><!--/fluid-row-->
<hr>
<?php include_once('footer.php'); ?>

=======

  </div><!--/row-->




  <!-- content ends -->
</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
<hr>
<?php include_once('footer.php'); ?>
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
