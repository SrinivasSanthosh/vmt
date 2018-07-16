<<<<<<< HEAD


<?php 
  session_start();
  include_once('functions.php'); 
  include_once('header.php');
  $pageDetails = getPageDetails();
  $email=$_SESSION["email"];
  $is_admin=UpdateUser($email);
  if((!(isset($_SESSION["username"]))) || ($is_admin == 0))
  {
      header("Location:../dashboard.php");
  
   }
  $username=$_SESSION["email"];
  
   ?>
<div class="navbar navbar-default" role="navigation">
  <div class="navbar-inner">
    <button type="button" class="navbar-toggle pull-right animated flip">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
    <span>GTS Vendor Inquiry Tool</span></a>
    <div class="btn-group pull-right">
      <a href="help.php" class="btn btn-success">Download Help File</a>
      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Admin</span>
      <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="#"><?php echo $username; ?></a></li>
        <li class="divider"></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
      &nbsp;
      <a href="../dashboard.php" class="btn btn-success">Back</a>
    </div>
  </div>
</div>
<div class="ch-container">
<div class="row">
<div class="col-sm-2 col-lg-2">
  <div class="sidebar-nav">
    <div class="nav-canvas">
      <div class="nav-sm nav nav-stacked">
      </div>
      <ul class="nav nav-pills nav-stacked main-menu">
        <li <?php echo $pageDetails['iactive']; ?>>
          <a class="ajax-link" href="index.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span> Global Tools</span>
          </a>
        </li>
        <li <?php echo $pageDetails['goactive']; ?>>
          <a class="ajax-link" href="global-offering.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Global Offerings</span>
          </a>
        </li>
        <li <?php echo $pageDetails['euactive']; ?>>
          <a class="ajax-link" href="eu.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Europe</span>
          </a>
        </li>
        <li <?php echo $pageDetails['naactive']; ?>>
          <a class="ajax-link" href="na-geo.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>NA GEO</span>
          </a>
        </li>
        <li <?php echo $pageDetails['jactive']; ?>>
          <a class="ajax-link" href="japan.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Japan</span>
          </a>
        </li>
        <li <?php echo $pageDetails['lactive']; ?>>
          <a class="ajax-link" href="la.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Latin America</span>
          </a>
        </li>
        <li <?php echo $pageDetails['gactive']; ?>>
          <a class="ajax-link" href="gcg.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>GCG</span>
          </a>
        </li>
        <li <?php echo $pageDetails['apactive']; ?>>
          <a class="ajax-link" href="ap.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Asia Pacific</span>
          </a>
        </li>
        <li <?php echo $pageDetails['sbliw']; ?>>
          <a class="ajax-link" href="sbliw.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>SBLIW</span>
          </a>
        </li>
        <li <?php echo $pageDetails['dcactive']; ?>>
          <a class="ajax-link" href="global_cic.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Global CIC</span>
          </a>
        </li>
        <li <?php echo $pageDetails['cicactive']; ?>>
          <a class="ajax-link" href="local_cic.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Local CIC</span>
          </a>
        </li>
        <li <?php echo $pageDetails['cicactive']; ?>>
          <a class="ajax-link" href="data_center.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Data Center</span>
          </a>
        </li>
        <li <?php echo $pageDetails['admin']; ?>>
          <a class="ajax-link" href="admin.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Add Admin Access</span>
          </a>
        </li>
        <li <?php echo $pageDetails['mea_geo']; ?>>
          <a class="ajax-link" href="mea_geo.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>MEA Geo</span>
          </a>
        </li>
        <li <?php echo $pageDetails['admin']; ?>>
          <a class="ajax-link" href="create_user.php">
          <i class="glyphicon glyphicon-align-justify"></i>
          <span>Create User</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<!--/span-->
<!-- left menu ends -->

=======
<?php 
session_start();
include_once('functions.php'); 
include_once('header.php');
$pageDetails = getPageDetails();
$email=$_SESSION["email"];
$is_admin=UpdateUser($email);
if((!(isset($_SESSION["username"]))) || ($is_admin == 0))
{
    header("Location:../dashboard.php");
   // exit(0);
 }
$username=$_SESSION["username"];
 ?>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-right animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
            <span>GTS Vendor Inquiry Tool</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
              <!--   <form action="help.php" method="post">
                   <input type="submit" name="submit" value="Download Help File" />
               </form> -->
                <a href="help.php" class="btn btn-success">Download Help File</a>
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> Admin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                      <li><a href="#"><?php echo $username; ?></a></li>
                    <li class="divider"></li>
                    <li><a href="../logout.php">Logout</a></li>
                </ul> &nbsp;
                <a href="../dashboard.php" class="btn btn-success">Back</a>
            </div>

            <!-- user dropdown ends -->


        </div>
    </div>
    <!-- topbar ends -->
    <div class="ch-container">
        <div class="row">

            <!-- left menu starts -->
            <div class="col-sm-2 col-lg-2">
                <div class="sidebar-nav">
                    <div class="nav-canvas">
                        <div class="nav-sm nav nav-stacked">

                        </div>
                        <ul class="nav nav-pills nav-stacked main-menu">
                            <li <?php echo $pageDetails['iactive']; ?>>
                                <a class="ajax-link" href="index.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span> Global Tools</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['goactive']; ?>>
                                <a class="ajax-link" href="global-offering.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Global Offerings</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['euactive']; ?>>
                                <a class="ajax-link" href="eu.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Europe</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['naactive']; ?>>
                                <a class="ajax-link" href="na-geo.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>NA GEO</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['jactive']; ?>>
                                <a class="ajax-link" href="japan.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Japan</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['lactive']; ?>>
                                <a class="ajax-link" href="la.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Latin America</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['gactive']; ?>>
                                <a class="ajax-link" href="gcg.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>GCG</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['apactive']; ?>>
                                <a class="ajax-link" href="ap.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Asia Pacific</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['sbliw']; ?>>
                                <a class="ajax-link" href="sbliw.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>SBLIW</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['dcactive']; ?>>
                                <a class="ajax-link" href="global_cic.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Global CIC</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['cicactive']; ?>>
                                <a class="ajax-link" href="local_cic.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Local CIC</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['cicactive']; ?>>
                                <a class="ajax-link" href="data_center.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Data Center</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['admin']; ?>>
                                <a class="ajax-link" href="admin.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Add Admin Access</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['mea_geo']; ?>>
                                <a class="ajax-link" href="mea_geo.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>MEA Geo</span>
                                </a>
                            </li>
                            <li <?php echo $pageDetails['admin']; ?>>
                                <a class="ajax-link" href="create_user.php">
                                    <i class="glyphicon glyphicon-align-justify"></i>
                                    <span>Create User</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!--/span-->
            <!-- left menu ends -->
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
