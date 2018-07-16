

<?php include_once('include_header.php'); ?>
<div id="content" class="col-lg-10 col-sm-10">
  <!-- content starts -->
  <!-- <input type="submit" name="submit" value="Get Selected Values" /> -->
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
    Validate_data('global_offering');  //  Displaying Selected Value
    }
    ?>
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2><i class="glyphicon glyphicon-user"></i>Global Offerings</h2>
        </div>
        <div class="box-content">
          <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
            <thead style="background-color: #2fa4e7"`>
              <tr>
                <th>Procurement Reference</th>
                <th>Entity Name (IBM or Third Part Vendor)</th>
                <th>Country</th>
                <th>Is there further sub-contracting to second or third tier vendors ? If so, please provide the full names and full address of 2nd or 3rd tier vendors</th>
                <th>Offering ID (level 30)</th>
                <th>Offering ID (level 40)</th>
                <th>In what category is the Vendor's Service Description ? ( using the categories in GSAR (Global Solution Architecture Repository))</th>
                <th>On Boarding</th>
                <th>Off Boarding</th>
                <th>Offering Owner</th>
                <th>Assessment Owner</th>
                <th>Note</th>
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
                $sql="SELECT COUNT(*) FROM global_offering";
                $rowCount =pagination($sql,[]);
                $total_pages = ceil($rowCount / $no_of_records_per_page);
                $globalTool = getGlobalOffering('global_offering');
                for($i=0; $i < count($globalTool); $i++) {
                               ?>
              <tr>
                <td><?php echo htmlentities($globalTool[$i]['procurement_reference']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['entity_name']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['supplier_address']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['sub_contract_vendors']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['offering_id_30']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['offering_id_40']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['vendor_description']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['on_boarding']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['off_boarding']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['offering_owner']); ?></td>
                <td><?php echo htmlentities($globalTool[$i]['assessment_owner']); ?></td>
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

