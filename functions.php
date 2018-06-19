<?php
error_reporting(~E_NOTICE);
/**
 *
 * method to connect to the DB
 *
 */

function connDB() {
	$hostname = "localhost";
	$dbname = "gdpr";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($hostname, $username, $password, $dbname);
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MYSQL : ". mysqli_connect_error();
	}
	return $conn;
}
$conn = connDB();

/**
 *
 * Method to get the select box value for Vendors
 *
 */
function getSelectVendor() {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(tool_name) FROM global_tool";
	// echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['tool_name'] = $output['tool_name'];
		$i++;
	}
	return $return_array;
}
/**
 *
 * Method to get the select box value for Vendors
 *
 */
function getSelectCustomer() {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(cust_nm) FROM sbliw";
	// echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['cust_nm'] = $output['cust_nm'];
		$i++;
	}
	return $return_array;
}

/**
 *
 * Method to get the select box value for Europe Geo Location
 *
 */
function getSelectMarket() {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(market) FROM europe_geo";
	// echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;

	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['market'] = $output['market'];
		$i++;
	}
	return $return_array;
	} 
	
/**
 *
 * Method to get the GEO Customer
 *
 */

function getAllGeoCustomer() {
	global $conn;
	$i = 0;

	$allgeo = array("europe_geo", "la_geo", "na_geo", "ap_geo", "japan_geo", "gcg_geo", "mea_geo");
	foreach ($allgeo as $key) {
		$i=0;
		if ($key == "europe_geo") {
			$query = "SELECT distinct(customer_under_po) as identify_customer FROM ".$key." where customer_under_po is NOT NULL order by customer_under_po LIMIT 0, 20";
		}
		else {
			$query = "SELECT distinct(identify_customer) as identify_customer FROM ".$key." where identify_customer is NOT NULL and identify_customer != '' order by identify_customer LIMIT 0, 20";
		}
		$result = mysqli_query($conn, $query);

		while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['label'] = $output['identify_customer'];
		$return_array[$i]['value'] = $output['identify_customer'];
		$i++;
		}
	}


	$query_data = "SELECT distinct(identify_customer) as identify_customer FROM ibm_data_center order by identify_customer LIMIT 0, 20";
	$result_data = mysqli_query($conn, $query_data);

	$query_sbliw = "SELECT distinct(cust_nm) as identify_customer FROM sbliw order by cust_nm LIMIT 0, 20";
	$result_sbliw = mysqli_query($conn, $query_sbliw);



	while($output_data = mysqli_fetch_array($result_data)) {
		$return_array[$i]['label'] = $output_data['identify_customer'];
		$return_array[$i]['value'] = $output_data['identify_customer'];
		$i++;
	}
	while($output_sbliw = mysqli_fetch_array($result_sbliw)) {
		$return_array[$i]['label'] = $output_sbliw['identify_customer'];
		$return_array[$i]['value'] = $output_sbliw['identify_customer'];
		$i++;
	}
	return($return_array);
}

function getGeoCustomer($location, $market='') {
	global $conn;
	$return_array = array();
	if ($market != "") {
		$query = "SELECT distinct(customer_under_po) as identify_customer FROM ".$location."_geo where market='".$market."' and customer_under_po is NOT NULL order by customer_under_po LIMIT 0, 20";
		$result = mysqli_query($conn, $query);
	}
	else {
		$query = "SELECT distinct(identify_customer) as identify_customer FROM ".$location."_geo where identify_customer is NOT NULL and identify_customer != '' order by identify_customer LIMIT 0, 20";
		$result = mysqli_query($conn, $query);
	}

	$query_data = "SELECT distinct(identify_customer) as identify_customer FROM ibm_data_center ORDER BY identify_customer LIMIT 0, 20";
	$result_data = mysqli_query($conn, $query_data);

	$query_sbliw = "SELECT distinct(cust_nm) as identify_customer FROM sbliw ORDER BY cust_nm LIMIT 0, 20";
	$result_sbliw = mysqli_query($conn, $query_sbliw);

	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['label'] = $output['identify_customer'];
		$return_array[$i]['value'] = $output['identify_customer'];
		$i++;
	}
	while($output_data = mysqli_fetch_array($result_data)) {
		$return_array[$i]['label'] = $output_data['identify_customer'];
		$return_array[$i]['value'] = $output_data['identify_customer'];
		$i++;
	}
	while($output_sbliw = mysqli_fetch_array($result_sbliw)) {
		$return_array[$i]['label'] = $output_sbliw['identify_customer'];
		$return_array[$i]['value'] = $output_sbliw['identify_customer'];
		$i++;
	}
 	return ($return_array);
	}  
/**
 *
 * Method to get the Vendor table data
 *
 */
function getVendorData($vendor) {
	global $conn;
	$return_array = array();
	$criteria = implode(',', $vendor);
	$implode_vendor = implode ( "', '", $vendor );
	$query = "SELECT * from global_tool where tool_name IN ('".$implode_vendor."')";
	$result = mysqli_query($conn, $query);
	$i = 0;
	$return_array['vendor'] = $criteria;	
	while ($output = mysqli_fetch_array($result)) {
		$return_array['getvendor'][$i]['procurement_reference'] = $output['procurement_reference'];
		$return_array['getvendor'][$i]['entity_name'] = $output['entity_name'];
		$return_array['getvendor'][$i]['country'] = $output['country'];
		$return_array['getvendor'][$i]['sub_contract_vendors'] = $output['sub_contract_vendors'];
		$return_array['getvendor'][$i]['tool_name'] = $output['tool_name'];
		$return_array['getvendor'][$i]['vendor_description'] = $output['vendor_description'];
		$i++;
	}
	return $return_array;
}

/**
 *
 * Method to get the Service Area data from ID
 *
 */

