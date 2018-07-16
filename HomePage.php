<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php 
<<<<<<< HEAD
   $email=$_SESSION["email"];
   if(!(isset($_SESSION["username"])))
       { ?>
<script> window.location.href ="index.php"; </script>
<?php }
   $username=$_SESSION["username"];
   $is_admin=UpdateUser($email); 
   ?>
<!-- Page Content Holder -->
<div id="container-fixed">
<nav class="navbar navbar-expand-lg navbar-light" style= "background-color: #575cc1;color:white;">
   <div class="container-fluid">
      <!-- <div class="row"> -->
      <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 pull-left">
         <h3><i class="fa fa-users faa-shake animated-hover"></i>  &nbsp;GTS Inquiry Management Tool</h3>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <div class="col-lg-6 col-md-6 pull-right">
            <div class="btn-group pull-right">
               <?php if($is_admin === '0')
                  {?> </br> <?php }else{ ?>
               <a class="btn btn-success" href="admin/index.php"> Admin Console</a>&nbsp;&nbsp;
               <?php } ?>
               <a href="#" class="user dropdown" id="usermenu" data-toggle="dropdown"><img src="images/profile_small.jpg" class="img-circle" alt="Users" width="33" height="29"/></a>
               <ul class="dropdown-menu" aria-labelledby="usermenu">
                  <li><a href="#"><a href="#"><i class="fa fa-fw fa-user faa-tada animated"></i><?php echo " ".str_replace("%20"," ",$username); ?></a>  </li>
                  <li class="divider"></li>
                  <li><a href="#" id="logoutmenu" onclick="logout();"><i class="fa fa-fw fa-power-off faa-tada animated"></i> Log Out</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</nav>
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-2 col-md-2">
         <nav id="sidebar">
            <div class="sidebar-header bg-success text-white">
            </div>
            <ul style="background-color: #575cc1;color: white;">
               <li>
                  <h5> <a href="dashboard.php"> <i class="fa fa-fw fa-outdent" style="color: white;"></i> IBM Global Offerings</a></h5>
               </li>
               <li>
                  <h5><a href="global_cic.php" onclick="report();"><i class="fa fa-fw fa-object-ungroup"></i>IBM Global CIC</a></h5>
               </li>
               <li class="divider" style="background-color: white;"></li>
               <li>
                  <h5> <a href="local_cic.php" onclick="report();"><i class="fa fa-fw fa-address-card"></i> IBM Local CIC</a></h5>
               </li>
               <li class="divider"></li>
               <li>
                  <h5> <a href="geo.php" onclick="report();"><i class="fa fa-fw fa-globe"></i> IBM GEO Locations</a></h5>
               </li>
               <li  id="chart" style="color: white;"></li>
               <li>
                  <h5> <a href="dc.php"> <i class="fa fa-list faa-shake animated-hover" style="color: white;"></i> IBM Data Center</a></h5>
               </li>
               <li>
                  <h5> <a href="tool.php"> <i class="fa fa-fw fa-flag" style="color: white;"></i> IBM Global Tool</a></h5>
               </li>
            </ul>
         </nav>
      </div>
      <div class="col-lg-10 col-md-10">
         <div class="container-fixed">
            <div class="row">
               <div class="col-lg-3 col-md-3">
                  <div class="well">
                     <!--                    </br>
                        -->                        
                     <h3 class="text-success text-center">
                     <i class="fa fa-fw fa-wrench" style="font-size:48px;"></i>  Tool Search</h2>
                     </br></br>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3">
                  <div class="well">
                     <form action="" method="post" accept-charset="utf-8">
                        <?php 
                           $select = getSelectVendor();
                           ?>
                        <select multiple="multiple" placeholder="Select a Tool" onchange="console.log($(this).children(':selected').length)" class="search-box" name="vendor[]">
                           <?php
                              for($i=0; $i < count($select); $i++) {
                                  ?>
                           <option value="<?php echo $select[$i]['tool_name']; ?>"><?php echo $select[$i]['tool_name']; ?></option>
                           <?php } ?>
                        </select>
                        </br></br>
                        <button class="btn btn-success btn-md btn-block" style="margin-top:10px;" type="submit" name="filtervendor">
                        Search
                        </button>
                        </br>
                     </form>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3">
                  <div class="well">
                     <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i> Customer Search</h3>
                     </br>
                  </div>
               </div>
               <div class="col-lg-3 col-md-3">
                  <div class="well">
                     <form action="" method="post" accept-charset="utf-8">
                        <?php 
                           //$select = getSelectCustomer();
                           ?>
                        <select placeholder="Select Customer" onchange="console.log($(this).children(':selected').length)" class="" name="customer" id="customer" style="width:100%;" class="search-box">
                           <option value="">Select Customer</option>
                        </select>
                        </br></br>
                        <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filter">
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
      if(isset($_REQUEST['filtervendor']) || isset($_REQUEST['filter'])) 
      {
          ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
      if(isset($_REQUEST['vendor']) && ($_REQUEST['vendor'] != '')) 
      {
          showVendorTable(getVendorData($_REQUEST['vendor']));
      } else if(isset($_REQUEST['customer']) && ($_REQUEST['customer'] != '')) 
      {
          showTable(getCustomerData($_REQUEST['customer']));
      }
      }
      ?>
