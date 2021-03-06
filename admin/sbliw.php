<?php include_once('include_header.php'); ?>
<div id="content" class="col-lg-10 col-sm-10">
  <!-- content starts -->


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
Validate_data('sbliw');  //  Displaying Selected Value
}
?>


  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>SBLIW Data</h2>
        </div>
        <div class="box-content" id="box-content">
          <table class="table table-striped ">
            <thead>
              <tr>
                <th>igs_ctry_grp_nm</th>
               <th>iso_ctry_nm</th>
               <th>bus_measmt_div_nm</th>
               <th>offrg_cmpnt_cd</th>
               <th>owng_org_cd</th>
               <th>cust_nm</th>
               <th>lgl_cntrct_id</th>
               <th>proj_id</th>
               <th>cntrct_end_dt</th>
               <th>service_line_cd</th>
               </tr>
           </thead>
           <tbody>
            

    <?php
    //Include Pagination class file
    include('pagination.php');
    
    //Include database configuration file
    //include('dbConfig.php');
    
    $limit = 10;
    global $conn;
    //Get the total number of rows
    $queryNum = mysqli_query($conn, "SELECT COUNT(*) as postNum FROM sbliw");
    $resultNum = mysqli_fetch_assoc($queryNum);
    $rowCount = $resultNum['postNum'];
    
    //Initialize Pagination class and create object
    $pagConfig = array('baseURL'=>'getsbliw.php', 'totalRows'=>$rowCount, 'perPage'=>$limit, 'contentDiv'=>'box-content');
    $pagination =  new Pagination($pagConfig);
    
    //Get rows
    $query = mysqli_query($conn, "SELECT * FROM sbliw LIMIT $limit");
    
    if($rowCount > 0){ ?>
        <?php
            while($row = $query->fetch_assoc()){ 
                // $postID = $row['id'];
        ?>
           <tr>
                <td><?php echo $row["igs_ctry_grp_nm"]; ?></td>
               <td><?php echo $row["iso_ctry_nm"]; ?></td>
               <td><?php echo $row["bus_measmt_div_nm"]; ?></td>
               <td><?php echo $row["offrg_cmpnt_cd"]; ?></td>
               <td><?php echo $row["owng_org_cd"]; ?></td>
               <td><?php echo $row["cust_nm"]; ?></td>
               <td><?php echo $row["lgl_cntrct_id"]; ?></td>
               <td><?php echo $row["proj_id"]; ?></td>
               <td><?php echo $row["cntrct_end_dt"]; ?></td>
               <td><?php echo $row["service_line_cd"]; ?></td>
               </tr>
        <?php } ?>

        <?php echo $pagination->createLinks(); ?>
    <?php } ?>



            </tbody>
          </table>
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
