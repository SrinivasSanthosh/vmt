<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
<div class="col-lg-10 col-md-10">
   <form action="" method="post" accept-charset="utf-8">
      <div class="container-fixed">
         <div class="row">
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <h3 class="text-success text-center"><i class="fa fa-fw fa-globe" style="font-size:28px;"></i>Geo Location Search</h3>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  </br>
                  <select placeholder="Geo Location Search" id="geo_search"  class="search-box" name="geo_search"  style="width:100%;">
                     <option value="">Select Geo Location</option>
                     <option value="europe">Europe</option>
                     <option value="na">NA</option>
                     <option value="la">LA</option>
                     <option value="japan">Japan</option>
                     <option value="ap">AP</option>
                     <option value="gcg">GCG</option>
                     <option value="mea">MEA</option>
                  </select>
                  </br></br>
               </div>
            </div>
            <div class="col-lg-3 col-md-3 market-search" style="display: none;">
               <div class="well">
                  <h3 class="text-primary text-center"><i class="fa fa-fw fa-outdent" style="font-size:28px;"></i>Market Search</h3>
                  </br>
               </div>
            </div>
            <div class="col-lg-3 col-md-3 market-search" style="display: none;">
               <div class="well">
                  <?php 
                     global $conn;
                     $query = "SELECT distinct(market) FROM europe_geo";
                     $select_market = getSelectMarket();
                     ?></br>
                  <select placeholder="Market Search" onchange="console.log($(this).children(':selected').length)" class="search-box" name="market_search" id="market_search" style="width:100%;">
                     <option value="">Select a Market</option>
                     <?php
                        for($i=0; $i < count($select_market); $i++) {
                            ?>
                     <option value="<?php echo $select_market[$i]['market']; ?>"><?php echo $select_market[$i]['market']; ?></option>
                     <?php 
                        } 
                        ?>
                  </select>
                  </br>  </br>           
               </div>
            </div>
            <div class="col-lg-3 col-md-3 market-search-all" style="display: none;">
               <div class="well">
                  <h3 class="text-primary text-center"><i class="fa fa-fw fa-outdent" style="font-size:28px;"></i>Market Search</h3>
                  </br>
               </div>
            </div>
            <div class="col-lg-3 col-md-3 market-search-all" style="display: none;">
               <div class="well">
                  <select placeholder="Market Search" onchange="console.log($(this).children(':selected').length)" class="search-box" name="market_search_all" id="market_search" style="width:100%;">
                     <option value="">All Markets</option>
                  </select>
                  </br>  </br>           
               </div>
            </div>
            <div class="col-lg-3 col-md-3 cust-search" style="display: none;">
               <div class="well">
                  <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:28px;"></i>Customer Search</h3>
                  </br>
               </div>
            </div>
            <div class="col-lg-3 col-md-3 cust-search" style="display: none;">
               <div class="well customer-search">
                  </br>
                  <div class="customer-search-span">
                     <?php
                        ?>
                     <select  id='cust_search' multiple='multiple' placeholder='Select Customers' class='form-control' name='custgeo[]'>
                     </select>
                     </br> </br>
                  </div>
               </div>
            </div>
         </div>
         <div class="panel panel-info">
            <div class="panel-heading">
               <center>
                  <h4 style="color:green;">OPTIONAL FIELDS</h4>
               </center>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="text-success text-center"><i class="fa fa-fw fa-wrench"></i>  Tool Search</h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectVendor();
                     ?>
                  <select multiple="multiple" placeholder="Select a Tool" onchange="console.log($(this).children(':selected').length)" class="search-box" name="vendor[]" id="options">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['tool_name']; ?>"><?php echo $select[$i]['tool_name']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="text-primary text-center"><i class="fa fa-fw fa-flag"></i> Data Center</h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectCountry();
                     ?>
                  <select multiple="multiple" placeholder="Select a country" onchange="console.log($(this).children(':selected').length)" class="search-box" name="country[]">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['address_country']; ?>"><?php echo $select[$i]['address_country']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="text-success text-center"><i class="fa fa-fw fa-map-marker"></i> Global Service </h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectSAName('global');
                     ?>
                  <select multiple="multiple" placeholder="Select Service Area" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalsa[]">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['service_area']; ?>" title="<?php echo $select[$i]['service_area']; ?>"><?php echo $select[$i]['service_area']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="text-primary text-center"><i class="fa fa-fw fa-sitemap"></i> Global CIC Name</h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectCICID('global');
                     ?>
                  <select multiple="multiple" placeholder="Select IBM CIC Name" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalcic[]">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['id']; ?>" title="<?php echo $select[$i]['id']; ?>"><?php echo $select[$i]['id']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-success">
                  <div class="panel-heading">
                     <h3 class="text-success text-center"><i class="fa fa-fw fa-map-marker"></i> Local Service </h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectSAName('local');
                     ?>
                  <select multiple="multiple" placeholder="Select Service Area" onchange="console.log($(this).children(':selected').length)" class="search-box" name="localsa[]">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['service_area']; ?>" title="<?php echo $select[$i]['service_area']; ?>"><?php echo $select[$i]['service_area']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="panel panel-info">
                  <div class="panel-heading">
                     <h3 class="text-primary text-center"><i class="fa fa-fw fa-sitemap"></i> Local CIC Name</h3>
                  </div>
               </div>
            </div>
            <div class="col-lg-3 col-md-3">
               <div class="well">
                  <?php 
                     $select = getSelectCICID('local');
                     ?>
                  <select multiple="multiple" placeholder="Select IBM CIC Name" onchange="console.log($(this).children(':selected').length)" class="search-box" name="localcic[]">
                     <?php
                        for($i=0; $i < count($select); $i++) {
                            ?>
                     <option value="<?php echo $select[$i]['id']; ?>" title="<?php echo $select[$i]['id']; ?>"><?php echo $select[$i]['id']; ?></option>
                     <?php } ?>
                  </select>
               </div>
            </div>
         </div>
         <center> <input type="submit" class="btn btn-primary btn-lg" style="width:245px;"  name="filter_geo" id="filter_geo" value="Search"></center>
         </br>
   </form>
   </div>
