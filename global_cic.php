<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
        <div class="col-lg-10 col-md-10">
            <div class="container-fixed">
                <div class="row">	
                	<div class="col-lg-3 col-md-3">
                	<div class="well">
                		<h3 class="text-success text-center"><i class="fa fa-fw fa-map-marker" style="font-size:48px;"></i>  Service Area</h2>
                	</br></br>
                	</div>
                	</div>
                	<div class="col-lg-3 col-md-3">
                	<div class="well">
                        <form action="" method="post" accept-charset="utf-8">
                        <?php 
                        $select = getSelectSAName('global');
                        ?>
                        <select multiple="multiple" placeholder="Select Service Area" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalsa[]">
                            <?php
                            for($i=0; $i < count($select); $i++) {
                                ?>
                                <option value="<?php echo $select[$i]['service_area']; ?>" title="<?php echo $select[$i]['service_area']; ?>"><?php echo $select[$i]['service_area']; ?></option>
                                <?php } ?>
                            </select></br></br>
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
                            $select = getSelectCICID('global');
                            ?>
                        <select multiple="multiple" placeholder="Select IBM CIC Name" onchange="console.log($(this).children(':selected').length)" class="search-box" name="globalcic[]"> 
                            <!-- <select multiple="multiple" id="cust_search" placeholder="Select IBM CIC Name" onchange="console.log($(this).children(':selected').length)" class="form-control" name="globalcic[]"> -->
                            <?php
                            for($i=0; $i < count($select); $i++) {
                                ?>
                                <option value="<?php echo $select[$i]['id']; ?>" title="<?php echo $select[$i]['id']; ?>"><?php echo $select[$i]['id']; ?></option>
                                <?php } ?>
                            </select></br></br>
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
		if(isset($_REQUEST['filtergc']) || isset($_REQUEST['filter'])) {
			?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
			if(isset($_REQUEST['globalcic']) && ($_REQUEST['globalcic'] != '')) {
				showSATable(getSAIDData($_REQUEST['globalcic'],'global'));
               // showPivotSATable(getPivotSAData($_REQUEST['globalcic'],'global'));
			} else if(isset($_REQUEST['globalsa']) && ($_REQUEST['globalsa'] != '')) {
				showCICTable(getCICData($_REQUEST['globalsa'],'global'));
                //showPivotCICTable(getPivotCICData($_REQUEST['globalsa'],'global'));   
			}
		}
		?>
</div>
<?php 
include_once('footer.php'); ?>