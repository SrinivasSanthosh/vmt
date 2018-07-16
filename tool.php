<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
<div class="col-lg-10 col-md-10">
   <div class="container-fixed">
      <div class="row">
         <div class="col-lg-3 col-md-3">
            <div class="well">
               <h3 class="text-success text-center">
               <i class="fa fa-fw fa-wrench" style="font-size:48px;"></i>  Tool Search</h2>
               </br></br>
            </div>
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="well">
               <form action="" method="post" accept-charset="utf-8">
                  <select multiple="multiple" placeholder="Select a Tool" onchange="console.log($(this).children(':selected').length)" class="search-box" name="vendor[]">
                     <?php $sql = "SELECT distinct(tool_name) FROM global_tool";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        if($query->rowCount() > 0)
                        {
                        	foreach($results as $result)
                        		{				?>	
                     <option value="<?php echo htmlentities($result->tool_name);?>"> <?php echo htmlentities($result->tool_name);?></option>
                     <?php }} ?>
                  </select>
                  </br></br>
                  <button class="btn btn-success btn-md btn-block" style="margin-top:10px;" type="submit" name="filtervendor">
                  Search
                  </button>
                  </br>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
<div class="container-table100">
   <?php 
      if(isset($_POST['filtervendor']))
      { 
      	$name=$_POST['vendor'];
      	$valu=implode("','", $name);
      	showVendorTable1(getVendorData_1($_REQUEST['vendor']));
      	showVendorTable_count(getVendorData_count($_REQUEST['vendor']));
      	?>	
   <?php  } ?>
   </tbody>
   </table>
</div>
</div>
</div>
</div>
<?php 
   include_once('footer.php'); 
   ?>