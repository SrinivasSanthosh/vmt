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
               <i class="fa fa-fw fa-map-marker" style="font-size:48px;"></i>  Service Area</h2>
               </br></br>
            </div>
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="well">
               <form action="" method="post" accept-charset="utf-8">
                  <select multiple="multiple" placeholder="Select Service Area" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalsa[]">
                     <?php $sql = "SELECT distinct(service_area) FROM ibm_local_cic";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                                {               ?>  
                     <option value="<?php echo htmlentities($result->service_area); ?>" title="<?php echo htmlentities($result->service_area); ?>"><?php echo htmlentities($result->service_area); ?></option>
                     <?php }} ?>
                  </select>
                  </br></br>
                  <button class="btn btn-success btn-md btn-block" style="margin-top:10px;" type="submit" name="filter">
                  Search
                  </button></br>
               </form>
            </div>
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="well">
               <h3 class="text-primary text-center"><i class="fa fa-fw fa-sitemap" style="font-size:48px;"></i> CIC Name</h3>
               </br></br>
            </div>
         </div>
         <div class="col-lg-3 col-md-3">
            <div class="well">
               <form action="" method="post" accept-charset="utf-8">
                  <?php 
                     $select = getSelectCICID('local');
                     ?>
                  <select multiple="multiple" placeholder="Select IBM CIC Name" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalcic[]">
                     <?php $sql = "SELECT distinct(id) FROM ibm_local_cic";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                                {               ?>  
                     <option value="<?php echo htmlentities($result->id); ?>" title="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->id); ?></option>
                     <?php }} ?>
                  </select>
                  </br></br>
                  <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filtergc">
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
      if(isset($_REQUEST['filtergc']) || isset($_REQUEST['filter'])) 
      {
         ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
      if(isset($_REQUEST['globalcic']) && ($_REQUEST['globalcic'] != '')) 
      {
       showSATable(getSAIDData($_REQUEST['globalcic'],'local'));
             //  showPivotSATable(getPivotSAData($_REQUEST['globalcic'],'local'));
      } else if(isset($_REQUEST['globalsa']) && ($_REQUEST['globalsa'] != '')) 
      {
       showCICTable(getCICData($_REQUEST['globalsa'],'local'));
              // showPivotCICTable(getPivotCICData($_REQUEST['globalsa'],'local'));
      }
      }
      ?>
</div>
<?php 
   include_once('footer.php'); ?>