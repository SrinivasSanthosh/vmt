<?php
if(isset($_REQUEST['page'])){
    //Include Pagination class file
    include('functions.php');
    include('pagination.php');
    
    //Include database configuration file
    //include('dbConfig.php');
    ?>
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
    //Include Pagination class file(filename)
    
    //Include database configuration file
    //include('dbConfig.php');
    $start = !empty($_REQUEST['page'])?$_REQUEST['page']:0;
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
    $query = mysqli_query($conn, "SELECT * FROM sbliw LIMIT $start,$limit");
    
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

        <?php echo $pagination->createLinks(); ?>
<?php 
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>