function getSAIDData($sa,$table) {
	global $conn;
	$return_array = array();
	$criteria = implode(',', $sa);
	$implode_vendor = implode ( "', '", $sa );
	$query = "SELECT * from ibm_".$table."_cic where id IN ('".$implode_vendor."')";
	$result = mysqli_query($conn, $query);
	$return_array['id'] = $criteria;	
	$return_array['token'] = strtoupper($table);
	if(mysqli_num_rows($result) > 0) 	{
	$i = 0;
	while ($output = mysqli_fetch_array($result)) {
		$return_array['data'][$i]['id'] = $output['id'];
		$return_array['data'][$i]['ibm_cic_name'] = $output['ibm_cic_name'];
		$return_array['data'][$i]['ibm_cic_address'] = $output['ibm_cic_address'];
		$return_array['data'][$i]['cic_delivering_service'] = $output['cic_delivering_service'];
		$return_array['data'][$i]['country'] = $output['country'];
		$return_array['data'][$i]['entity_name'] = $output['entity_name'];
		$return_array['data'][$i]['sub_contracting_vendor'] = $output['sub_contracting_vendor'];
		$return_array['data'][$i]['service_area'] = $output['service_area'];		
		$return_array['data'][$i]['supplier_address'] = $output['supplier_address'];
		$return_array['data'][$i]['gso'] = $output['gso'];
		$return_array['data'][$i]['service_contact'] = $output['service_contact'];
		$return_array['data'][$i]['assesment_owner'] = $output['assesment_owner'];
		$return_array['data'][$i]['note'] = $output['note'];
		$i++;
	}
}
	return $return_array;
}


/**
 *
 * Method to get the select box value for IBM CIC ID
 *
 */
function getSelectCICID($table) {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(id) FROM ibm_".$table."_cic";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['id'] = $output['id'];
		$i++;
	}
	return $return_array;
}

/**
 *
 * Method to get the Vendor table data
 *
 */
