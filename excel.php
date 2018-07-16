<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
include_once('functions.php'); 

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("IBM")
->setLastModifiedBy("IBM")
->setTitle("Office 2007 XLSX GDPR Document")
->setSubject("Office 2007 XLSX GDPR Document")
->setDescription("Document Generated for GDPR Vendor Management System")
->setKeywords("office 2007 openxml php")
->setCategory("GDPR");

$geo_location='';
$market='Nordic';
$customers='ABB, FCA';
$tool_search='FMCT, TEST TOOL';
$data_center='';
$global_service='';
$global_cic='';
$local_cic='';
$local_service='';
$intro_table = array('geo_location' => $geo_location, 'market' => $market, 'customers' => $customers, 'tool_search' => $tool_search, 'data_center' => $data_center, 'global_service' => $global_service, 'global_cic' => $global_cic, 'local_cic' => $local_cic, 'local_service' => $local_service );

if($intro_table) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Tools')
      ->setCellValue('A4', 'Data Center Country')
      ->setCellValue('A5', 'Global CIC Name')
      ->setCellValue('A6', 'Local CIC Name')
      ->setCellValue('A7', 'Global Service Area')
      ->setCellValue('A8', 'Local Service Area')
      ->setCellValue('A9', 'Selected Geo')
      ->setCellValue('A10', 'Selected Market')
      ->setCellValue('A11', 'Selected Customer');
      $objPHPExcel->getActiveSheet()->setTitle('Introduction');
}

if (isset($_POST['excel_tool']))
{ 
      $output_tool=getVendorData($_POST['excel_tool']);
      $vendor_table = $output_tool['getvendor'];
      $vendor_criteria = $output_tool['vendor'];
}
if (isset($_POST['excel_country']))
{     
      $output_country=getCountryData($_POST['excel_country']);
      $vendor_table2 = $output_country['data'];
      $country_criteria = $output_country['country'];
}
if (isset($_POST['excel_gcic']))
{
      $output_gcic=getSAIDData($_POST['excel_gcic'],'global');
      $vendor_table3 = $output_gcic['data'];
      $gcic_criteria =  $output_gcic['id'];
}
if (isset($_POST['excel_lcic']))
{     
      $output_lcic=getSAIDData($_POST['excel_lcic'],'local');
      $vendor_table4 = $output_lcic['data'];
      $lcic_criteria = $output_lcic['id'];
}
if (isset($_POST['excel_gsa']))
{
      $output_gsa=getCICData($_POST['excel_gsa'],'global');
      $vendor_table5 = $output_gsa['data'];
      $gsa_criteria =  $output_gsa['service_area'];
}
if (isset($_POST['excel_lsa']))
{
      $output_lsa=getCICData($_POST['excel_lsa'],'local');
      $vendor_table6 = $output_lsa['data'];  
      $lsa_criteria =  $output_lsa['service_area']; 
}