</div>
</div>
<div class="container-table100">
   <?php
      if(isset($_REQUEST['filter_geo']))
      {
          ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> 
   <form action="excel.php" method="post" class="col-md-12 clearfix" accept-charset="utf-8">
      <?php    
         if(isset($_REQUEST['vendor']))
         {
             foreach($_REQUEST['vendor'] as $value)
                 {                  echo '<input type="hidden" name="excel_tool[]" value="'. $value. '">';                } 
         }
         if(isset($_REQUEST['country']))
         {
             foreach($_REQUEST['country'] as $value)
                 {                  echo '<input type="hidden" name="excel_country[]" value="'. $value. '">';             } 
         }
         if(isset($_REQUEST['globalcic']))
         {
          foreach($_REQUEST['globalcic'] as $value)
             {                  echo '<input type="hidden" name="excel_gcic[]" value="'. $value. '">';                } 
         }
         if(isset($_REQUEST['localcic']))
         {
         foreach($_REQUEST['localcic'] as $value)
         {                  echo '<input type="hidden" name="excel_lcic[]" value="'. $value. '">';                } 
         }
         if(isset($_REQUEST['globalsa']))
         {
         foreach($_REQUEST['globalsa'] as $value)
         {                  echo '<input type="hidden" name="excel_gsa[]" value="'. $value. '">';                 } 
         }
         if(isset($_REQUEST['localsa']))
         {
         foreach($_REQUEST['localsa'] as $value)
         {                  echo '<input type="hidden" name="excel_lsa[]" value="'. $value. '">';                 } 
         }
         if(isset($_REQUEST['custgeo']) && ($_REQUEST['custgeo'] != '') && ($_REQUEST['geo_search']))
         {
         echo '<input type="hidden" name="excel_geo_search" value="'. $_REQUEST['geo_search']. '">';
         foreach($_REQUEST['custgeo'] as $value)
         {                  echo '<input type="hidden" name="excel_custgeo[]" value="'. $value. '">';                 } 
         echo '<input type="hidden" name="excel_market_search" value="'. $_REQUEST['market_search']. '">';
         
         }
         
         ?>
      <button type="submit" class="btn btn-success btn-lg">Export All</button>
   </form>
   <?php
      if(isset($_REQUEST['vendor']) && ($_REQUEST['vendor'] != '')) 
      {
          $vendor=$_REQUEST['vendor'];
          if(isset($_REQUEST['vendor']) && ($_REQUEST['vendor'] != '')) 
          {
              showVendorTable(getVendorData_1($_REQUEST['vendor']));
          }
      }
      else
          {$vendor='';}
      if(isset($_REQUEST['country']) && ($_REQUEST['country'] != ''))
      {
          $country=$_REQUEST['country'];
          showCountryTable(getCountryData($_REQUEST['country']));
      }else{$country='';}
      if(isset($_REQUEST['globalsa']) && ($_REQUEST['globalsa'] != ''))
      {
          $globalsa=$_REQUEST['globalsa'];
          showCICTable(getCICData($_REQUEST['globalsa'],'global'));
      }else{$globalsa='';}
      if(isset($_REQUEST['localsa']) && ($_REQUEST['localsa'] != ''))
      {
          $localsa=$_REQUEST['localsa'];
          showCICTable(getCICData($_REQUEST['localsa'],'local'));
      }else{$localsa='';}
      if(isset($_REQUEST['globalcic']) && ($_REQUEST['globalcic'] != ''))
      {
          $globalcic=$_REQUEST['globalcic'];
          showSATable(getSAIDData($_REQUEST['globalcic'],'global'));
      }else{$localcic='';}
      if(isset($_REQUEST['localcic']) && ($_REQUEST['localcic'] != ''))
      {
          $localcic=$_REQUEST['localcic'];
          showSATable(getSAIDData($_REQUEST['localcic'],'local'));
      }else{$localcic='';}
      if(isset($_REQUEST['custgeo']) && ($_REQUEST['custgeo'] != '')) 
      {
          if ($_REQUEST['geo_search'] == "all") 
          {
              showGeoTable(getGeoData($_REQUEST['custgeo'], array("la", "na", "japan", "ap", "gcg", "mea")));
              showGeoTableEurope(getGeoDataEurope($_REQUEST['custgeo'], $_REQUEST['geo_search'], $_REQUEST['market_search']));
          }
          elseif ($_REQUEST['geo_search'] == "europe")
          {
              showGeoTableEurope(getGeoDataEurope($_REQUEST['custgeo'], $_REQUEST['geo_search'], $_REQUEST['market_search']));
          }
          else 
          {
              showGeoTable(getGeoData($_REQUEST['custgeo'], array($_REQUEST['geo_search'])));
          }
          ?>
   <br>
   <?php
      }
      }    
      ?>
</div>
<?php 
   include_once('footer.php'); 
   ?>