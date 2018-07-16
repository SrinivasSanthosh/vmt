<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
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
 * method to get the page details
 *
 */
function getPageDetails() {
	$page_url = $_SERVER['REQUEST_URI'];
	$page_url_array = explode('/', $page_url);
	$menu_array = array('index.php', 'global-offering.php', 'eu.php', 'na-geo.php', 'japan.php', 'la.php', 'gcg.php', 'ap.php', 'data-center.php', 'cic.php','admin.php','sbliw.php','global_cic.php','local_cic.php','data_centre.php','mea_geo.php');
	$page_url = $page_url_array[2];
	$return_array = array();
	$return_array['page_url'] = $page_url;
	if(in_array('index.php', $page_url_array)) {
		$return_array['page_title'] = "Global Tool";
		$return_array['iactive'] = (($page_url == $menu_array[0])) ? 'class="active"' : 'class=""';
	} elseif (in_array('global-offering.php', $page_url_array)) {
		$return_array['page_title'] = "Global Offering";
		$return_array['goactive'] = (($page_url == $menu_array[1])) ? 'class="active"' : 'class=""';
	} elseif (in_array('eu.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Europe";
		$return_array['euactive'] = (($page_url == $menu_array[2])) ? 'class="active"' : 'class=""';
	} elseif (in_array('na-geo.php', $page_url_array)) {
		$return_array['page_title'] = "Query from NA GEO";
		$return_array['naactive'] = (($page_url == $menu_array[3])) ? 'class="active"' : 'class=""';
	} elseif (in_array('japan.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Japan";
		$return_array['jactive'] = (($page_url == $menu_array[4])) ? 'class="active"' : 'class=""';
	} elseif (in_array('la.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Latin America";
		$return_array['lactive'] = (($page_url == $menu_array[5])) ? 'class="active"' : 'class=""';
	} elseif (in_array('gcg.php', $page_url_array)) {
		$return_array['page_title'] = "Query from GCG";
		$return_array['gactive'] = (($page_url == $menu_array[6])) ? 'class="active"' : 'class=""';
	} elseif (in_array('ap.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Asia Pacific";
		$return_array['apactive'] = (($page_url == $menu_array[7])) ? 'class="active"' : 'class=""';
	} elseif (in_array('data-center.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Data Center";
		$return_array['dcactive'] = (($page_url == $menu_array[8])) ? 'class="active"' : 'class=""';
	} elseif (in_array('cic.php', $page_url_array)) {
		$return_array['page_title'] = "Query from IBM CIC";
		$return_array['cicactive'] = (($page_url == $menu_array[9])) ? 'class="active"' : 'class=""';
	} elseif (in_array('admin.php', $page_url_array)) {
		$return_array['page_title'] = "Query from admin";
		$return_array['admin'] = (($page_url == $menu_array[10])) ? 'class="active"' : 'class=""';
	}
	elseif (in_array('sbliw.php', $page_url_array)) {
		$return_array['page_title'] = "Query from Sbliw";
		$return_array['sbliw'] = (($page_url == $menu_array[11])) ? 'class="active"' : 'class=""';
	}
	elseif (in_array('global_cic.php', $page_url_array)) {
        $return_array['page_title'] = "Query from Global Cic";
        $return_array['global_cic'] = (($page_url == $menu_array[12])) ? 'class="active"' : 'class=""';
    }
    elseif (in_array('local_cic.php', $page_url_array)) {
        $return_array['page_title'] = "Query from Local Cic";
        $return_array['local_cic'] = (($page_url == $menu_array[13])) ? 'class="active"' : 'class=""';
    }
    elseif (in_array('data_centre.php', $page_url_array)) {
        $return_array['page_title'] = "Query from Data Center";
        $return_array['data_center'] = (($page_url == $menu_array[14])) ? 'class="active"' : 'class=""';
    }
 	 elseif (in_array('mea_geo.php', $page_url_array)) {
        $return_array['page_title'] = "Query from MEA Geo";
        $return_array['mea_geo'] = (($page_url == $menu_array[15])) ? 'class="active"' : 'class=""';
    }
	return $return_array;
}
/**
 *
 * method to get the global tool data
 *
 */
function getUsers(){
	global $conn;
	$return_array = array();
	$query = "SELECT * FROM users";
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['id'] = $output['id'];
		$return_array[$i]['username'] = $output['username'];
		$return_array[$i]['admin'] = $output['admin'];
		$return_array[$i]['created_date'] = $output['created_date'];
		$return_array[$i]['updated_date'] = $output['updated_date'];
		$i++;
	}
	return $return_array;
}
function updateUsers($id,$adm){
	global $conn;
	$query = "UPDATE users set admin =" . $adm . ",updated_date = current_date where id=" .$id;
	//print $query;
	$result = mysqli_query($conn, $query);
	//return $result;
	// header("http://localhost/gdpr/gdpr/admin.php");

}

function createuser($user){
	global $conn;
	$i=0;
	$flag=0;
	$sql="SELECT distinct(username) FROM users where username='".$user."';";
   $result = mysqli_query($conn, $sql);
   while($output = mysqli_fetch_array($result))
    {
		$username = $output['username'];
		if($username === $user)
			{$flag=1;}
		$i++;
	}
	if ($flag === 0)
	{
		$query = "insert into users(username,admin,created_date,updated_date) values ('$user',0,current_date,current_date)";
		$result = mysqli_query($conn, $query);
		echo "</br> User $user Added Successfully!";
	}
	else
	{
		echo "</br> Email $user Already Exists!";
	}
} 








function getGlobalTool($table){
global $conn;
$return_array=array();
$sql="SELECT * FROM ". $table;

$query=$conn->prepare($sql);

$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);

$i=0;

foreach($results as $result){

	$return_array[$i]['procurement_reference'] = $result->procurement_reference;
		$return_array[$i]['entity_name'] = $result->entity_name;
		$return_array[$i]['supplier_address'] = $result->country;
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		$return_array[$i]['tool_name'] = $result->tool_name;
		$return_array[$i]['vendor_description'] = $result->vendor_description;
		$return_array[$i]['on_boarding'] = $result->on_boarding;
		$return_array[$i]['off_boarding'] = $result->off_boarding;
		$return_array[$i]['tool_owner'] = $result->tool_owner;
		$return_array[$i]['assessment_owner'] = $result->assessment_owner;
		$return_array[$i]['note'] = $result->note;
		$i++;
}  


return $return_array;

}






/**
 *
 * method to get the global offering
 *
 */

function getGlobalOffering($table){
global $conn;
$return_array=array();
$sql="SELECT * FROM ". $table;

$query=$conn->prepare($sql);

$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);

$i=0;

foreach($results as $result){

	$return_array[$i]['procurement_reference'] = $result->procurement_reference;
		$return_array[$i]['entity_name'] = $result->entity_name;
		$return_array[$i]['supplier_address'] = $result->country;
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		$return_array[$i]['offering_id_30'] = $result->offering_id_30;
		$return_array[$i]['offering_id_40'] = $result->offering_id_40;
		$return_array[$i]['vendor_description'] = $result->vendor_description;
		$return_array[$i]['on_boarding'] = $result->on_boarding;
		$return_array[$i]['off_boarding'] = $result->off_boarding;
		$return_array[$i]['assessment_owner'] = $result->assessment_owner;
		$return_array[$i]['note'] = $result->note;
		$i++;
}  


return $return_array;

}
















/**
 *
 * method to get the EU GEO
 *
 */
function getEUTool($table) {
	global $conn;
$return_array=array();
$sql="SELECT * FROM ". $table;

$query=$conn->prepare($sql);

$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);

$i=0;

foreach($results as $result) {
		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] = $result->country;
		$return_array[$i]['vat_number'] = $result->vat_number;
		$return_array[$i]['subcontractor'] = $result->subcontractor;
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['family_code'] = $result->family_code;
		$return_array[$i]['po_bsap_ica'] = $result->po_bsap_ica;
		$return_array[$i]['describe_service'] = $result->describe_service;
		$return_array[$i]['service_category'] = $result->service_category;
		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		$return_array[$i]['po_ica_amount'] = $result->po_ica_amount;
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['customer_identified'] = $result->customer_identified;
		$return_array[$i]['customer_under_po'] = $result->customer_under_po;
		$return_array[$i]['note'] = $result->note;
		$return_array[$i]['po_relevant'] = $result->po_relevant;
		$return_array[$i]['market'] = $result->market;
		$return_array[$i]['market_done'] = $result->market_done;
		$return_array[$i]['action_owner'] = $result->action_owner;
		$return_array[$i]['data_input_complete'] = $result->data_input_complete;
		$return_array[$i]['next_person_chase'] = $result->next_person_chase;
		$return_array[$i]['check_ok'] = $result->check_ok;
		$return_array[$i]['po_close'] = $result->po_close;
		$i++;
	}
	return $return_array;
}