if(isset($_POST['excel_geo_search']) && isset($_POST['excel_custgeo']) && isset($_POST['excel_market_search'])) 
{
      
      if ($_REQUEST['excel_geo_search'] == "all") {
            $output_geo = getGeoData($_REQUEST['excel_custgeo'], array("la", "na", "japan", "ap", "gcg", "mea"));
            $output_geo_europe = getGeoDataEurope($_POST['excel_custgeo'], $_POST['excel_geo_search'], $_POST['excel_market_search']);
            $vendor_table7 = $output_geo; 
            $vendor_table8 = $output_geo_europe; 
      }
      elseif ($_REQUEST['excel_geo_search'] == "europe") {
            $output_geo_europe = getGeoDataEurope($_POST['excel_custgeo'], $_POST['excel_geo_search'], $_POST['excel_market_search']);
            $sel_geo = $output_geo_europe['geo_loc'];
            $sel_market = $output_geo_europe['market'];
            $sel_cust = $output_geo_europe['vendor'];
            $vendor_table7 = $output_geo;
            $vendor_table8 = $output_geo_europe; 
      }
      else {
            $output_geo = getGeoData($_REQUEST['excel_custgeo'], array($_REQUEST['excel_geo_search']));
            $vendor_table7 = $output_geo;
            $sel_geo = $output_geo['geo_loc'];
            $sel_market = 'All Markets';
            $sel_cust = $output_geo['vendor'];
      }
      $output_customer = getCustomerData($_REQUEST['excel_custgeo']);
      $vendor_table9 = $output_customer['global_offering']['data'];
      $output_customer_datacenter = getCustomerData_datacenter($_REQUEST['excel_custgeo']);
      $vendor_table10 = $output_customer_datacenter['data'];
}

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue('B3', $vendor_criteria)
->setCellValue('B4', $country_criteria)
->setCellValue('B5', $gcic_criteria)
->setCellValue('B6', $lcic_criteria)
->setCellValue('B7', $gsa_criteria)
->setCellValue('B8', $lsa_criteria)
->setCellValue('B9', $sel_geo)
->setCellValue('B10', $sel_market)
->setCellValue('B11', $sel_cust);
$objPHPExcel->getActiveSheet()->setTitle('Introduction');
$objPHPExcel->createSheet();
//var_dump($vendor_table[0]['procurement_reference']);

if($vendor_table) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(1)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Reference')
      ->setCellValue('B3', 'Entity Name')
      ->setCellValue('C3', 'Country')
      ->setCellValue('D3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('E3', 'Tool Name')
      ->setCellValue('F3', ' Vendor Service Description (GSAR)');
      for($i = 4; $i < count($vendor_table)+4; $i++) { 
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$i, $vendor_table[$i-4]['procurement_reference']);
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$i, $vendor_table[$i-4]['entity_name']);
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$i, $vendor_table[$i-4]['country']);
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$i, $vendor_table[$i-4]['sub_contract_vendors']);
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$i, $vendor_table[$i-4]['tool_name']);
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$i, $vendor_table[$i-4]['vendor_description']);
 } 
 $objPHPExcel->getActiveSheet()->setTitle('IBM Global Tools');
}
else
{
      $objPHPExcel->setActiveSheetIndex(1)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Reference')
      ->setCellValue('B3', 'Entity Name')
      ->setCellValue('C3', 'Full Supplier Address')
      ->setCellValue('D3', 'Vendors Address')
      ->setCellValue('E3', 'ToolTool Name')
      ->setCellValue('F3', 'Vendor Category')
      ->setCellValue('A4', 'Tool Criteria not selected from Dropdown');
      $objPHPExcel->getActiveSheet()->setTitle('IBM Global Tools');
}
$objPHPExcel->createSheet();

if($vendor_table2) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(2)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Vendor')
      ->setCellValue('B3', 'Supplier Name')
      ->setCellValue('C3', 'Country / Address')
      ->setCellValue('D3', 'Vendor Service Description (GSAR)')
      ->setCellValue('E3', 'Identify Customer')
      ->setCellValue('F3', 'IMT')
      ->setCellValue('G3', 'IOT');
      for($i = 4; $i < count($vendor_table2)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$i, $vendor_table2[$i-4]['procurement_vendor']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$i, $vendor_table2[$i-4]['supplier_name']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$i, $vendor_table2[$i-4]['address_country']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$i, $vendor_table2[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$i, $vendor_table2[$i-4]['identify_customer']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$i, $vendor_table2[$i-4]['imt']);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'.$i, $vendor_table2[$i-4]['iot']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Country Data Center');
}
else
{
     $objPHPExcel->setActiveSheetIndex(2)
     ->setCellValue('A1', 'GTS Vendor Inquiry')
     ->setCellValue('A3', 'Procurement Vendor')
     ->setCellValue('B3', 'Supplier Name')
     ->setCellValue('C3', 'Full Supplier Address')
     ->setCellValue('D3', 'Service Area')
     ->setCellValue('E3', 'Identify Customer')
     ->setCellValue('F3', 'IMT')
     ->setCellValue('G3', 'IOT')
     ->setCellValue('A4', 'Data Center Not Selected from Dropdown');
     $objPHPExcel->getActiveSheet()->setTitle('Country Data Center');
}
$objPHPExcel->createSheet();

