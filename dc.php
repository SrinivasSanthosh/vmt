<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
        <div class="col-lg-10 col-md-10">
            <div class="container-fixed">
                <div class="row">	
                	<div class="col-lg-3 col-md-3">
                	<div class="well">
                		<h3 class="text-success text-center"><i class="fa fa-fw fa-flag" style="font-size:48px;"></i>  Country search</h2>
                	</br></br>
                	</div>
                	</div>
                	<div class="col-lg-3 col-md-3">
                	<div class="well">
            			<form action="" method="post" accept-charset="utf-8">
							<?php 
							$select = getSelectCountry();
                            ?>
							<select multiple="multiple" placeholder="Select a country" onchange="console.log($(this).children(':selected').length)" class="search-box" name="country[]">
							<?php
							for($i=0; $i < count($select); $i++) {
								?>
								<option value="<?php echo $select[$i]['country_name']; ?>"><?php echo $select[$i]['country_name']; ?></option>
								<?php } ?>
							</select></br></br>
								<button class="btn btn-success btn-md btn-block" style="margin-top:10px;" type="submit" name="filtercountry">
									Search
								</button>
							</br>
							
						</form>
					</div>
					</div>
					<div class="col-lg-3 col-md-3">
                	<div class="well">
                		<h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i> 
                         Customer search</h2>
                    </br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <form action="" method="post" accept-charset="utf-8">
                            <?php 
                            $select = getSelectCustomer_datacenter();
                            ?>
                            <select multiple="multiple" placeholder="Select a customer" onchange="console.log($(this).children(':selected').length)" class="search-box" name="customer[]">
                            <?php
                            for($i=0; $i < count($select); $i++) {
                                ?>
                                <option value="<?php echo $select[$i]['identify_customer']; ?>"><?php echo $select[$i]['identify_customer']; ?></option>
                                <?php } ?>
                            </select></br></br>
                                <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filtercustomer">
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
<div class="container-table100">
<?php 
		if(isset($_REQUEST['filtercountry']) || isset($_REQUEST['filtercustomer'])) {
			?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
			if(isset($_REQUEST['country']) && ($_REQUEST['country'] != '')) {
				showCountryTable(getCountryData($_REQUEST['country']));
                showCountTable(getCountData($_REQUEST['country']));
			} else if(isset($_REQUEST['customer']) && ($_REQUEST['customer'] != '')) {
				showCountryTable_datacenter(getCustomerData_datacenter($_REQUEST['customer']));
                showCountryCountTable_datacenter(getCustomerCountData_datacenter($_REQUEST['customer']));
			}
		}
		?>
</div>
<?php 
include_once('footer.php'); ?>