function getnageo($table){

	global $conn;

	$return_array=array();

	$sql="SELECT * FROM ". $table;
	$query=$conn->prepare($sql);
	$query->execute();

	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$i=0;
	foreach($results as $result){


		$return_array[$i]['po_number']=$result->po_number;

		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] = $result->full_supplier_address;
		$return_array[$i]['vat_number'] = $result->vat_number;
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['po_relevant'] = $result->po_relevant;

		
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		
		
		$return_array[$i]['describe_service'] = $result->describe_service;

		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['customer_identified'] = $result->customer_identified;
		$return_array[$i]['customer_under_po'] = $result->customer_under_po;
		$return_array[$i]['note'] = $result->note;
		$return_array[$i]['country'] = $result->country;
	
		$return_array[$i]['fp'] = $result->fp_tm;
		$i++;
	}
return $return_array;
}












function getjapangeo($table) {


	global $conn;
	$return_array=array();

	$sql="SELECT * FROM ". $table;
	$query=$conn->prepare($sql);
	$query->execute();

	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$i=0;

	foreach($results as $result){

$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] =$result->country;
		$return_array[$i]['vat_number'] = $result->vat_number;
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['po_relevant'] = $result->po_relevant;

		
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['identify_customer'] = $result->identify_customer;
		$return_array[$i]['note'] = $result->note;
		$i++;


	}