if($vendor_table3) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(3)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'ID')
      ->setCellValue('B3', 'IBM CIC Name')
      ->setCellValue('C3', 'IBM CIC full address ')
      ->setCellValue('D3', 'Country')
      ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
      ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')
      ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('H3', 'Service Area')
      ->setCellValue('I3', 'GSO')
      ->setCellValue('J3', 'Service Area Contact Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'Note');

      for($i = 4; $i < count($vendor_table3)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$i, $vendor_table3[$i-4]['id']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$i, $vendor_table3[$i-4]['ibm_cic_name']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'.$i, $vendor_table3[$i-4]['ibm_cic_address']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'.$i, $vendor_table3[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'.$i, $vendor_table3[$i-4]['cic_delivering_service']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'.$i, $vendor_table3[$i-4]['entity_name']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('G'.$i, $vendor_table3[$i-4]['sub_contracting_vendor']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('H'.$i, $vendor_table3[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('I'.$i, $vendor_table3[$i-4]['gso']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('J'.$i, $vendor_table3[$i-4]['service_contact']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('K'.$i, $vendor_table3[$i-4]['assesment_owner']);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('L'.$i, $vendor_table3[$i-4]['note']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Global CIC Sheet');
}
else
{
      $objPHPExcel->setActiveSheetIndex(3)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'ID')
      ->setCellValue('B3', 'IBM CIC Name')
      ->setCellValue('C3', 'IBM CIC full address ')
      ->setCellValue('D3', 'Country')
      ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
      ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')
      ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('H3', 'Service Area')
      ->setCellValue('I3', 'GSO')
      ->setCellValue('J3', 'Service Area Contact Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'Note')
      ->setCellValue('A4', 'Global CIC Criteria not Selected from Dropdown');
      $objPHPExcel->getActiveSheet()->setTitle('Global CIC Sheet');
}
$objPHPExcel->createSheet();

if($vendor_table4) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(4)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'ID')
      ->setCellValue('B3', 'IBM CIC Name')
      ->setCellValue('C3', 'IBM CIC full address ')
      ->setCellValue('D3', 'Country')
      ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
      ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
      ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('H3', 'Service Area')
      ->setCellValue('I3', 'GSO')
      ->setCellValue('J3', 'Service Area Contact Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'Note');

      for($i = 4; $i < count($vendor_table4)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A'.$i, $vendor_table4[$i-4]['id']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$i, $vendor_table4[$i-4]['ibm_cic_name']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('C'.$i, $vendor_table4[$i-4]['ibm_cic_address']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('D'.$i, $vendor_table4[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('E'.$i, $vendor_table4[$i-4]['cic_delivering_service']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('F'.$i, $vendor_table4[$i-4]['entity_name']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('G'.$i, $vendor_table4[$i-4]['sub_contracting_vendor']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('H'.$i, $vendor_table4[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('I'.$i, $vendor_table4[$i-4]['gso']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('J'.$i, $vendor_table4[$i-4]['service_contact']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('K'.$i, $vendor_table4[$i-4]['assesment_owner']);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('L'.$i, $vendor_table4[$i-4]['note']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Local CIC Sheet');
}
else
{
     $objPHPExcel->setActiveSheetIndex(4)
     ->setCellValue('A1', 'GTS Vendor Inquiry')
     ->setCellValue('A3', 'ID')
     ->setCellValue('B3', 'IBM CIC Name')
     ->setCellValue('C3', 'IBM CIC full address ')
     ->setCellValue('D3', 'Country')
     ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
     ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
     ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
     ->setCellValue('H3', 'Service Area')
     ->setCellValue('I3', 'GSO')
     ->setCellValue('J3', 'Service Area Contact Owner')
     ->setCellValue('K3', 'Assessment Owner')
     ->setCellValue('L3', 'Note')
     ->setCellValue('A4', 'Local CIC Criteria Not Selected from Dropdown');
     $objPHPExcel->getActiveSheet()->setTitle('Local CIC Sheet');
}
$objPHPExcel->createSheet();

if($vendor_table5) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(5)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'ID')
      ->setCellValue('B3', 'IBM CIC Name')
      ->setCellValue('C3', 'IBM CIC full address ')
      ->setCellValue('D3', 'Country')
      ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
      ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
      ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('H3', 'Service Area')
      ->setCellValue('I3', 'GSO')
      ->setCellValue('J3', 'Service Area Contact Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'Note');

      for($i = 4; $i < count($vendor_table5)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A'.$i, $vendor_table5[$i-4]['id']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B'.$i, $vendor_table5[$i-4]['ibm_cic_name']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('C'.$i, $vendor_table5[$i-4]['ibm_cic_address']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('D'.$i, $vendor_table5[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('E'.$i, $vendor_table5[$i-4]['cic_delivering_service']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('F'.$i, $vendor_table5[$i-4]['entity_name']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('G'.$i, $vendor_table5[$i-4]['sub_contracting_vendor']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('H'.$i, $vendor_table5[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('I'.$i, $vendor_table5[$i-4]['gso']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('J'.$i, $vendor_table5[$i-4]['service_contact']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('K'.$i, $vendor_table5[$i-4]['assesment_owner']);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('L'.$i, $vendor_table5[$i-4]['note']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Global Service Area Sheet');
}
else
{
     $objPHPExcel->setActiveSheetIndex(5)
     ->setCellValue('A1', 'GTS Vendor Inquiry')
     ->setCellValue('A3', 'ID')
     ->setCellValue('B3', 'IBM CIC Name')
     ->setCellValue('C3', 'IBM CIC full address ')
     ->setCellValue('D3', 'Country')
     ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
     ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
     ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
     ->setCellValue('H3', 'Service Area')
     ->setCellValue('I3', 'GSO')
     ->setCellValue('J3', 'Service Area Contact Owner')
     ->setCellValue('K3', 'Assessment Owner')
     ->setCellValue('L3', 'Note')
     ->setCellValue('A4', 'Global Service Area Not Selected from Dropdown');
     $objPHPExcel->getActiveSheet()->setTitle('Global Service Area Sheet');
}
$objPHPExcel->createSheet();

if($vendor_table6) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(6)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'ID')
      ->setCellValue('B3', 'IBM CIC Name')
      ->setCellValue('C3', 'IBM CIC full address ')
      ->setCellValue('D3', 'Country')
      ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
      ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
      ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('H3', 'Service Area')
      ->setCellValue('I3', 'GSO')
      ->setCellValue('J3', 'Service Area Contact Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'Note');

      for($i = 4; $i < count($vendor_table6)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A'.$i, $vendor_table6[$i-4]['id']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B'.$i, $vendor_table6[$i-4]['ibm_cic_name']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('C'.$i, $vendor_table6[$i-4]['ibm_cic_address']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('D'.$i, $vendor_table6[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('E'.$i, $vendor_table6[$i-4]['cic_delivering_service']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('F'.$i, $vendor_table6[$i-4]['entity_name']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('G'.$i, $vendor_table6[$i-4]['sub_contracting_vendor']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('H'.$i, $vendor_table6[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('I'.$i, $vendor_table6[$i-4]['gso']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('J'.$i, $vendor_table6[$i-4]['service_contact']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('K'.$i, $vendor_table6[$i-4]['assesment_owner']);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('L'.$i, $vendor_table6[$i-4]['note']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Local Service Area Sheet');
}
else
{
     $objPHPExcel->setActiveSheetIndex(6)
     ->setCellValue('A1', 'GTS Vendor Inquiry')
     ->setCellValue('A3', 'ID')
     ->setCellValue('B3', 'IBM CIC Name')
     ->setCellValue('C3', 'IBM CIC full address ')
     ->setCellValue('D3', 'Country')
     ->setCellValue('E3', 'Is Your CIC delivering this service YES / NO')
     ->setCellValue('F3', 'IBM Entity Name or 3rd Party Vendor name')  
     ->setCellValue('G3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
     ->setCellValue('H3', 'Service Area')
     ->setCellValue('I3', 'GSO')
     ->setCellValue('J3', 'Service Area Contact Owner')
     ->setCellValue('K3', 'Assessment Owner')
     ->setCellValue('L3', 'Note')
     ->setCellValue('A4', 'Local Service Area Not Selected from Dropdown');
     $objPHPExcel->getActiveSheet()->setTitle('Local Service Area Sheet');
}
$objPHPExcel->createSheet();

if($vendor_table7) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(7)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Vendor ID')
      ->setCellValue('B3', 'Supplier Name')
      ->setCellValue('C3', 'VAT Number')
      ->setCellValue('D3', 'Subcontractors')
      ->setCellValue('E3', 'Country')
      ->setCellValue('F3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('G3', 'PO Number (if  first tier vendor) or ICA-DOU (if IBM entity or IBM Subsidiary)')
      ->setCellValue('H3', 'Family code')
      ->setCellValue('I3', 'PO/BSAP/ICA/DOU full description')
      ->setCellValue('J3', 'Briefly describe the type of services/data processing activity performed by the Vendor')
      ->setCellValue('K3', 'Service Category was identified (Y/N)')
      ->setCellValue('L3', 'In what category is the Vendor Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))')
      ->setCellValue('M3', 'PO Status')
      ->setCellValue('N3', 'Start Date')
      ->setCellValue('O3', 'End Date')
      ->setCellValue('P3', 'PO/ICA Amount(not mandatory - free text)')
      ->setCellValue('Q3', 'Business Unit that provide the services through this vendor(free text ) ')
      ->setCellValue('R3', 'Requester/Approver Name')
      ->setCellValue('S3', 'Please identify the Customer(s) or Account(s) under the PO')
      ->setCellValue('T3', 'NOTE')
      ->setCellValue('U3', 'Is the PO GDPR Relevant? ')
      ->setCellValue('V3', 'Market');

      for($i = 4; $i < count($vendor_table7)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('A'.$i, $vendor_table7[$i-4]['procurement_vendor_id']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('B'.$i, $vendor_table7[$i-4]['supplier_name']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('C'.$i, $vendor_table7[$i-4]['vat_number']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('D'.$i, $vendor_table7[$i-4]['Subcontractos']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('E'.$i, $vendor_table7[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('F'.$i, $vendor_table7[$i-4]['sub_contract_vendors']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('G'.$i, $vendor_table7[$i-4]['po_number']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('H'.$i, $vendor_table7[$i-4]['family_code']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('I'.$i, $vendor_table7[$i-4]['po_bsap_ica']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('J'.$i, $vendor_table7[$i-4]['describe_service']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('K'.$i, $vendor_table7[$i-4]['service_category']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('L'.$i, $vendor_table7[$i-4]['vendor_service']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('M'.$i, $vendor_table7[$i-4]['po_status']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('N'.$i, $vendor_table7[$i-4]['start_date']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('O'.$i, $vendor_table7[$i-4]['end_date']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('P'.$i, $vendor_table7[$i-4]['po_ica_amount']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('Q'.$i, $vendor_table7[$i-4]['business_unit']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('R'.$i, $vendor_table7[$i-4]['requester_approver']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('S'.$i, $vendor_table7[$i-4]['customer_under_po']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('T'.$i, $vendor_table7[$i-4]['note']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('U'.$i, $vendor_table7[$i-4]['po_relevant']);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('V'.$i, $vendor_table7[$i-4]['market']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('GEO Sheet');
}
else
{
      $objPHPExcel->setActiveSheetIndex(7)->setCellValue('A4', 'No data Found!');
      $objPHPExcel->getActiveSheet()->setTitle('GEO Sheet'); 
}
$objPHPExcel->createSheet();

if($vendor_table8) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(8)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Vendor ID')
      ->setCellValue('B3', 'Supplier Name')
      ->setCellValue('C3', 'VAT Number')
      ->setCellValue('D3', 'Subcontractors')
      ->setCellValue('E3', 'Country')
      ->setCellValue('F3', 'Is there further sub-contracting to second or third tier vendors? If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('G3', 'PO Number (if  first tier vendor) or ICA-DOU (if IBM entity or IBM Subsidiary)')
      ->setCellValue('H3', 'Family code')
      ->setCellValue('I3', 'PO/BSAP/ICA/DOU full description')
      ->setCellValue('J3', 'Briefly describe the type of services/data processing activity performed by the Vendor')
      ->setCellValue('K3', 'Service Category was identified (Y/N)')
      ->setCellValue('L3', 'In what category is the Vendor Service Description ? (using the categories in GSAR (Global Solution Architecture Repository))')
      ->setCellValue('M3', 'PO Status')
      ->setCellValue('N3', 'Start Date')
      ->setCellValue('O3', 'End Date')
      ->setCellValue('P3', 'PO/ICA Amount(not mandatory - free text)')
      ->setCellValue('Q3', 'Business Unit that provide the services through this vendor(free text ) ')
      ->setCellValue('R3', 'Requester/Approver Name')
      ->setCellValue('S3', 'Please identify the Customer(s) or Account(s) under the PO')
      ->setCellValue('T3', 'NOTE')
      ->setCellValue('U3', 'Is the PO GDPR Relevant? ')
      ->setCellValue('V3', 'Market');

      for($i = 4; $i < count($vendor_table8)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('A'.$i, $vendor_table8[$i-4]['procurement_vendor_id']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('B'.$i, $vendor_table8[$i-4]['supplier_name']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('C'.$i, $vendor_table8[$i-4]['vat_number']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('D'.$i, $vendor_table8[$i-4]['Subcontractos']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('E'.$i, $vendor_table8[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('F'.$i, $vendor_table8[$i-4]['sub_contract_vendors']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('G'.$i, $vendor_table8[$i-4]['po_number']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('H'.$i, $vendor_table8[$i-4]['family_code']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('I'.$i, $vendor_table8[$i-4]['po_bsap_ica']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('J'.$i, $vendor_table8[$i-4]['describe_service']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('K'.$i, $vendor_table8[$i-4]['service_category']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('L'.$i, $vendor_table8[$i-4]['vendor_service']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('M'.$i, $vendor_table8[$i-4]['po_status']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('N'.$i, $vendor_table8[$i-4]['start_date']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('O'.$i, $vendor_table8[$i-4]['end_date']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('P'.$i, $vendor_table8[$i-4]['po_ica_amount']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('Q'.$i, $vendor_table8[$i-4]['business_unit']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('R'.$i, $vendor_table8[$i-4]['requester_approver']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('S'.$i, $vendor_table8[$i-4]['customer_under_po']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('T'.$i, $vendor_table8[$i-4]['note']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('U'.$i, $vendor_table8[$i-4]['po_relevant']);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('V'.$i, $vendor_table8[$i-4]['market']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Europe GEO Sheet');
}
else
{
      $objPHPExcel->setActiveSheetIndex(8)->setCellValue('A4', 'No data Found!');
      $objPHPExcel->getActiveSheet()->setTitle('Europe GEO Sheet'); 
}

// $objPHPExcel->createSheet();

$objPHPExcel->createSheet();

if($vendor_table9) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(9)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Reference')
      ->setCellValue('B3', 'Entity Name')
      ->setCellValue('C3', 'Country')
      ->setCellValue('D3', 'Is there further sub-contracting to second or third tier Vendors. If so, please provide the full names and full address of 2nd or 3rd tier vendors')
      ->setCellValue('E3', 'Offering ID (level 30)')
      ->setCellValue('F3', 'Offering ID (level 40)')
      ->setCellValue('G3', 'Vendors Service Description (GSAR)')
      ->setCellValue('H3', 'On boarding')
      ->setCellValue('I3', 'Off-Boarding')
      ->setCellValue('J3', 'Offering Owner')
      ->setCellValue('K3', 'Assessment Owner')
      ->setCellValue('L3', 'NOTE');

      for($i = 4; $i < count($vendor_table9)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('A'.$i, $vendor_table9[$i-4]['procurement_reference']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('B'.$i, $vendor_table9[$i-4]['entity_name']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('C'.$i, $vendor_table9[$i-4]['country']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('D'.$i, $vendor_table9[$i-4]['sub_contract_vendors']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('E'.$i, $vendor_table9[$i-4]['offering_id_30']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('F'.$i, $vendor_table9[$i-4]['offering_id_40']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('G'.$i, $vendor_table9[$i-4]['vendor_description']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('H'.$i, $vendor_table9[$i-4]['on_boarding']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('I'.$i, $vendor_table9[$i-4]['off_boarding']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('J'.$i, $vendor_table9[$i-4]['offering_owner']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('K'.$i, $vendor_table9[$i-4]['assessment_owner']);
            $objPHPExcel->setActiveSheetIndex(9)->setCellValue('L'.$i, $vendor_table9[$i-4]['note']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('IBM Global Offering');
}
else
{
      $objPHPExcel->setActiveSheetIndex(9)->setCellValue('A4', 'No data Found!');
      $objPHPExcel->getActiveSheet()->setTitle('IBM Global Offering'); 
}

$objPHPExcel->createSheet();


if($vendor_table10) {
      // Add some data
      $objPHPExcel->setActiveSheetIndex(10)
      ->setCellValue('A1', 'GTS Vendor Inquiry')
      ->setCellValue('A3', 'Procurement Vendor')
      ->setCellValue('B3', 'Supplier Name')
      ->setCellValue('C3', 'Country / Address')
      ->setCellValue('D3', 'Vendor Service Description (GSAR)')
      ->setCellValue('E3', 'Sub Contract Vendor')
      ->setCellValue('F3', 'Customer')
      ->setCellValue('G3', 'IMT')
      ->setCellValue('H3', 'IOT');

      for($i = 4; $i < count($vendor_table10)+4; $i++) { 
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('A'.$i, $vendor_table10[$i-4]['procurement_vendor']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('B'.$i, $vendor_table10[$i-4]['supplier_name']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('C'.$i, $vendor_table10[$i-4]['address_country']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('D'.$i, $vendor_table10[$i-4]['service_area']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('E'.$i, $vendor_table10[$i-4]['subcontract_vendor']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('F'.$i, $vendor_table10[$i-4]['identify_customer']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('G'.$i, $vendor_table10[$i-4]['imt']);
            $objPHPExcel->setActiveSheetIndex(10)->setCellValue('H'.$i, $vendor_table10[$i-4]['iot']);
      }
      $objPHPExcel->getActiveSheet()->setTitle('Customer Data Center');
}
else
{
     $objPHPExcel->setActiveSheetIndex(10)->setCellValue('A4', 'No data Found!');
     $objPHPExcel->getActiveSheet()->setTitle('Customer Data Center');
}
      //$objPHPExcel->createSheet();

// Add some data
// $objPHPExcel->setActiveSheetIndex(1)
//             ->setCellValue('A1', 'Hello')
//             ->setCellValue('B2', 'world!')
//             ->setCellValue('C1', 'Hello')
//             ->setCellValue('D2', 'world!');


// Rename worksheet
// $objPHPExcel->getActiveSheet()->setTitle('Simple Second');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Disposition: attachment;filename="'.gmdate('D, d M Y H:i:s').'.xlsx"');
header('Content-Disposition: attachment;filename="GTS Vendor Inquiry - Full Export.xlsx"'); 
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
