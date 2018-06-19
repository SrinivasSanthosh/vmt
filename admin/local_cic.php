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
Validate_data('ibm_local_cic');  //  Displaying Selected Value
}
?>


  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Query from ibm_local_cic</h2>
        </div>
        <div class="box-content">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
              <tr>
               <th>ID</th>
               <th>IBM CIC Name</th>
               <th>IBM CIC full address </th>
               <th>Country</th>
               <th>Is Your CIC delivering this service</th>
               <th>IBM Entity Name or 3rd Party Vendor name</th>
               <th>Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors </th>
               <th>Service Area</th>
               <th>GSO</th>
               <th>Service Area Contact Owner</th>
               <th>Assesment Owner</th>
               <th>NOTE</th>
           </tr>
           </thead>
           <tbody>
            <?php
            $globalTool = getglobal_cic('ibm_local_cic');
            for($i=0; $i < count($globalTool); $i++) {
              ?>
              <tr>
                <td><?php echo $globalTool[$i]['id']; ?></td>
                <td><?php echo $globalTool[$i]['ibm_cic_name']; ?></td>
                <td><?php echo $globalTool[$i]['ibm_cic_address']; ?></td>
                <td><?php echo $globalTool[$i]['country']; ?></td>
                <td><?php echo $globalTool[$i]['cic_delivering_service']; ?></td>
                <td><?php echo $globalTool[$i]['entity_name']; ?></td>
                <td><?php echo $globalTool[$i]['sub_contracting_vendor']; ?></td>
                <td><?php echo $globalTool[$i]['service_area']; ?></td>
                <td><?php echo $globalTool[$i]['gso']; ?></td>
              <td><?php echo $globalTool[$i]['service_contact']; ?></td>
              <td><?php echo $globalTool[$i]['assesment_owner']; ?></td>
              <td><?php echo $globalTool[$i]['note']; ?></td>
              </tr>
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