return $return_array;

}











function getlageo($table) {  


	global $conn;
	$return_array=array();
    $sql="SELECT * FROM ". $table;
    $query=$conn->prepare($sql);

    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    foreach($results as $result){

$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] = $result->full_supplier_address;
		$return_array[$i]['vat_number'] = $result->vat_number;
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['po_relevant'] = $result->po_relevant;

	
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		
		
		$return_array[$i]['describe_service'] = $result->describe_service;
		
		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['customer_identified'] = $result->customer_identified;
		
		$return_array[$i]['note'] = $result->note;
		$return_array[$i]['country'] = $result->country;
		
		
		$i++;

    }     


    return $return_array;   
}









function getgcggeo($table) {
global $conn;
	$return_array=array();
    $sql="SELECT * FROM ". $table;
    $query=$conn->prepare($sql);

    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    foreach($results as $result){
$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] = $result->country;
		$return_array[$i]['vat_number'] = $result->vat_number;
		// $return_array[$i]['subcontractor'] = $output['subcontractor'];
		//return_array[$i]['sub_contract_vendors'] = $output['sub_contract_vendors'];
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['po_relevant'] = $result->po_relevant;
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		// $return_array[$i]['family_code'] = $output['family_code'];
		// $return_array[$i]['po_bsap_ica'] = $output['po_bsap_ica'];
		$return_array[$i]['describe_service'] = $result->describe_service;
		// $return_array[$i]['service_category'] = $output['service_category'];
		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		// $return_array[$i]['po_ica_amount'] = $output['po_ica_amount'];
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['identify_customer'] = $result->identify_customer;
		// $return_array[$i]['customer_under_po'] = $output['customer_under_po'];
		$return_array[$i]['note'] = $result->note;
		
		$return_array[$i]['account_wbs'] = $result->account_wbs;
		$return_array[$i]['customer_contact'] = $result->customer_contact;
		$return_array[$i]['country'] = $result->country;
		$return_array[$i]['account'] = $result->account;
		$return_array[$i]['final_ra'] = $result->final_ra;
		$return_array[$i]['dpe_contact'] = $result->dpe_contact;
		$return_array[$i]['po_amount'] = $result->po_amount;
		$return_array[$i]['comgroup_cd'] = $result->comgroup_cd;
		$return_array[$i]['matlgrp_id'] = $result->matlgrp_id;
		$return_array[$i]['comgroup_cd_disc'] = $result->comgroup_cd_disc;
		$return_array[$i]['matlgrp_id_disc'] = $result->matlgrp_id_disc;
		$i++;
	}	
	return $return_array;
}























