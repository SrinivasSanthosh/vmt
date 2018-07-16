<<<<<<< HEAD


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
      Validate_data('na_geo');  //  Displaying Selected Value
      }
      ?>
   <div class="row">
      <div class="box col-md-12">
         <div class="box-inner">
            <div class="box-header well" data-original-title="">
               <h2><i class="glyphicon glyphicon-user"></i>Query from Na</h2>
            </div>
            <div class="box-content">
               <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                  <thead style="background-color: #2fa4e7">
                     <tr>
                        <th>Procurement Vendor ID</th>
                        <th>Supplier Name</th>
                        <th>Country</th>
                        <th>Subcontractors</th>
                        <th>Vendor_Service </th>
                        <th>Requester_Approver </th>
                        <th>Customer_Identified </th>
                        <th>Note </th>
                        <th> Market</th>
                        <th>Retention_Period </th>
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
                        $sql="SELECT COUNT(*) FROM na_geo";
                        $rowCount =pagination($sql,[]);
                        $total_pages = ceil($rowCount / $no_of_records_per_page);
                        $globalTool = getnageo('na_geo');
                        for($i=0; $i < count($globalTool); $i++) {
                            ?>
                     <tr>
                        <td><?php echo htmlentities($globalTool[$i]['procurement_vendor_id']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['supplier_name']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['country ']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['sub_contract_vendors ']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['vendor_service ']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['requester_approver']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['customer_identified ']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['note']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['market']); ?></td>
                        <td><?php echo htmlentities($globalTool[$i]['retention_period ']); ?></td>
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
Validate_data('na_geo');  //  Displaying Selected Value
}
?>


  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Query from Europe</h2>
        </div>
        <div class="box-content">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead>
              <tr>
                <th>PO Number (if first tier vendor) or ICA- DOU (if IBM entity or IBM Subsidiary)</th>
               <th>Procurement Vendor ID</th>
               <th>Supplier Name</th>
               <th>Full Supplier Address</th>
               <th>VAT Number</th>
               <!-- <th>Subcontractors</th> -->
               <th>Is the PO GDPR Relevant ?</th>
               <th>If there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors</th>
               
               <!-- <th>Family Code</th>
              <th>PO/ BSAP/ ICA/ DOU full description</th> -->
               <th>Briefly describe the type of services/ data processing activity performed by the Vendor</th>
               <!-- <th>Service Category was identified (Y/N)</th> -->
               <th>In what category is the Vendor's Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))</th>
               <th>PO Status</th>
               <th>Start Date</th>
               <th>End Date</th>
               <!-- <th>PO/ ICA Amount</th> -->
               <th>Business Unit that provide the services through this vendor</th>
               <th>Requester/ Approver Name</th>
               <!-- <th>Customer Identified</th> -->
               <th>Please identify the Customer(s) or Account(s) under the PO</th>
               <th>Note</th>
               <th>FP - T&M</th>
               <th>Country</th>
               <!-- <th>Is the PO GDPR Relevant ?</th> -->
               <!-- <th>Market</th>
               <th>Market Note</th>
               <th>Action Owner</th>
               <th>Data Input Completed? Yes/ No/ Partial</th>
               <th>Next Person to Chase</th>
               <th>Checked Ok</th>
               <th>Should the PO be closed immediately? Yes or No</th> -->
             </tr>
           </thead>
           <tbody>
            <?php
            $globalTool = getnageo('na_geo');
            for($i=0; $i < count($globalTool); $i++) {
              ?>
              <tr>
                <td><?php echo $globalTool[$i]['po_number']; ?></td>
                <td><?php echo $globalTool[$i]['procurement_vendor_id']; ?></td>
                <td><?php echo $globalTool[$i]['supplier_name']; ?></td>
                <td><?php echo $globalTool[$i]['full_supplier_address']; ?></td>
                <td><?php echo $globalTool[$i]['vat_number']; ?></td>
                <!-- <td><?php echo $globalTool[$i]['subcontractor']; ?></td> -->
                
                <td><?php echo $globalTool[$i]['po_number']; ?></td>
                <td><?php echo $globalTool[$i]['po_relevant']; ?></td>
                <td><?php echo $globalTool[$i]['sub_contract_vendors']; ?></td>
                <!-- <td><?php echo $globalTool[$i]['family_code']; ?></td> -->
                <!-- <td><?php echo $globalTool[$i]['po_bsap_ica']; ?></td> -->
                <!-- <td><?php echo $globalTool[$i]['describe_service']; ?></td> -->
                <!-- <td><?php echo $globalTool[$i]['service_category']; ?></td> -->
                <td><?php echo $globalTool[$i]['vendor_service']; ?></td>
                <td><?php echo $globalTool[$i]['po_status']; ?></td>
                <td><?php echo $globalTool[$i]['start_date']; ?></td>
                <td><?php echo $globalTool[$i]['end_date']; ?></td>
                <!-- <td><?php echo $globalTool[$i]['po_ica_amount']; ?></td> -->
                <td><?php echo $globalTool[$i]['business_unit']; ?></td>
                <td><?php echo $globalTool[$i]['requester_approver']; ?></td>
                <td><?php echo $globalTool[$i]['customer_identified']; ?></td>
                <!-- <td><?php echo $globalTool[$i]['customer_under_po']; ?></td> -->
                <td><?php echo $globalTool[$i]['note']; ?></td>
                
                <!-- <td><?php echo $globalTool[$i]['market']; ?></td>
                <td><?php echo $globalTool[$i]['market_done']; ?></td>
                <td><?php echo $globalTool[$i]['action_owner']; ?></td>
                <td><?php echo $globalTool[$i]['data_input_complete']; ?></td>
                <td><?php echo $globalTool[$i]['next_person_chase']; ?></td>
                <td><?php echo $globalTool[$i]['check_ok']; ?></td>-->
                <td><?php echo $globalTool[$i]['fp']; ?></td> 
                 <td><?php echo $globalTool[$i]['country']; ?></td> 
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
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
