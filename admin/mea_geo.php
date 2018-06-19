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
Validate_data('mea_geo');  //  Displaying Selected Value
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
               <th>procurement_vendor_id</th>
               <th>Supplier Name</th>
               <th>Full Supplier address</th>
               <th>VAT Number</th>
               <th>PO Number (if first tier vendor) or ICA- DOU (if IBM entity or IBM Subsidiary)</th>
               <th>Is the PO GDPR Relevant ?</th>
               <th>If there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors</th>
               <th>Briefly describe the type of services/ data processing activity performed by the Vendor</th>
               <th>In what category is the Vendor's Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))</th>
               <th>PO Status</th>
               <th>Start Date</th>
               <th>End Date</th>
               <th>Business Unit that provide the services through this vendor</th>
               <th>Requester/ Approver Name</th>
               <th>Please identify the Customer(s) or Account(s) under the PO</th>
               <th>Note</th>
               <th>Account Component</th>
             </tr>
           </thead>
           <tbody>
            <?php
            $globalTool = getmeageo('mea_geo');
            for($i=0; $i < count($globalTool); $i++) {
              ?>
              <tr>
                <td><?php echo $globalTool[$i]['procurement_vendor']; ?></td>
                <td><?php echo $globalTool[$i]['supplier_name']; ?></td>
                <td><?php echo $globalTool[$i]['full_supplier_address']; ?></td>
                <td><?php echo $globalTool[$i]['vat_number']; ?></td>
                <td><?php echo $globalTool[$i]['po_number']; ?></td>
                <td><?php echo $globalTool[$i]['po_relevant']; ?></td>
                <td><?php echo $globalTool[$i]['sub_contract_vendors']; ?></td>
                <td><?php echo $globalTool[$i]['describe_service']; ?></td>
                <td><?php echo $globalTool[$i]['vendor_service']; ?></td>
                <td><?php echo $globalTool[$i]['po_status']; ?></td>
                <td><?php echo $globalTool[$i]['start_date']; ?></td>
                <td><?php echo $globalTool[$i]['end_date']; ?></td>
                <td><?php echo $globalTool[$i]['business_unit']; ?></td>
                <td><?php echo $globalTool[$i]['requester_approver']; ?></td>
                <td><?php echo $globalTool[$i]['identify_customer']; ?></td>
                <td><?php echo $globalTool[$i]['note']; ?></td>
                <td><?php echo $globalTool[$i]['account_component']; ?></td>
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
 