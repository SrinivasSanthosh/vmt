<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
<div class="col-lg-10 col-md-10">
   <div class="container-fixed">
      <div class="col-lg-3 col-md-3">
         <div class="well">
            <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i> Offering Search</h3>
            </br>
         </div>
      </div>
      <div class="col-lg-3 col-md-3">
         <div class="well">
            <form action="" method="post" accept-charset="utf-8">
               <div class="offering">
                  <div class="customer-search-span">
                     <select id="sourcelist" class="form-control" multiple="multiple" name='source[]'>
                        <?php 
                           $sql = "select distinct offering_id_30,offering_id_40 from global_offering";
                           $query = $dbh -> prepare($sql);
                           $query->execute();
                           $results=$query->fetchAll(PDO::FETCH_OBJ);
                           
                           if($query->rowCount() > 0)
                           {
                            foreach($results as $result)
                                {               ?>  
                        <option value="<?php echo htmlentities($result->offering_id_30);?>" title="<?php echo htmlentities($result->offering_id_30);?>"><?php echo htmlentities($result->offering_id_30);?></option>
                        <option value="<?php echo htmlentities($result->offering_id_40);?>" title="<?php echo htmlentities($result->offering_id_40);?>"><?php echo htmlentities($result->offering_id_40);?></option>
                        <?php }} ?>
                     </select>
                  </div>
               </div>
               </br>
               <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filter_new">
               Search
               </button></br>
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
      if(isset($_REQUEST['filter_new'])) {
          ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
      if(isset($_REQUEST['source']) && ($_REQUEST['source'] != '')) {
          showTablee(getCustomerDataa($_REQUEST['source']));
      }
      else if(isset($_REQUEST['custgeo']) && ($_REQUEST['custgeo'] != '')) {
          showGeoTable(getGeoData($_REQUEST['custgeo'], array($_REQUEST['geo_search'])));
      }
      }
      ?>
</div>
<?php 
   include_once('footer.php'); ?>