function getapgeo($table) {

global $conn;
	$return_array=array();
    $sql="SELECT * FROM ". $table;
    $query=$conn->prepare($sql);

    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    foreach($results as $result){

$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor;
		$return_array[$i]['supplier_name'] = $result->supplier_name;
		$return_array[$i]['full_supplier_address'] = $result->country;
		$return_array[$i]['vat_number'] = $result->vat_number;
		$return_array[$i]['po_number'] = $result->po_number;
		$return_array[$i]['po_relevant'] = $result->po_relevant;
		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
		$return_array[$i]['describe_service'] = $result->describe_service;
		$return_array[$i]['vendor_service'] = $result->vendor_service;
		$return_array[$i]['po_status'] = $result->po_status;
		$return_array[$i]['start_date'] = $result->start_date;
		$return_array[$i]['end_date'] = $result->end_date;
		$return_array[$i]['business_unit'] = $result->business_unit;
		$return_array[$i]['requester_approver'] = $result->requester_approver;
		$return_array[$i]['identify_customer'] = $result->identify_customer;
		$return_array[$i]['note'] = $result->note;
		$return_array[$i]['account_name'] = $result->account_name;
		
		$i++;
	}

	return $return_array;
}
















function getsbliw($table) {
	global $conn;
	$return_array = array();
	$query = "SELECT * FROM ". $table;
	echo $query;
	$result = mysqli_query($conn, $query);
	$i = 0;
	echo mysqli_num_rows($result);
	while($output = mysqli_fetch_array($result)) {
		//$return_array[$i]['po_number'] = $output['po_number'];
		$return_array[$i]['igs_ctry_grp_nm'] = $output['igs_ctry_grp_nm'];
		$return_array[$i]['iso_ctry_nm'] = $output['iso_ctry_nm'];
		$return_array[$i]['bus_measmt_div_nm'] = $output['bus_measmt_div_nm'];
		$return_array[$i]['offrg_cmpnt_cd'] = $output['offrg_cmpnt_cd'];
		$return_array[$i]['owng_org_cd'] = $output['owng_org_cd'];
		$return_array[$i]['cust_nm'] = $output['cust_nm'];
		$return_array[$i]['lgl_cntrct_id'] = $output['lgl_cntrct_id'];
		$return_array[$i]['proj_id'] = $output['proj_id'];
		$return_array[$i]['cntrct_end_dt'] = $output['cntrct_end_dt'];
		$return_array[$i]['service_line_cd'] = $output['service_line_cd'];
		$i++;
	}

	return $return_array;
}

function Validate_data($table) {

	global $conn;

	$myfile = $_FILES['fileToUpload']['tmp_name'];
	$loaded_file = $_FILES['fileToUpload']['name'];

	print $loaded_file;

	$column_count = array(
		"ap_geo" => "17",
		"europe_geo" => "29",
		"gcg_geo" => "27",
		"global_offering" => "12",
		"global_tool" => "11",
		"ibm_data_center" => "9",
		"ibm_global_cic" => "12",
		"ibm_local_cic" => "12",
		"japan_geo" => "16",
		"la_geo" => "17",
		"mea_geo" => "17",
		"na_geo" => "19",
		"sbliw" => "10"
		);
    if (!$loaded_file){
    	print "No File selected </br>";
    	exit;
    }
    $uploads_dir = 'tmp';
    $name = basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($myfile, $uploads_dir."/".$name);
	print "User selected value is " .$_REQUEST['load_type'] . "<br>";
	$extension = end(explode('.', $_FILES['fileToUpload']['name']));

		print "Filename to be uploaded is " . $loaded_file . "<br>";
		if($extension == 'csv')
		{
			echo 'File format is correct</br>';
		}
		else
		{
			echo 'Please upload the file in correct format. Only csv  file format is accepted </br> ';
			header( "Location: global-offering.php" );
			exit;
		}

	$file = file_get_contents( $uploads_dir."/".$name );	
	$SearchString = ",/'/\"";
	$breakstrings = explode('/',$SearchString);
	foreach ($breakstrings as $values)
	{
		if(strpos($file, $values)){
		echo "The File uploaded has ".$values."entries.</br>";
		echo "Rejecting the upload process!";
		exit;
		}
	}
	$flag=0;
	$file1 = fopen($uploads_dir."/".$name, 'r');
	while (($line = fgetcsv($file1)) !== FALSE) {
		$string_version = implode('|', $line);
		$value = substr_count($string_version,"|"); 
		if ( $value != ($column_count["$table"]-1) ){
			echo "Column count for ".$table." should be ". $column_count["$table"]." hence rejecting file upload ";
			$flag=1;
			exit;
		}
	}
	fclose($file1);
	if($flag == 0)
	{
		echo "Data File has correct length. Starting the upload Process...";
	}
	if ($_REQUEST['load_type'] == 'Fresh_Upload'){
	print "Deleting old data</br>";
	$query="delete from $table";
	$result = mysqli_query($conn, $query);
	}
	else
	{
		echo "Add to the existing data!";
	}
	$query="LOAD DATA LOCAL INFILE 'tmp/$name' INTO TABLE $table FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n' IGNORE 1 ROWS";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die("Could not load. " . mysql_error());
	}
	else
	{
		echo "File uploaded Successfully!";
	}
} 
 

