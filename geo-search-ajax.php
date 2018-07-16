<?php
   include_once('functions.php');
   global $conn;
   $keyword = $_POST['keyword'];  
   $geo = $_POST['geo'];  
   $i = 0;
   $market = $_POST['market'];  
   if ($geo == "all") 
   {
   	$allgeo = array("europe_geo", "la_geo", "na_geo", "ap_geo", "japan_geo", "gcg_geo","mea_geo");
   	foreach ($allgeo as $key)
   	{
   		if ($key == "europe_geo") 
   		{
   			$sql = "SELECT distinct(customer_under_po) as identify_customer FROM europe_geo where customer_under_po like ? order by customer_under_po";
   			$results=fetchAll($sql,["$keyword%"]);
   		}
   		else 
   		{
   			$sql = "SELECT distinct(identify_customer) as identify_customer FROM ".$key." where identify_customer like ? order by identify_customer";
   		}
   		
   
   		$results=fetchAll($sql,["$keyword%"]);
   		foreach($results as $output) 
   		{
   			$return_array[$i]['label'] = $output->identify_customer;
   			$return_array[$i]['value'] = $output->identify_customer;
   			$i++;
   		}
   	}
   	
   }
   
   else 
   {
   	if ($geo == "europe")
   	{  
   		
   		$sql="select distinct(customer_under_po) as identify_customer from ".$geo."_geo where customer_under_po like ? and market like ? order by customer_under_po";
   
   		$results=fetchAll($sql,["$keyword%","$market"]);
   
   		
   	}
   	else 
   	{
   		
   		$sql="select distinct(identify_customer) as identify_customer from ".$geo."_geo where identify_customer like ? order by identify_customer";
   		$results=fetchAll($sql,["$keyword%"]);
   	}
   
   
   	
   	foreach($results as $output) 
   	{
   		$return_array[$i]['label'] = $output->identify_customer;
   		$return_array[$i]['value'] = $output->identify_customer;
   		$i++;
   	}
   }
   
   $sql="select distinct(identify_customer) as identify_customer from ibm_data_center where identify_customer like ? order by identify_customer";
   
   $results=fetchAll($sql,["$keyword%"]);
   
   $sql="select distinct(cust_nm) as identify_customer from sbliw where cust_nm like ? order by cust_nm";
   
   $results=fetchAll($sql,["$keyword%"]);
   
   
   foreach($results as $output_data) 
   {
   	$return_array[$i]['label'] = $output_data->identify_customer;
   	$return_array[$i]['value'] = $output_data->identify_customer;
   	$i++;
   }
   
   foreach($results as $output_sbliw)
   {
   	$return_array[$i]['label'] = $output_sbliw->identify_customer;
   	$return_array[$i]['value'] = $output_sbliw->identify_customer;
   	$i++;
   }
   echo json_encode($return_array);
   ?>