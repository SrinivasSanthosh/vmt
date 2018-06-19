<?php 
$email=$_SESSION["email"];
if(!(isset($_SESSION["username"])))
{ ?>
    <script> window.location.href ="index.php"; </script>
<?php }
$username=$_SESSION["username"];
$is_admin=UpdateUser($email); 
?>
<div id="container-fixed">
   <nav class="navbar navbar-expand-lg navbar-light" style= "background-color: #575cc1;color:white;">
    <div class="container-fluid">                   
        <!-- <div class="row"> -->
        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6 pull-left">  
            <h3><img src="images/logo1.png" style="color:white;width:9%;height:9%;"/>&nbsp; VENDOR INQUIRY TOOL</h3>
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
                 <h5> <a href="dashboard.php"> <i class="fa fa-fw fa-home" style="color: white;font-size:18px;"></i> HomePage</a></h5>
               </li>
               <li>
                 <h5> <a href="geo.php" onclick="report();"><i class="fa fa-fw fa-globe"></i> IBM GEO Locations</a></h5>
               </li>
               <li> <h5><a href="global_cic.php" onclick="report();"><i class="fa fa-fw fa-object-ungroup"></i>IBM Global CIC</a></h5></li>
               <li class="divider" style="background-color: white;"></li>
               <li>
                 <h5> <a href="local_cic.php" onclick="report();"><i class="fa fa-fw fa-address-card"></i> IBM Local CIC</a></h5>
               </li>
               <li class="divider"></li>
               <li  id="chart" style="color: white;"></li>
               <li>
                 <h5> <a href="dc.php"> <i class="fa fa-list faa-shake animated-hover" style="color: white;"></i> IBM Data Center</a></h5>
               </li>
               <li>
                 <h5> <a href="tool.php"> <i class="fa fa-fw fa-flag" style="color: white;"></i> IBM Global Tool</a></h5>
               </li>
               <li>
                 <h5> <a href="offering.php"> <i class="fa fa-fw fa-outdent" style="color: white;"></i> IBM Global Offering</a></h5>
               </li>
               <li>
                 <h5> <a href="help.php"> <i class="fa fa-fw fa-download" style="color: white;"></i> Download Manual</a></h5>
               </li>
               <li class="divider"></li>
             </ul>
            </nav>
            </div>