function getglobal_cic($table) {
    global $conn;
    $return_array = array();
    $query = "SELECT * FROM ". $table;
    // echo $query;
    $result = mysqli_query($conn, $query);
    $i = 0;
    while($output = mysqli_fetch_array($result)) {
        $return_array[$i]['id'] = $output['id'];
        $return_array[$i]['ibm_cic_name'] = $output['ibm_cic_name'];
        $return_array[$i]['ibm_cic_address'] = $output['ibm_cic_address'];
        $return_array[$i]['country'] = $output['country'];
        $return_array[$i]['cic_delivering_service'] = $output['cic_delivering_service'];
        $return_array[$i]['entity_name'] = $output['entity_name'];
        $return_array[$i]['sub_contracting_vendor'] = $output['sub_contracting_vendor'];
        $return_array[$i]['service_area'] = $output['service_area'];
        $return_array[$i]['gso'] = $output['gso'];
        $return_array[$i]['service_contact'] = $output['service_contact'];
        $return_array[$i]['assesment_owner'] = $output['assesment_owner'];
        $return_array[$i]['note'] = $output['note'];
        $i++;
    }
    return $return_array;
}
 
 
 
function getdata_centre($table) {
    global $conn;
    $return_array = array();
    $query = "SELECT * FROM ". $table;
    // echo $query;
    $result = mysqli_query($conn, $query);
    $i = 0;
    while($output = mysqli_fetch_array($result)) {
        $return_array[$i]['procurement_vendor'] = $output['procurement_vendor'];
        $return_array[$i]['supplier_name'] = $output['supplier_name'];
        $return_array[$i]['address_country'] = $output['address_country'];
        $return_array[$i]['service_area'] = $output['service_area'];
        $return_array[$i]['subcontract_vendor'] = $output['subcontract_vendor'];
        $return_array[$i]['identify_customer'] = $output['identify_customer'];
        $return_array[$i]['imt'] = $output['imt'];
        $return_array[$i]['iot'] = $output['iot'];
        $i++;
    }
    return $return_array;
}
 
function getmeageo($table) {
	global $conn;
	$return_array = array();
	$query = "SELECT * FROM ". $table;
	$result = mysqli_query($conn, $query);
	$i = 0;
	while($output = mysqli_fetch_array($result)) {
		$return_array[$i]['procurement_vendor'] = $output['procurement_vendor'];
		$return_array[$i]['supplier_name'] = $output['supplier_name'];
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
		$return_array[$i]['account_component'] = $output['account_component'];
		$i++;
	}
	return $return_array;
} 

function UpdateUser($email)
{
	global $conn;
	$val="";
	$flag=0;
	$admin="";
	$i=0;
	$sql="SELECT admin FROM users where username='".$email."';";
	$result = mysqli_query($conn, $sql);
	while($output = mysqli_fetch_array($result))
	{
		$admin = $output['admin'];
	}
	return($admin);
}
?>