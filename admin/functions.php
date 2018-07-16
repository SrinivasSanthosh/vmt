

<?php
  error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
  include_once ('repository.php');
  //include_once('pagination.php');
  /**
   *
   * method to get the page details
   *
   */
  
  function getPageDetails()
  {
  	$page_url = $_SERVER['REQUEST_URI'];
  	$page_url_array = explode('/', $page_url);
  	$menu_array = array(
  		'index.php',
  		'global-offering.php',
  		'eu.php',
  		'na-geo.php',
  		'japan.php',
  		'la.php',
  		'gcg.php',
  		'ap.php',
  		'data-center.php',
  		'cic.php',
  		'admin.php',
  		'sbliw.php',
  		'global_cic.php',
  		'local_cic.php',
  		'data_centre.php',
  		'mea_geo.php'
  	);
  	$page_url = $page_url_array[2];
  	$return_array = array();
  	$return_array['page_url'] = $page_url;
  	if (in_array('index.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Global Tool";
  		$return_array['iactive'] = (($page_url == $menu_array[0])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('global-offering.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Global Offering";
  		$return_array['goactive'] = (($page_url == $menu_array[1])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('eu.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Europe";
  		$return_array['euactive'] = (($page_url == $menu_array[2])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('na-geo.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from NA GEO";
  		$return_array['naactive'] = (($page_url == $menu_array[3])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('japan.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Japan";
  		$return_array['jactive'] = (($page_url == $menu_array[4])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('la.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Latin America";
  		$return_array['lactive'] = (($page_url == $menu_array[5])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('gcg.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from GCG";
  		$return_array['gactive'] = (($page_url == $menu_array[6])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('ap.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Asia Pacific";
  		$return_array['apactive'] = (($page_url == $menu_array[7])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('data-center.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Data Center";
  		$return_array['dcactive'] = (($page_url == $menu_array[8])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('cic.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from IBM CIC";
  		$return_array['cicactive'] = (($page_url == $menu_array[9])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('admin.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from admin";
  		$return_array['admin'] = (($page_url == $menu_array[10])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('sbliw.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Sbliw";
  		$return_array['sbliw'] = (($page_url == $menu_array[11])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('global_cic.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Global Cic";
  		$return_array['global_cic'] = (($page_url == $menu_array[12])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('local_cic.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Local Cic";
  		$return_array['local_cic'] = (($page_url == $menu_array[13])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('data_centre.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from Data Center";
  		$return_array['data_center'] = (($page_url == $menu_array[14])) ? 'class="active"' : 'class=""';
  	}
  	elseif (in_array('mea_geo.php', $page_url_array))
  	{
  		$return_array['page_title'] = "Query from MEA Geo";
  		$return_array['mea_geo'] = (($page_url == $menu_array[15])) ? 'class="active"' : 'class=""';
  	}
  
  	return $return_array;
  }
  
  /**
   *
   * method to get the user's data
   *
   */
  
  function getUsers()
  {
  	$return_array = array();
  	if (isset($_GET['pageno']))
  	 {
  		$pageno = $_GET['pageno'];
  	 } else 
  	{
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM users";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM users LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['id'] = $result->id;
  		$return_array[$i]['username'] = $result->username;
  		$return_array[$i]['admin'] = $result->admin;
  		$return_array[$i]['created_date'] = $result->created_date;
  		$return_array[$i]['updated_date'] = $result->updated_date;
  		$i++;
  	}
  
  	return $return_array;
  }


  
  function updateUsers($id, $adm)
  {
  	$sql = "UPDATE users set admin =" . $adm . ",updated_date = current_date where id=?";
  	$results = updateData($sql, [$id]);
  }
  

  /*function to create users*/
  function createuser($user)
  {
  	$current_date = $update_date = date('Y-m-d');
  	$i = 0;
  	$flag = 0;
  	$sql = "SELECT distinct(username) FROM users where username=?";
  	$results = fetchAll($sql, [$user]);
  	foreach($results as $result)
  	{
  		$username = $result->username;
  		if ($username === $user)
  		{
  			$flag = 1;
  		}
  
  		$i++;
  	}
  
  	if ($flag === 0)
  	{
  		$sql = "insert into users(username,admin,created_date,updated_date) values (?,?,?,?)";
  		$results = insertData($sql, [$user, '0', $current_date, $update_date]);
  		echo "</br> User $user Added Successfully!";
  	}
  	else
  	{
  		echo "</br> Email $user Already Exists!";
  	}
  }
  
/**
   *
   * method to get the global tools
   *
   */

  function getGlobalTool($table)
  {
  
  $return_array = array();
  if (isset($_GET['pageno'])) 
  {
  	$pageno = $_GET['pageno'];
  } else 
  	{
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM global_tool";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
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
  
  function getGlobalOffering($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM global_offering";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_reference'] = $result->procurement_reference;
  		$return_array[$i]['entity_name'] = $result->entity_name;
  		$return_array[$i]['supplier_address'] = $result->country;
  		$return_array[$i]['sub_contract_vendors'] = $result->sub_contract_vendors;
  		$return_array[$i]['offering_id_30'] = $result->offering_id_30;
  		$return_array[$i]['offering_id_40'] = $result->offering_id_40;
  		$return_array[$i]['vendor_description'] = $result->vendor_description;
  		$return_array[$i]['on_boarding'] = $result->on_boarding;
  		$return_array[$i]['off_boarding'] = $result->off_boarding;
  		$return_array[$i]['offering_owner'] = $result->offering_owner;
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
  
  function getEUTool($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) 
  	{
  		$pageno = $_GET['pageno'];
  	} else 
  	{
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM europe_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  		$return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }

  /**
   *
   * method to get the na geo
   *
   */
  
  function getnageo($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM na_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  	$return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }

  /**
   *
   * method to get the japan goe
   *
   */
  function getjapangeo($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM japan_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  	    $return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }
  /**
   *
   * method to get the la geo
   *
   */
  
  function getlageo($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM la_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  		$return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }
  
  /**
   *
   * method to get the gc geo
   *
   */
  
  function getgcggeo($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM gcg_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  	    $return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }
  /**
   *
   * method to get the ap geo
   *
   */
  
  function getapgeo($table)
  {
  	$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM ap_geo";
    $rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
  		$return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
  		$return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  	    $return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  } 
  /**
   *
   * method to get the sbliw
   *
   */
  function getsbliw($table)
  {
  	$$return_array = array();
  	if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
  	$conn  = connDB();
  	$sql="SELECT COUNT(*) FROM sbliw";
    $rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
    $i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['igs_ctry_grp_nm'] = $result->igs_ctry_grp_nm;
  		$return_array[$i]['iso_ctry_nm'] = $result->iso_ctry_nm;
  		$return_array[$i]['bus_measmt_div_nm'] = $result->bus_measmt_div_nm;
  		$return_array[$i]['offrg_cmpnt_cd'] = $result->offrg_cmpnt_cd;
  		$return_array[$i]['owng_org_cd'] = $result->owng_org_cd;
        $return_array[$i]['cust_nm'] = $result->cust_nm;
  		$return_array[$i]['lgl_cntrct_id'] = $result->lgl_cntrct_id;
        $return_array[$i]['proj_id'] = $result->proj_id;
  		$return_array[$i]['cntrct_end_dt'] = $result->cntrct_end_dt;
  	$return_array[$i]['service_line_cd'] = $result->service_line_cd;
  		$i++;
  	}
  
  	return $return_array;
  }
  /**
   *
   * function to upload data
   *
   */
  function Validate_data($table)
  {
  	$myfile = $_FILES['fileToUpload']['tmp_name'];
  	$loaded_file = $_FILES['fileToUpload']['name'];
  	print $loaded_file;
  	$column_count = array(
  		"ap_geo" => "10",
  		"europe_geo" => "10",
  		"gcg_geo" => "10",
  		"global_offering" => "12",
  		"global_tool" => "11",
  		"ibm_data_center" => "9",
  		"ibm_global_cic" => "12",
  		"ibm_local_cic" => "12",
  		"japan_geo" => "10",
  		"la_geo" => "10",
  		"mea_geo" => "10",
  		"na_geo" => "10",
  		"sbliw" => "10"
  	);
  	if (!$loaded_file)
  	{
  		print "No File selected </br>";
  		exit;
  	}
  
  	$uploads_dir = 'tmp';
  	$name = basename($_FILES["fileToUpload"]["name"]);
  	//chmod('$name',0644);
  	move_uploaded_file($myfile, $uploads_dir . "/" . $name);
  	print "User selected value is " . $_REQUEST['load_type'] . "<br />";
  	$extension = end(explode('.', $_FILES['fileToUpload']['name']));
  	print "Filename to be uploaded is " . $loaded_file . "<br />";
  	if ($extension == 'csv')
  	{
  		echo 'File format is correct</br>';
  	}
  	else
  	{
  		echo 'Please upload the file in correct format. Only csv  file format is accepted </br> ';
  		header("Location: global-offering.php");
  		exit;
  	}
  
  	$file = file_get_contents($uploads_dir . "/" . $name);
  	$SearchString = ",/'/\"";
  	$breakstrings = explode('/', $SearchString);
  	foreach($breakstrings as $values)
  	{
  		if (strpos($file, $values))
  		{
  			echo "The File uploaded has " . $values . "entries.</br>";
  			echo "Rejecting the upload process!";
  			exit;
  		}
  	}
  
  	$flag = 0;
  	$file1 = fopen($uploads_dir . "/" . $name, 'r');
  	while (($line = fgetcsv($file1)) !== FALSE)
  	{
  		$string_version = implode('|', $line);
  		$value = substr_count($string_version, "|");
  		//echo $value;
  		//exit;
  
  		if ($value != ($column_count["$table"]-1))
  		{
  			echo "Column count for " . $table . " should be " . $column_count["$table"] . " hence rejecting file upload ";
  			$flag = 1;
  			exit;
  		}
  	}
  
  	fclose($file1);
  	if ($flag == 0)
  	{
  		echo "Data File has correct length. Starting the upload Process...";
  	}
  
  	if ($_REQUEST['load_type'] == 'Fresh_Upload')
  	{
  		print "Deleting old data</br>";
  		$query = "delete from $table";
  		excuteQuery($query); //delete data
  	}
  	else
  	{
  		echo "Add to the existing data!";
  	}
  
  	$query = "LOAD DATA LOCAL INFILE 'tmp/$name' INTO TABLE $table FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n' IGNORE 1 ROWS
  	(procurement_vendor_id,supplier_name,country,sub_contract_vendors,vendor_service,requester_approver,customer_identified,note,market,retention_period)";
  	
  	$result = excuteQuery($query);
  	if (!$result)
  	{
  		die("Could not load. ");
  	}
  	else
  	{
  		echo "File uploaded Successfully!";
  	}
  }
  
  /**
   *
   * method to get the global cic
   *
   */
  
  function getglobal_cic($table)
  {
  	$$return_array = array();
    if (isset($_GET['pageno'])) 
    {
  		$pageno = $_GET['pageno'];
  	} else 
  	{
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
    $conn  = connDB();
  	$sql="SELECT COUNT(*) FROM ibm_global_cic";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['id'] = $result->id;
  		$return_array[$i]['ibm_cic_name'] = $result->ibm_cic_name;
  		$return_array[$i]['ibm_cic_address'] = $result->ibm_cic_address;
  		$return_array[$i]['country'] = $result->country;
  		$return_array[$i]['cic_delivering_service'] = $result->cic_delivering_service;
  		$return_array[$i]['entity_name'] = $result->entity_name;
  		$return_array[$i]['sub_contracting_vendor'] = $result->sub_contracting_vendor;
  		$return_array[$i]['service_area'] = $result->service_area;
  		$return_array[$i]['gso'] = $result->gso;
  		$return_array[$i]['service_contact'] = $result->service_contact;
  		$return_array[$i]['assesment_owner'] = $result->assesment_owner;
  		$return_array[$i]['note'] = $result->note;
  		$i++;
  	}
  
  	return $return_array;
  }  

  /**
   *
   * method to get the datacenter data
   *
   */
  
  function getdata_centre($table)
  {
  	$$return_array = array();
    if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
    $conn  = connDB();
  	$sql="SELECT COUNT(*) FROM ibm_data_center";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor'] = $result->procurement_vendor;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['address_country'] = $result->address_country;
  		$return_array[$i]['service_area'] = $result->service_area;
  		$return_array[$i]['subcontract_vendor'] = $result->subcontract_vendor;
  		$return_array[$i]['identify_customer'] = $result->identify_customer;
  		$return_array[$i]['imt'] = $result->imt;
  		$return_array[$i]['iot'] = $result->iot;
  		$return_array[$i]['note'] = $result->note;
  		$i++;
  	}
  
  	return $return_array;
  }

  /**
   *
   * method to get the mea_geo
   *
   */
  
  function getmeageo($table)
  {
  	$return_array = array();
    if (isset($_GET['pageno'])) {
  		$pageno = $_GET['pageno'];
  	} else {
  		$pageno = 1;
  	}
  	$no_of_records_per_page = 10;
  	$offset = ($pageno-1) * $no_of_records_per_page;
    $conn  = connDB();
  	$sql="SELECT COUNT(*) FROM mea_geo";
  	$rowCount =pagination($sql,[]);
  	$total_pages = ceil($rowCount / $no_of_records_per_page);
  	$sql = "SELECT * FROM $table LIMIT $offset, $no_of_records_per_page";
  	$results=fetchAll($sql,[]);
  	$i = 0;
  	foreach($results as $result)
  	{
  		$return_array[$i]['procurement_vendor_id'] = $result->procurement_vendor_id;
  		$return_array[$i]['supplier_name'] = $result->supplier_name;
  		$return_array[$i]['country '] = $result->country ;
  		$return_array[$i]['sub_contract_vendors '] = $result->sub_contract_vendors ;
  		$return_array[$i]['vendor_service '] = $result->vendor_service ;
        $return_array[$i]['requester_approver'] = $result->requester_approver;
  		$return_array[$i]['customer_identified '] = $result->customer_identified ;
        $return_array[$i]['note'] = $result->note;
  		$return_array[$i]['market'] = $result->market;
  	$return_array[$i]['retention_period '] = $result->retention_period;
  		$i++;
  	}
  
  	return $return_array;
  }

  /**
   *
   * method to upadate the user
   *
   */
  function UpdateUser($email)
  {
  	$val = "";
  	$flag = 0;
  	$admin = "";
  	$i = 0;
  	$sql = "SELECT admin FROM users where username=?";
  	$results = fetchAll($sql, [$email]);
  	foreach($results as $result)
  	{
  		$admin = $result->admin;
  	}
  
  	return ($admin);
  }
  
  
?>

