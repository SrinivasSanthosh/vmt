<?php session_start(); ?>
<?php include_once('functions.php'); ?>
<?php include_once('header.php'); ?>
<?php include_once('navigate.php'); ?>
        <div class="col-lg-10 col-md-10">
            <div class="container-fixed">
               
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <h3 class="text-primary text-center"><i class="fa fa-fw fa-user" style="font-size:48px;"></i> Customer Search</h3>
                    </br>
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                    <div class="well">
                        <form action="" method="post" accept-charset="utf-8">
                        <?php 
                        $select = getMultiCust();
                        ?>
                    <div class="offering">
                    <div class="customer-search-span">

                        <select id="sourcelist" class="form-control" multiple="multiple" name='source[]'>
                             <?php
                            for($i=0; $i < count($select); $i++) {
                                ?>
                                <option value="<?php echo $select[$i]['name']; ?>" title="<?php echo $select[$i]['name']; ?>"><?php echo $select[$i]['name']; ?></option>
                                <?php } ?>
                        </select>
                    </div> </div></br>
                                <button class="btn btn-primary btn-md btn-block" style="margin-top:10px;" type="submit" name="filter_new">
                                    Search
                                </button></br>
                        
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
        if(isset($_REQUEST['filter_new'])) {
            ?><script type="text/javascript">window.scroll({ top: 2500, left: 0, behavior: 'smooth' });</script> <?php
            if(isset($_REQUEST['source']) && ($_REQUEST['source'] != '')) {
                showTable(getCustomerData($_REQUEST['source']));
            }
           else if(isset($_REQUEST['custgeo']) && ($_REQUEST['custgeo'] != '')) {
                showGeoTable(getGeoData($_REQUEST['custgeo'], array($_REQUEST['geo_search'])));
           }
        }
        ?>
</div>
<?php 
include_once('footer.php'); ?>