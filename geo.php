<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
        <div class="col-lg-10 col-md-10">
            <form action="" method="post" accept-charset="utf-8">
            <div class="container-fixed">
                <div class="row">   
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <h3 class="text-success text-center"><i class="fa fa-fw fa-globe" style="font-size:48px;"></i>Geo Location Search</h3>
                    </br></br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        </br></br>
                        
                        <select placeholder="Geo Location Search" id="geo_search" onchange="ajaxFunction('geo_search')" class="search-box" name="geo_search"  style="width:100%;">
                        <option value="">Select Geo Location</option>
                        <option value="all">--All Geo--</option>
                        <option value="europe">Europe</option>
                        <option value="na">NA</option>
                        <option value="la">LA</option>
                        <option value="japan">Japan</option>    
                        <option value="ap">AP</option>
                        <option value="gcg">GCG</option>
                         <option value="mea">MEA</option>                    
                            </select></br></br></br></br>

                    </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 market-search" style="display: none;">
                    <div class="well">
                        <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i>Market Search</h3>
                    </br></br></br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 market-search" style="display: none;">
                    <div class="well">
                    </br></br>
                        <?php 
                            global $conn;
                            $query = "SELECT distinct(market) FROM europe_geo";
                            $select_market = getSelectMarket();
                        ?>
                        <select placeholder="Market Search" onchange="console.log($(this).children(':selected').length)" class="search-box" name="market_search" id="market_search" style="width:100%;">    
                        <option value="">Select a Market</option>
                        <?php
                            for($i=0; $i < count($select_market); $i++) {
                                ?>
                            <option value="<?php echo $select_market[$i]['market']; ?>"><?php echo $select_market[$i]['market']; ?></option>
                            <?php 
                                } 
                            ?>
                            </select></br></br></br></br>                   
                    </div>
                    </div>

                    <div class="col-lg-3 col-md-3 market-search-all" style="display: none;">
                    <div class="well">
                        <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i>Market Search</h3>
                    </br></br></br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 market-search-all" style="display: none;">
                    <div class="well">
                        
                        <select placeholder="Market Search" onchange="console.log($(this).children(':selected').length)" class="search-box" name="market_search_all" id="market_search" style="width:100%;">    
                        <option value="">All Markets</option>
                            </select></br></br></br></br>                   
                    </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 cust-search" style="display: none;">
                    <div class="well">
                    <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i>Customer Search</h3>
                    </br></br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3 cust-search" style="display: none;">
                    <div class="well customer-search">
                        <div class="customer-search-span">
                        <?php
                            ?></br>
                            <div id="myProgress" class="progress">
                              <div id="myBar" class="progress-bar progress-bar-striped" ></div>
                            </div>
                            <select  id='cust_search' multiple='multiple' placeholder='Select Customers' class='form-control' name='custgeo[]'>
                            </select>
                            <!-- <select multiple="multiple" placeholder="Select Customers" onchange="console.log($(this).children(':selected').length)" class="search-box" name="custgeo[]">
                            </select> -->
                            </br></br> </div>
                    <input type="submit" class="btn btn-primary btn-block" style="margin-top:10px;"  name="filter_geo" id="filter_geo" value="Search" /></br>                       
                    </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
 </div>
<div class="container-table100">

<?php
    if(isset($_REQUEST['filter_geo'])) {
        ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
        if(isset($_REQUEST['custgeo']) && ($_REQUEST['custgeo'] != '')) {
            if ($_REQUEST['geo_search'] == "all") {
                showGeoTable(getGeoData($_REQUEST['custgeo'], array("la", "na", "japan", "ap", "gcg", "mea")));
                showGeoTableEurope(getGeoDataEurope($_REQUEST['custgeo'], $_REQUEST['geo_search'], $_REQUEST['market_search']));
            }
            elseif ($_REQUEST['geo_search'] == "europe") {
                showGeoTableEurope(getGeoDataEurope($_REQUEST['custgeo'], $_REQUEST['geo_search'], $_REQUEST['market_search']));
            }
            else {
                showGeoTable(getGeoData($_REQUEST['custgeo'], array($_REQUEST['geo_search'])));
            }
        }
    }
?>
</div>
<?php 
include_once('footer.php'); 
?>