function getCustomerData($customer) {
	global $conn;
	$return_array_data = array();
	// $cust_val = explode(' ', $customer);
		// $like_cust = $cust_val[0];
	// var_dump($customer);
	$implode_vendor="";
	for($j=0; $j < count($customer); $j++) {
		if($j == count($customer)-1) {
		$implode_vendor .= "'".$customer[$j]."'";
		} else {
			$implode_vendor .= "'".$customer[$j]."',";
		}
	}
		// $implode_vendor = implode ( "', '", $customer );
		// var_dump($customer);
		// $implode_vendor = mysqli_escape_string($conn, $implode_vendor);
		// $implode_vendor = addslashes($implode_vendor);
	$query = 'SELECT distinct(OFFRG_CMPNT_CD) from sbliw WHERE cust_nm in ('.$implode_vendor.')';
	// echo $query;
	$return_array_data['customer'] = $implode_vendor;
	$result = mysqli_query($conn, $query);
	$return_array = array();
	// var_dump($result);
	$offering_id = array();
	$implode_oid="";
	if(mysqli_num_rows($result) > 0) {
	while ($output = mysqli_fetch_array($result)) {
		array_push($offering_id,$output['OFFRG_CMPNT_CD']);
		} 
	for($j=0; $j < count($offering_id); $j++) {
		if($j == count($offering_id)-1) {
		$implode_oid .= "'".$offering_id[$j]."'";
		} else {
			$implode_oid .= "'".$offering_id[$j]."',";
		}
	}
	$implode_4oid="";
	for($j=0; $j < count($offering_id); $j++) {
		if(($offering_id[$j] != '*') && ($offering_id[$j] != ''))
		{
		if($j == count($offering_id)-1) {
		$implode_4oid .= " OR offering_id_40 like'%".$offering_id[$j]."%' ";
		} else {
			$implode_4oid .= " OR offering_id_40 like '%".$offering_id[$j]."%' ";
		}
		}
	}


		//code to fetch the table data from global offering
		//$query_offering = "SELECT * FROM global_offering WHERE offering_id_30 = '". $offering_id."' OR offering_id_40 like '%". $offering_id."%'";

		$query_offering = "SELECT * FROM global_offering WHERE (offering_id_30 IN (". $implode_oid.")) ". $implode_4oid;
		$return_array = array();
		$result_offering = mysqli_query($conn, $query_offering);
		
		if(mysqli_num_rows($result_offering) > 0) {
			$i = 0;
			while($output_offering = mysqli_fetch_array($result_offering)) {
				$return_array[$i]['procurement_reference'] = $output_offering['procurement_reference'];
				$return_array[$i]['entity_name'] = $output_offering['entity_name'];
				$return_array[$i]['country'] = $output_offering['country'];
				$return_array[$i]['sub_contract_vendors'] = $output_offering['sub_contract_vendors'];
				$return_array[$i]['offering_id_30'] = $output_offering['offering_id_30'];
				$return_array[$i]['offering_id_40'] = $output_offering['offering_id_40'];
				$return_array[$i]['vendor_description'] = $output_offering['vendor_description'];
				$return_array[$i]['on_boarding'] = $output_offering['on_boarding'];
				$return_array[$i]['off_boarding'] = $output_offering['off_boarding'];
				$return_array[$i]['offering_owner'] = $output_offering['offering_owner'];
				$return_array[$i]['assessment_owner'] = $output_offering['assessment_owner'];
				$return_array[$i]['note'] = $output_offering['note'];
				$i++;
			}
			$return_array_data['global_offering']['data'] = $return_array;
		} else {
			$return_array_data['global_offering'] = array("error"=> "failed");
		}
	}
	else {
	$return_array_data['global_offering'] = array("error"=> "failed");
}
		//code to fetch the table data from global offering ends here

	return $return_array_data;
}
/**
 *
 * method to show the table
 *
*/
function showTable($output) {
	?>
	<?php
	if(!$output['global_offering']['error']) {
?>

		<h4 class="search-criteria">Search Criteria : <?php echo $output['customer']; ?></h4>
		<h3 class="header-title">Global Offering</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				<div class="table100-bod">
					<table id ='global_offering'>
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									Procurement Reference
								</th>
								<th class="cell100 column2">
									Entity Name 
								</th>
								<th class="cell100 column3">
									Country / Address
								</th>
								<th class="cell100 column4">
									Is there further sub-contracting to second or third tier Vendor
								</th>
								<th class="cell100 column5">
									Offering ID (level 30)
								</th>
								<th class="cell100 column5">
									Offering ID (level 40)
								</th>
								<th class="cell100 column5">
									Vendor's Service Description (GSAR)
								</th>
								<th class="cell100 column5">
									On boarding
								</th>
								<th class="cell100 column5">
									Off-Boarding
								</th>
								<th class="cell100 column5">
									Offering Owner
								</th>
								<th class="cell100 column5">
									Assessment Owner
								</th>
								<th class="cell100 column5">
									NOTE
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$global_offering = $output['global_offering']['data'];
							for($i = 0; $i < count($global_offering); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $global_offering[$i]['procurement_reference']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['entity_name']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['sub_contract_vendors']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['offering_id_30']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['offering_id_40']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['vendor_description']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['on_boarding']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['off_boarding']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['offering_owner']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['assessment_owner']; ?></td>
								<td class="cell100 column2"><?php echo $global_offering[$i]['note']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>




		</div>
		<?php
	 }
	
}

/**
 *
 * method to show the table
 *
 */
function showVendorTable($output) {
	// var_dump($output);
	?>
	<h4 class="search-criteria">Search Criteria : <?php echo $output['vendor']; ?></h4>
	<?php
	if(!$output['error']) {
		?>
		<h3 class="header-title">Tool Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="vendor_tool">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									Procurement Reference
								</th>
								<th class="cell100 column2">
									Entity Name 
								</th>
								<th class="cell100 column3">
									Country
								</th>
								<th class="cell100 column4">
									Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors 
								</th>
								<th class="cell100 column5">
									Tool Name
								</th>
								<th class="cell100 column5">
									 Vendor Service Description (GSAR)
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$vendor_tool = $output['getvendor'];
							for($i = 0; $i < count($vendor_tool); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $vendor_tool[$i]['procurement_reference']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['entity_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['sub_contract_vendors']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['tool_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['vendor_description']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>




		</div>
		<?php
	}
}


function UpdateUser($email)
{
	global $conn;
	$val="";
   $flag=0;
   $admin="";
   $i=0;
   $sql="SELECT distinct(username) FROM users where username='".$email."';";
   $result = mysqli_query($conn, $sql);
   while($output = mysqli_fetch_array($result))
    {
   	//var_dump($output['username']);
		$user = $output['username'];
		if($user === $email)
			{$flag=1;}
		$i++;
		}
		if ($flag === 0)
		{
			if($email)
			{
				$sql="INSERT INTO users(username,admin,created_date,updated_date) VALUES ('".$email."',0,CURDATE(),CURDATE());";
				if (mysqli_query($conn, $sql)) {
				    //echo "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
		else
		{
			$sql="UPDATE users set updated_date= CURDATE() where username='".$email."';";	
			if (mysqli_query($conn, $sql)) {
			  //  echo "Record updated successfully";
			} else {
			    echo "Error updating record: " . mysqli_error($conn);
			}
	}
	 $sql="SELECT admin FROM users where username='".$email."';";
     $result = mysqli_query($conn, $sql);
    while($output = mysqli_fetch_array($result))
    {
		$admin = $output['admin'];
	}
    return($admin);
}


function showSATable($output) {
	// var_dump($output);
	?>
	<h4 class="search-criteria">Search Criteria : <?php echo $output['id']; ?></h4>
	<?php
	if(!$output['error']) {
		?>
		<h3 class="header-title"> <?php echo $output['token']; ?> CIC Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="sa_data">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									ID
								</th>
								<th class="cell100 column2">
									IBM CIC Name 
								</th>
								<th class="cell100 column3">
									IBM CIC full address 
								</th>
								<th class="cell100 column4">
									Country
								</th>
								<th class="cell100 column5">
									Is Your CIC delivering this service YES / NO
								</th>
								<th class="cell100 column5">
									IBM Entity Name or 3rd Party Vendor name
								</th>
								<th class="cell100 column5">
									Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors
								</th>
								<th class="cell100 column5">
									Service Area
								</th>
								<th class="cell100 column5">
									GSO
								</th>
								<th class="cell100 column5">
									Service Area Contact Owner
								</th>
								<th class="cell100 column5">
									Assesment Owner
								</th>
								<th class="cell100 column5">
									Note
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$vendor_tool = $output['data'];
							for($i = 0; $i < count($vendor_tool); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $vendor_tool[$i]['id']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['ibm_cic_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['ibm_cic_address']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['cic_delivering_service']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['entity_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['sub_contracting_vendor']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['service_area']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['gso']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['service_contact']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['assesment_owner']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['note']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
}


function showPivotSATable($output) {
	// var_dump($output);
	?>
	<h4 class="search-criteria">Search Criteria : <?php echo $output['ibm_cic_name']; ?></h4>
	<?php
	if(!$output['error']) {
		?>
		<h3 class="header-title">CIC Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="pivotSA">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column2">
									Service Area
								</th>
								<th class="cell100 column3">
									Count 
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$vendor_tool = $output;
							for($i = 0; $i < count($vendor_tool); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><center><?php echo $vendor_tool[$i]['service_area']; ?></center></td>
								<td class="cell100 column2"><center><?php echo $vendor_tool[$i]['Count']; ?></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
}

function showCICTable($output) {
	// var_dump($output);
	?>
	<h4 class="search-criteria">Search Criteria : <?php echo $output['service_area']; ?></h4>
	<?php
	if(!$output['error']) {
		?>
		<h3 class="header-title"><?php echo $output['token']; ?> Service Area Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="cic_data">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									ID
								</th>
								<th class="cell100 column2">
									IBM CIC Name 
								</th>
								<th class="cell100 column3">
									IBM CIC full address 
								</th>
								<th class="cell100 column4">
									Country
								</th>
								<th class="cell100 column5">
									Is Your CIC delivering this service YES / NO
								</th>
								<th class="cell100 column5">
									IBM Entity Name or 3rd Party Vendor name
								</th>
								<th class="cell100 column5">
									Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors
								</th>
								<th class="cell100 column5">
									Service Area
								</th>
								<th class="cell100 column5">
									GSO
								</th>
								<th class="cell100 column5">
									Service Area Contact Owner
								</th>
								<th class="cell100 column5">
									Assessment Owner
								</th>
								<th class="cell100 column5">
									Note
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$vendor_tool = $output['data'];
							for($i = 0; $i < count($vendor_tool); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $vendor_tool[$i]['id']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['ibm_cic_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['ibm_cic_address']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['cic_delivering_service']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['entity_name']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['sub_contracting_vendor']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['service_area']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['gso']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['service_contact']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['assesment_owner']; ?></td>
								<td class="cell100 column2"><?php echo $vendor_tool[$i]['note']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
}

function showPivotCICTable($output) {
	// var_dump($output);
	?>
	<h4 class="search-criteria">Search Criteria : <?php echo $output['service_area']; ?></h4>
	<?php
	if(!$output['error']) {
		?>
		<h3 class="header-title">Service Area Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="vendor_tool">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									IBM CIC Name
								</th>
								<th class="cell100 column2">
									Count
								</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							$vendor_tool = $output;
							for($i = 0; $i < count($vendor_tool); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><center><?php echo $vendor_tool[$i]['ibm_cic_name']; ?></center></td>
								<td class="cell100 column2"><center><?php echo $vendor_tool[$i]['Count']; ?></center></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
}


/**
 *
 * Method to get the Service Area data
 *
 */
function getSAData($sa,$table) {
	global $conn;
	$return_array = array();
	$criteria = implode(',', $sa);
	$implode_vendor = implode ( "', '", $sa );
	$query = "SELECT * from ibm_".$table."_cic where ibm_cic_name IN ('".$implode_vendor."')";
	$result = mysqli_query($conn, $query);
	$return_array['ibm_cic_name'] = $criteria;	
	$return_array['token'] = strtoupper($table);
	if(mysqli_num_rows($result) > 0) 	{
	$i = 0;
	while ($output = mysqli_fetch_array($result)) {
		$return_array['data'][$i]['id'] = $output['id'];
		$return_array['data'][$i]['ibm_cic_name'] = $output['ibm_cic_name'];
		$return_array['data'][$i]['ibm_cic_address'] = $output['ibm_cic_address'];
		$return_array['data'][$i]['cic_delivering_service'] = $output['cic_delivering_service'];
		$return_array['data'][$i]['country'] = $output['country'];
		$return_array['data'][$i]['entity_name'] = $output['entity_name'];
		$return_array['data'][$i]['sub_contracting_vendor'] = $output['sub_contracting_vendor'];
		$return_array['data'][$i]['service_area'] = $output['service_area'];		
		$return_array['data'][$i]['supplier_address'] = $output['supplier_address'];
		$return_array['data'][$i]['gso'] = $output['gso'];
		$return_array['data'][$i]['service_contact'] = $output['service_contact'];
		$return_array['data'][$i]['assesment_owner'] = $output['assesment_owner'];
		$return_array['data'][$i]['note'] = $output['note'];
		$i++;
	}
}
	return $return_array;
}

/**
 *
 * Method to get the Pivot Service Area data
 *
 */
function getPivotSAData($sa,$table) {
	global $conn;
	$return_array = array();
	$criteria = implode(',', $sa);
	$implode_vendor = implode ( "', '", $sa );
	$query = "SELECT service_area, count(ibm_cic_name) as Count from ibm_".$table."_cic where ibm_cic_name IN ('".$implode_vendor."') group by service_area";
	$result = mysqli_query($conn, $query);
	$i = 0;
	$return_array['ibm_cic_name'] = $criteria;	
	while ($output = mysqli_fetch_array($result)) {
		$return_array[$i]['Count'] = $output['Count'];
		$return_array[$i]['service_area'] = $output['service_area'];
		$i++;
	}
	return $return_array;
}

/**
 *
 * Method to get the CIC data
 *
 */
function getCICData($cic,$table) {
	global $conn;
	//var_dump($cic);
	$return_array = array();
	$criteria = implode(',', $cic);
	$implode_vendor = implode ( "', '", $cic );
	$query = "SELECT * from ibm_".$table."_cic where service_area IN ('".$implode_vendor."')";
	//echo $query;
	$result = mysqli_query($conn, $query);
	$return_array['service_area'] = $criteria;	
	$return_array['token'] = strtoupper($table);
	if(mysqli_num_rows($result) > 0) {	
	$i = 0;
	while ($output = mysqli_fetch_array($result)) {
		$return_array['data'][$i]['id'] = $output['id'];
		$return_array['data'][$i]['ibm_cic_name'] = $output['ibm_cic_name'];
		$return_array['data'][$i]['ibm_cic_address'] = $output['ibm_cic_address'];
		$return_array['data'][$i]['cic_delivering_service'] = $output['cic_delivering_service'];
		$return_array['data'][$i]['country'] = $output['country'];
		$return_array['data'][$i]['entity_name'] = $output['entity_name'];
		$return_array['data'][$i]['sub_contracting_vendor'] = $output['sub_contracting_vendor'];
		$return_array['data'][$i]['service_area'] = $output['service_area'];		
		$return_array['data'][$i]['supplier_address'] = $output['supplier_address'];
		$return_array['data'][$i]['gso'] = $output['gso'];
		$return_array['data'][$i]['service_contact'] = $output['service_contact'];
		$return_array['data'][$i]['assesment_owner'] = $output['assesment_owner'];
		$return_array['data'][$i]['note'] = $output['note'];
		$i++;
	}
} else {
$return_array['error'] = 'failed';
	
}
return $return_array;
}
/**
 *
 * Method to get the Pivot CIC data
 *
 */
function getPivotCICData($cic,$table) {
	global $conn;
	//var_dump($cic);
	$return_array = array();
	$criteria = implode(',', $cic);
	$implode_vendor = implode ( "', '", $cic );
	$query = "SELECT ibm_cic_name, count(service_area) as Count from ibm_".$table."_cic where service_area IN ('".$implode_vendor."') group by ibm_cic_name";
	//echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;
	$return_array['service_area'] = $criteria;	
	while ($output = mysqli_fetch_array($result)) {
		$return_array[$i]['Count'] = $output['Count'];
		$return_array[$i]['ibm_cic_name'] = $output['ibm_cic_name'];
		$i++;
	}
	return $return_array;
}

/**
 *
 * Method to get the select box value for IBM CIC Name
 *
 */
function getSelectCICName($table) {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(ibm_cic_name) FROM ibm_".$table."_cic";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['ibm_cic_name'] = $output['ibm_cic_name'];
		$i++;
	}
	return $return_array;
}
/**
 *
 * Method to get the select box value for Service Area Name
 *
 */
function getSelectSAName($table) {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(service_area) FROM ibm_".$table."_cic";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['service_area'] = $output['service_area'];
		$i++;
	}
	return $return_array;
}


function showVendorTable1($output) {
    // var_dump($output);
    ?>
    <h4 class="search-criteria">Search Criteria : <?php echo $output['vendor']; ?></h4>
    <?php
    if(!$output['error']) {
        ?>
        <h3 class="header-title">Tool Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    Procurement Reference
                                </th>
                                <th class="cell100 column2">
                                    Entity Name
                                </th>
                                <th class="cell100 column3">
                                     Country
                                </th>
                                <th class="cell100 column4">
                                   Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors 
                                </th>
                                <th class="cell100 column5">
                                    Tool Name
                                </th>
                                <th class="cell100 column5">
                                    Vendor Service Description (GSAR)
                                </th>
                                <th class="cell100 column5">
                                    on boarding
                                </th>
                                <th class="cell100 column5">
                                    off boarding
                                </th>
                                <th class="cell100 column5">
                                    tool owner
                                </th>
                                <th class="cell100 column5">
                                    assessment owner
                                </th>
                                <th class="cell100 column5">
                                    note
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output['getvendor'];
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><?php echo $vendor_tool[$i]['procurement_reference']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['entity_name']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['country']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['sub_contract_vendors']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['tool_name']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['vendor_description']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['on_boarding']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['off_boarding']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['tool_owner']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['assessment_owner']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['note']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
 
 
 
function getVendorData_1($vendor) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $vendor);
    $implode_vendor = implode ( "', '", $vendor );
    $query = "SELECT * from global_tool where tool_name IN ('".$implode_vendor."')";
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['vendor'] = $criteria;    
    while ($output = mysqli_fetch_array($result)) {
        $return_array['getvendor'][$i]['procurement_reference'] = $output['procurement_reference'];
        $return_array['getvendor'][$i]['entity_name'] = $output['entity_name'];
        $return_array['getvendor'][$i]['country'] = $output['country'];
        $return_array['getvendor'][$i]['sub_contract_vendors'] = $output['sub_contract_vendors'];
        $return_array['getvendor'][$i]['tool_name'] = $output['tool_name'];
        $return_array['getvendor'][$i]['vendor_description'] = $output['vendor_description'];
        $return_array['getvendor'][$i]['on_boarding'] = $output['on_boarding'];
        $return_array['getvendor'][$i]['off_boarding'] = $output['off_boarding'];
        $return_array['getvendor'][$i]['tool_owner'] = $output['tool_owner'];
        $return_array['getvendor'][$i]['assessment_owner'] = $output['assessment_owner'];
        $return_array['getvendor'][$i]['note'] = $output['note'];
        $i++;
    }
    return $return_array;
}
 
 
 
 
function getVendorData_count($customer) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $customer);
    $implode_vendor = implode ( "', '", $customer );
    $query = "select count(procurement_reference) as COUNT , tool_name  from global_tool where tool_name  IN ('".$implode_vendor."') group by procurement_reference";
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['customer'] = $criteria;    
    while ($output = mysqli_fetch_array($result)) {
        $return_array[$i]['COUNT'] = $output['COUNT'];
        $return_array[$i]['tool_name'] = $output['tool_name'];
        $i++;
    }
    return $return_array;
}
 
 
 
 
function showVendorTable_count($output) {
    // var_dump($output);
    ?>
    <h4 class="search-criteria">Search Criteria : <?php echo $output['customer']; ?></h4>
    <?php
    if(!$output['error']) {
        ?>
        <h3 class="header-title">Tool Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    Count - Entity Name (IBM or Third Party vendor)
                                </th>
                                <th class="cell100 column2">
                                    Tool Name/Tool reference
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output;
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['COUNT']; ?></center></td>
                                <td class="cell100 column2"><center><?php echo $vendor_tool[$i]['tool_name']; ?></center></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
 
 
function showCountryTable($output) {
    // var_dump($output);
    ?>
    <h4 class="search-criteria">Search Criteria : <?php echo $output['country']; ?></h4>
    <?php
    if(!$output['error']) {
        ?>
        <h3 class="header-title">Data Center Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    procurement_vendor
                                </th>
                                <th class="cell100 column2">
                                    supplier_name
                                </th>
                                <th class="cell100 column3">
                                    address_country
                                </th>
                                <th class="cell100 column4">
                                     Vendor Service Description (GSAR)
                                </th>
                                <th class="cell100 column5">
                                    Identify Customer
                                </th>
                                <th class="cell100 column5">
                                    Imt
                                </th>
                                <th class="cell100 column5">
                                    Iot
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output['data'];
                            
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><?php echo $vendor_tool[$i]['procurement_vendor']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['supplier_name']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['address_country']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['service_area']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['identify_customer']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['imt']; ?></td>
                                <td class="cell100 column2"><?php echo $vendor_tool[$i]['iot']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
 
 
function getCountryData($country) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $country);
    $implode_vendor = implode ( "', '", $country );
    $query = "SELECT * from ibm_data_center where address_country IN ('".$implode_vendor."')";
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['country'] = $criteria;    
    while ($output = mysqli_fetch_array($result)) {
        $return_array['data'][$i]['procurement_vendor'] = $output['procurement_vendor'];
        $return_array['data'][$i]['supplier_name'] = $output['supplier_name'];
        $return_array['data'][$i]['address_country'] = $output['address_country'];
        $return_array['data'][$i]['service_area'] = $output['service_area'];
        $return_array['data'][$i]['identify_customer'] = $output['identify_customer'];
        $return_array['data'][$i]['imt'] = $output['imt'];
        $return_array['data'][$i]['iot'] = $output['iot'];
        $i++;
    }
    return $return_array;
}
 
 
 
function showCountTable($output) {
    // var_dump($output);
    ?>
    <h4 class="search-criteria">Search Criteria : <?php echo $output['country']; ?></h4>
    <?php
    if(!$output['error']) {
        ?>
        <h3 class="header-title">Tool Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    Count - Procurement Vendor ID
                                </th>
                                <th class="cell100 column2">
                                    supplier_name
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output;
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['COUNT']; ?></center></td>
                                <td class="cell100 column2"><center><?php echo $vendor_tool[$i]['supplier_name']; ?></center></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
 
 
function getCountData($country) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $country);
    $implode_vendor = implode ( "', '", $country );
    $query = "select count(procurement_vendor) as COUNT , supplier_name from ibm_data_center where address_country IN ('".$implode_vendor."') group by procurement_vendor";
    // print $query;
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['country'] = $criteria;    
    while ($output = mysqli_fetch_array($result)) {
        $return_array[$i]['COUNT'] = $output['COUNT'];
        $return_array[$i]['supplier_name'] = $output['supplier_name'];
        $i++;
    }
    return $return_array;
}
 
 
function showCountryTable_datacenter($output) {
    // var_dump($output);
    ?>
    <h4 class="search-criteria">Search Criteria : <?php echo $output['customer']; ?></h4>
    <?php
    if(!$output['error']) {
        ?>
        <h3 class="header-title">Data Center Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    procurement_vendor
                                </th>
                                <th class="cell100 column2">
                                    supplier_name
                                </th>
                                <th class="cell100 column1">
                                    address_country
                                </th>
                                <th class="cell100 column2">
                                     Vendor Service Description (GSAR)
                                </th>
                                <th class="cell100 column1">
                                    subcontract_vendor
                                </th>
                                <th class="cell100 column2">
                                    identify_customer
                                </th>
                                <th class="cell100 column1">
                                    imt
                                </th>
                                <th class="cell100 column2">
                                    iot
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output['data'];
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['procurement_vendor']; ?></center></td>
                                <td class="cell100 column2"><center><?php echo $vendor_tool[$i]['supplier_name']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['address_country']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['service_area']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['subcontract_vendor']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['identify_customer']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['imt']; ?></center></td>
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['iot']; ?></center></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
function getCustomerData_datacenter($customer) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $customer);
    $implode_vendor = implode ( "', '", $customer );
    $query = "SELECT * from ibm_data_center where identify_customer IN ('".$implode_vendor."')";
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['customer'] = $criteria;
    if(mysqli_num_rows($result) > 0) {   
    while ($output = mysqli_fetch_array($result)) {
        $return_array['data'][$i]['procurement_vendor'] = $output['procurement_vendor'];
        $return_array['data'][$i]['supplier_name'] = $output['supplier_name'];
        $return_array['data'][$i]['address_country'] = $output['address_country'];
        $return_array['data'][$i]['service_area'] = $output['service_area'];
        $return_array['data'][$i]['subcontract_vendor'] = $output['subcontract_vendor'];
        $return_array['data'][$i]['identify_customer'] = $output['identify_customer'];
        $return_array['data'][$i]['imt'] = $output['imt'];
        $return_array['data'][$i]['iot'] = $output['iot'];
        $i++;
    }
} else {
	$return_array['error'] = 'failed';
    
}
return $return_array;
}
 
 
function showCountryCountTable_datacenter($output) {
    // var_dump($output);
    ?>
    <?php
    if(!$output['error']) {
        ?>

    <h4 class="search-criteria">Search Criteria : <?php echo $output['customer']; ?></h4>
        <h3 class="header-title">Customer Search Results</h3>
        <div class="clearfix"></div>
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                
                <div class="table100-body">
                    <table id="vendor_tool">
                    <thead>
                            <tr class="row100 head">
                                <th class="cell100 column1">
                                    COUNT
                                </th>
                                <th class="cell100 column2">
                                    supplier_name
                                </th>
                                <th class="cell100 column2">
                                    address_country
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vendor_tool = $output;
                            
                            for($i = 0; $i < count($vendor_tool); $i++) { ?>
                            <tr class="row100 body">
                                <td class="cell100 column1"><center><?php echo $vendor_tool[$i]['COUNT']; ?></center></td>
                                <td class="cell100 column2"><center><?php echo $vendor_tool[$i]['supplier_name']; ?></center></td>
                                <td class="cell100 column2"><center><?php echo $vendor_tool[$i]['address_country']; ?></center></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
 

        </div>
        <?php
    }
}
 
function getCustomerCountData_datacenter($customer) {
    global $conn;
    $return_array = array();
    $criteria = implode(',', $customer);
    $implode_vendor = implode ( "', '", $customer );
    $query = "select count(procurement_vendor) as COUNT , supplier_name , address_country from ibm_data_center where identify_customer IN ('".$implode_vendor."') group by procurement_vendor";
    $result = mysqli_query($conn, $query);
    $i = 0;
    $return_array['customer'] = $criteria;    
    while ($output = mysqli_fetch_array($result)) {
        $return_array[$i]['COUNT'] = $output['COUNT'];
        $return_array[$i]['supplier_name'] = $output['supplier_name'];
        $return_array[$i]['address_country'] = $output['address_country'];
        $i++;
    }
    return $return_array;
}

function getSelectCountry() {
	global $conn;
	$return_array = array();
	$query = "SELECT distinct(address_country) FROM ibm_data_center";

	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['country_name'] = $output['address_country'];
		$i++;
	}
	return $return_array;
} 

function getSelectCustomer_datacenter() {
    global $conn;
    $return_array = array();
    $query = "select distinct identify_customer from ibm_data_center";

    $result = mysqli_query($conn, $query);
    $i = 0;
    while($output = mysqli_fetch_array($result)) {
        $return_array[$i]['identify_customer'] = $output['identify_customer'];
        $i++;
    }
    return $return_array;
} 

function showGeoTable($output) {

	if($output['error'] != 1) {
		?>
		<h4 class="search-criteria">Search Location : <?php  echo $output['geo_loc']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search Criteria : <?php echo $output['vendor']; ?></h4>

		<h3 class="header-title">Geo Location Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="geo_export">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									Procurement Vendor ID
								</th>
								<th class="cell100 column2">
									Supplier Name 
								</th>
								<th class="cell100 column3">
									Country
								</th>
								<th class="cell100 column3">
									Full Supplier Address
								</th>
								<th class="cell100 column4">
									VAT Number
								</th>
								<th class="cell100 column5">
									PO Number (if  first tier vendor) or ICA-DOU (if IBM entity or IBM Subsidiary)
								</th>
								<th class="cell100 column5">
									Is the PO GDPR Relevant? 
								</th>
								<th class="cell100 column5">
									Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors  
								</th>
								<th class="cell100 column5">
									Briefly describe the type of services/data processing activity performed by the Vendor 
								</th>
								<th class="cell100 column5">
									 In what category is the Vendor's Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))
								</th>
								<th class="cell100 column5">
									PO Status 
								</th>
								<th class="cell100 column5">
									Start Date 
								</th>
								<th class="cell100 column5">
									End Date 
								</th>
								<th class="cell100 column5">
									Business Unit that provide the services through this vendor(free text ) 
								</th>
								<th class="cell100 column5">
									Requester/Approver Name 
								</th>
								<th class="cell100 column5">
									Please identify the Customer(s) or Account(s) under the PO 
								</th>
								<th class="cell100 column5">
									NOTE 
								</th>
								<th class="cell100 column5">
									FP - T&M 
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$geo_search = $output;
							for($i = 0; $i < count($geo_search); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $geo_search[$i]['procurement_vendor']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['supplier_name']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['full_supplier_address']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['vat_number']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_number']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_relevant']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['sub_contract_vendors']; ?></td>
								<td class="cell100 column1"><?php echo $geo_search[$i]['describe_service']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['vendor_service']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_status']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['start_date']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['end_date']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['business_unit']; ?></td>
								<td class="cell100 column1"><?php echo $geo_search[$i]['requester_approver']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['identify_customer']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['note']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['fp_tm']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
	else {
		//echo "No Data Found for Geo ";
	}
}

function getGeoData($vendor, $geo) {
	global $conn;

	$geo1 = "_geo";
	$return_array = array();
	$return_array['error'] = 1;
	$i = 0;
	$criteria = implode(',', $vendor);
	foreach($geo as $val) {
		$return_array['geo_loc'] = strtoupper($val);
		$geo = $val.$geo1;
		$implode_vendor = implode ( "', '", $vendor );
		$query = "SELECT * from ".$geo." where identify_customer IN ('".$implode_vendor."') OR identify_customer LIKE 'All %'";
	//	echo $query;
		$result = mysqli_query($conn, $query);
		$return_array['vendor'] = $criteria;	
		if ($result) {
			while ($output = mysqli_fetch_array($result)) {
				$return_array[$i]['procurement_vendor'] = $output['procurement_vendor'];
				$return_array[$i]['supplier_name'] = $output['supplier_name'];
				$return_array[$i]['country'] = $output['country'];
				$return_array[$i]['full_supplier_address'] = $output['full_supplier_address'];
				$return_array[$i]['vat_number'] = $output['vat_number'];
				$return_array[$i]['po_number'] = $output['po_number'];
				$return_array[$i]['po_relevant'] = $output['po_relevant'];
				$return_array[$i]['sub_contract_vendors'] = $output['sub_contract_vendors'];
				$return_array[$i]['describe_service'] = $output['describe_service'];
				$return_array[$i]['vendor_service'] = $output['vendor_service'];
				$return_array[$i]['po_status'] = $output['po_status'];
				$return_array[$i]['start_date'] = $output['start_date'];
				$return_array[$i]['end_date'] = $output['end_date'];
				$return_array[$i]['business_unit'] = $output['business_unit'];
				$return_array[$i]['requester_approver'] = $output['requester_approver'];
				$return_array[$i]['identify_customer'] = $output['identify_customer'];
				$return_array[$i]['note'] = $output['note'];
				$return_array[$i]['fp_tm'] = $output['fp_tm'];
				$i++;
				$return_array['error'] = 0;
			}
		}
	}
	return $return_array;
}


function showGeoTableEurope($output) {
	
	if($output['error'] != 1) {
		?>
		<h4 class="search-criteria">Search Location : <?php  echo $output['geo_loc']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search Market : <?php  echo $output['market']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Search Criteria : <?php echo $output['vendor']; ?></h4>

		<h3 class="header-title">Geo Location Search Results</h3>
		<div class="clearfix"></div>
		<div class="wrap-table100">
			<div class="table100 ver1 m-b-110">
				
				<div class="table100-body">
					<table id="geo_eu_export">
					<thead>
							<tr class="row100 head">
								<th class="cell100 column1">
									Procurement Vendor ID
								</th>
								<th class="cell100 column2">
									Supplier Name 
								</th>
								<th class="cell100 column4">
									VAT Number
								</th>
								<th class="cell100 column4">
									Subcontractos
								</th>
								<th class="cell100 column3">
									Country
								</th>
								<th class="cell100 column5">
									Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors
								</th>
								<th class="cell100 column5">
									PO Number (if  first tier vendor) or ICA-DOU (if IBM entity or IBM Subsidiary)
								</th>
								<th class="cell100 column5">
									Family code  
								</th>
								<th class="cell100 column5">
									PO/BSAP/ICA/DOU full description
								</th>
								<th class="cell100 column5">
									Briefly describe the type of services/data processing activity performed by the Vendor
								</th>
								<th class="cell100 column5">
									Service Caegory was identified (Y/N) 
								</th>
								<th class="cell100 column5">
									In what category is the Vendor's Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))
								</th>
								<th class="cell100 column5">
									PO Status 
								</th>
								<th class="cell100 column5">
									Start Date
								</th>
								<th class="cell100 column5">
									End Date 
								</th>
								<th class="cell100 column5">
									PO/ICA Amount(not mandatory - free text) 
								</th>
								<th class="cell100 column5">
									Business Unit that provide the services through this vendor(free text ) 
								</th>
								<th class="cell100 column5">
									Requester/Approver Name
								</th>
								<th class="cell100 column5">
									Please identify the Customer(s) or Account(s) under the PO  
								</th>
								<th class="cell100 column5">
									NOTE
								</th>
								<th class="cell100 column5">
									Is the PO GDPR Relevant? 
								</th>
								<th class="cell100 column5">
									Market
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$geo_search = $output;
							for($i = 0; $i < count($geo_search); $i++) { ?>
							<tr class="row100 body">
								<td class="cell100 column1"><?php echo $geo_search[$i]['procurement_vendor_id']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['supplier_name']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['vat_number']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['Subcontractos']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['country']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['sub_contract_vendors']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_number']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['family_code']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_bsap_ica']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['describe_service']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['service_category']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['vendor_service']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_status']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['start_date']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['end_date']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_ica_amount']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['business_unit']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['requester_approver']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['customer_under_po']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['note']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['po_relevant']; ?></td>
								<td class="cell100 column2"><?php echo $geo_search[$i]['market']; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php
	}
	else {
		echo "No Data Found for Europe Geo";
	}
}

/**
 *
 * Method to get the select box value for Multi Cust Search
 *
 */
function getMultiCust() {
	global $conn;
	$return_array = array();
	$query = "select distinct(cust_nm) from sbliw order by cust_nm limit 19, 20";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['name'] = $output['cust_nm'];
		$i++;
	}
	return $return_array;
}

function getGeoDataEurope($vendor, $geo, $market='') {
	global $conn;

	$geo1 = "_geo";
	$return_array = array();
	$return_array['error'] = 1;
	$return_array['geo_loc'] = strtoupper($geo);
	$return_array['market'] = $market;
	$geo = $geo.$geo1;
	$criteria = implode(',', $vendor);
	$implode_vendor = implode ( "', '", $vendor );
	$query = "SELECT * from ".$geo." where (customer_under_po IN ('".$implode_vendor."') OR customer_under_po LIKE 'All %') and (market = '".$market."')";
	//echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;
	$return_array['vendor'] = $criteria;	
	if ($result){
		while ($output = mysqli_fetch_array($result)) {
			$return_array[$i]['procurement_vendor_id'] = $output['procurement_vendor_id'];
			$return_array[$i]['supplier_name'] = $output['supplier_name'];
			$return_array[$i]['vat_number'] = $output['vat_number'];
			$return_array[$i]['Subcontractos'] = $output['Subcontractos'];
			$return_array[$i]['country'] = $output['country'];
			$return_array[$i]['sub_contract_vendors'] = $output['sub_contract_vendors'];
			$return_array[$i]['po_number'] = $output['po_number'];
			$return_array[$i]['family_code'] = $output['family_code'];
			$return_array[$i]['po_bsap_ica'] = $output['po_bsap_ica'];
			$return_array[$i]['describe_service'] = $output['describe_service'];
			$return_array[$i]['service_category'] = $output['service_category'];
			$return_array[$i]['vendor_service'] = $output['vendor_service'];
			$return_array[$i]['po_status'] = $output['po_status'];
			$return_array[$i]['start_date'] = $output['start_date'];
			$return_array[$i]['end_date'] = $output['end_date'];
			$return_array[$i]['po_ica_amount'] = $output['po_ica_amount'];
			$return_array[$i]['business_unit'] = $output['business_unit'];
			$return_array[$i]['requester_approver'] = $output['requester_approver'];
			$return_array[$i]['customer_under_po'] = $output['customer_under_po'];
			$return_array[$i]['note'] = $output['note'];
			$return_array[$i]['po_relevant'] = $output['po_relevant'];
			$return_array[$i]['market'] = $output['market'];
			$i++;
			$return_array['error'] = 0;
		}
	}
	return $return_array;
}
?>