</div>
<?php 
   include_once('footer.php'); ?>
=======
$email=$_SESSION["email"];
if(!(isset($_SESSION["username"])))
{ ?>
    <script> window.location.href ="index.php"; </script>
<?php }
$username=$_SESSION["username"];
$is_admin=UpdateUser($email); 
?>
      <!-- Page Content Holder -->
            <div id="container-fixed">

               <nav class="navbar navbar-expand-lg navbar-light" style= "background-color: #575cc1;color:white;">
                <div class="container-fluid">

                   
                    <!-- <div class="row"> -->
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 pull-left">  
                        <h3><i class="fa fa-users faa-shake animated-hover"></i>  &nbsp;GTS Inquiry Management Tool</h3>
                    </div>
                         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <div class="col-lg-6 col-md-6 pull-right">
                                <div class="btn-group pull-right">
                                    <?php if($is_admin === '0')
                                    {?> </br> <?php }else{ ?>
                                        
                                        <a class="btn btn-success" href="admin/index.php"> Admin Console</a>&nbsp;&nbsp;
                                    <?php } ?>
                                        <a href="#" class="user dropdown" id="usermenu" data-toggle="dropdown"><img src="images/profile_small.jpg" class="img-circle" alt="Users" width="33" height="29"/></a><ul class="dropdown-menu" aria-labelledby="usermenu"><li><a href="#"><a href="#"><i class="fa fa-fw fa-user faa-tada animated"></i><?php echo " ".str_replace("%20"," ",$username); ?></a>  </li><li class="divider"></li><li><a href="#" id="logoutmenu" onclick="logout();"><i class="fa fa-fw fa-power-off faa-tada animated"></i> Log Out</a></li>    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
    <div class="container-fluid">
         <div class="row">  
            <div class="col-lg-2 col-md-2">
            <nav id="sidebar">
                <div class="sidebar-header bg-success text-white">
                </div>   
                <ul style="background-color: #575cc1;color: white;">
                    <li>
                       <h5> <a href="dashboard.php"> <i class="fa fa-fw fa-outdent" style="color: white;"></i> IBM Global Offerings</a></h5>
                    </li>
                    <li> <h5><a href="global_cic.php" onclick="report();"><i class="fa fa-fw fa-object-ungroup"></i>IBM Global CIC</a></h5></li>
                  <li class="divider" style="background-color: white;"></li>
                    <li>
                       <h5> <a href="local_cic.php" onclick="report();"><i class="fa fa-fw fa-address-card"></i> IBM Local CIC</a></h5>
                    </li>
                    <li class="divider"></li>
                    <li>
                       <h5> <a href="geo.php" onclick="report();"><i class="fa fa-fw fa-globe"></i> IBM GEO Locations</a></h5>
                    </li>
                    <li  id="chart" style="color: white;"></li>
                    <li>
                       <h5> <a href="dc.php"> <i class="fa fa-list faa-shake animated-hover" style="color: white;"></i> IBM Data Center</a></h5>
                    </li>
                    <li>
                       <h5> <a href="tool.php"> <i class="fa fa-fw fa-flag" style="color: white;"></i> IBM Global Tool</a></h5>
                    </li>
                </ul>
            </nav>
            </div>
        <div class="col-lg-10 col-md-10">
            <div class="container-fixed">
                <div class="row">   
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
<!--                    </br>
 -->                        <h3 class="text-success text-center"><i class="fa fa-fw fa-wrench" style="font-size:48px;"></i>  Tool Search</h2>
                    </br></br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <form action="" method="post" accept-charset="utf-8">
                            <?php 
                            $select = getSelectVendor();
                            ?>
                            <select multiple="multiple" placeholder="Select a Tool" onchange="console.log($(this).children(':selected').length)" class="search-box" name="vendor[]">
                            <?php
                            for($i=0; $i < count($select); $i++) {
                                ?>
                                <option value="<?php echo $select[$i]['tool_name']; ?>"><?php echo $select[$i]['tool_name']; ?></option>
                                <?php } ?>
                            </select></br></br>
                                <button class="btn btn-success btn-md btn-block" style="margin-top:10px;" type="submit" name="filtervendor">
                                    Search
                                </button>
                            </br>
                            
                        </form>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i> Customer Search</h3>
                    </br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <form action="" method="post" accept-charset="utf-8">
                        <?php 
                        //$select = getSelectCustomer();
                        ?>
                        <select placeholder="Select Customer" onchange="console.log($(this).children(':selected').length)" class="" name="customer" id="customer" style="width:100%;" class="search-box">
                            <option value="">Select Customer</option>
                            </select></br></br>
                                <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filter">
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
        if(isset($_REQUEST['filtervendor']) || isset($_REQUEST['filter'])) {
            ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
            if(isset($_REQUEST['vendor']) && ($_REQUEST['vendor'] != '')) {
                showVendorTable(getVendorData($_REQUEST['vendor']));
            } else if(isset($_REQUEST['customer']) && ($_REQUEST['customer'] != '')) {
                showTable(getCustomerData($_REQUEST['customer']));
            }
        }
        ?>
</div>
<?php 
include_once('footer.php'); ?>
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
