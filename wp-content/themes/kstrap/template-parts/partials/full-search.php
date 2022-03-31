<?php

?>
<div class="search-bar-container">
    <div class="search-control"></div>
    <form class="form-inline" method="get" id="mainsearch" autocomplete="off" >
        <div class="search-bar">
            <div class="container-fluid">
            <div class="row">
                <input type="hidden" name="qs" value="true" >
                <div class="col-md-6">
                    <div class="input-container omni-field-container">
                        <select class="form-control form-control-lg select2-omni-field" name="omniField" autocomplete="off">
                            <option value="">City, area, subdivision or zip</option>
                            <?php echo (isset($_GET['omniField']) && $_GET['omniField'] != '' ? '
                            <option value="'.$_GET['omniField'].'" selected >'.$_GET['omniField'].'</option>
                            ' : ''); ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="input-container">
                        <select class="form-control form-control-lg select2-property-type" name="propertyType" autocomplete="off">
                            <option 
                                value="" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == '' ? 'selected' : ''); ?> 
                            >Property type</option>
                            <option 
                                value="Single Family Home" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Single Family Home' ? 'selected' : ''); ?> 
                            >Single Family Home</option>
                            <option 
                                value="Condo / Townhome" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Condo / Townhome' ? 'selected' : ''); ?> 
                            >Condo / Townhome</option>
                            <option 
                                value="Commercial" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Commercial' ? 'selected' : ''); ?> 
                            >Commercial</option>
                            <option 
                                value="Lots / Land" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Lots / Land' ? 'selected' : ''); ?> 
                            >Lots / Land</option>
                            <option 
                                value="Multi-Family Home" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Multi-Family Home' ? 'selected' : ''); ?> 
                            >Multi-Family Home</option>
                            <option 
                                value="Manufactured" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Manufactured' ? 'selected' : ''); ?> 
                            >Manufactured</option>
                            <option 
                                value="Farms / Agricultural" 
                                <?php echo (isset($_GET['propertyType']) && $_GET['propertyType'] == 'Farms / Agricultural' ? 'selected' : ''); ?> 
                            >Farms / Agricultural</option>
                        </select>
                    </div>
                </div>
                <div class="col text-right">
                    <div class="input-container">
                        <div class="button-group mt-1 mb-1 text-center text-lg-right">
                            <?php if($post->post_name == 'map-search'){ ?>
                                <a class="btn btn-secondary btn-rounded mt-1 mb-1 "
                                   href="/properties/?searchType=grid<?php
                                   if(isset($_GET)){
                                       foreach($_GET as $key => $var){
                                           if(is_array($var)){
                                               foreach($var as $k => $v){
                                                   echo '&' . $key . '[]=' . $v;
                                               }
                                           }else{
                                               if($key!='searchType') {
                                                   echo '&' . $key . '=' . $var;
                                               }
                                           }
                                       }
                                   }
                                   ?>" >grid view</a>
                            <?php }else{ ?>
                                <a class="btn btn-secondary btn-rounded mt-1 mb-1 "
                                   href="/properties/map-search/?searchType=map<?php
                                   if(isset($_GET)){
                                       foreach($_GET as $key => $var){
                                           if(is_array($var)){
                                               foreach($var as $k => $v){
                                                   echo '&' . $key . '[]=' . $v;
                                               }
                                           }else {
                                               if ($key != 'searchType') {
                                                   echo '&' . $key . '=' . $var;
                                               }
                                           }
                                       }
                                   }
                                   ?>" >map view</a>
                            <?php } ?>

                            <button type="button" class="btn btn-secondary dropdown-toggle btn-rounded mt-1 mb-1 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggler('advanced-menu');">Advanced</button>
                            <button type="submit" class="btn btn-primary btn-rounded mt-1 mb-1" >Search</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
	    </div>
        <div id="advanced-menu" class="advanced-menu hidden">
            <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-6">
                    <div class="row">
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <label class="sr-only" for="min_price">Min Price</label>
                        <div class="input-group mb-2 mb-sm-0">
                            <div class="input-group-addon">Min Price</div>
                            <select class="form-control form-control-lg select2-price-min" name="minPrice" autocomplete="off">
                                <option value="">Min price</option>
                                <?php for($i = 0; $i <= 1000000; $i+=100000){
                                    echo '<option value="' . $i . '" '. (isset($_GET['minPrice']) && $_GET['minPrice'] == $i ? 'selected' : '') .' >$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                                <?php for($i = 2000000; $i <= 5000000; $i+=1000000){
                                    echo '<option value="' . $i . '" '. (isset($_GET['minPrice']) && $_GET['minPrice'] == $i ? 'selected' : '') .' >$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                            </select>
                        </div>
                        <p></p>
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <label class="sr-only" for="PRICE_MAX">Max Price</label>
                        <div class="input-group mb-2 mb-sm-0">
                            <div class="input-group-addon">Max Price</div>
                            <select class="form-control form-control-lg select2-price-max" name="maxPrice" autocomplete="off">
                                <option value="">Max price</option>
                                <?php for($i = 100000; $i <= 1000000; $i+=100000){
                                    echo '<option value="' . $i . '" '. (isset($_GET['maxPrice']) && $_GET['maxPrice'] == $i ? 'selected' : '') .' >$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                                <?php for($i = 2000000; $i <= 5000000; $i+=1000000){
                                    echo '<option value="' . $i . '" '. (isset($_GET['maxPrice']) && $_GET['maxPrice'] == $i ? 'selected' : '') .' >$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                            </select>
                        </div>
                        <p></p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <label class="sr-only" for="TOT_HEAT_SQFT">Total H/C Sqft</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <div class="input-group-addon">Total H/C Sqft</div>
                                <select name="sq_ft" id="sq_ft" class="form-control select2-generic" autocomplete="off">
                                    <option value="" >Any</option>
	                                <?php for($i = 800; $i < 10000; $i+=200){
		                                echo '<option value="' . $i . '" '. (isset($_GET['sq_ft']) && $_GET['sq_ft'] == $i ? 'selected' : '') .' >' . number_format( $i, 0, ".", ",") . '</option>';
	                                } ?>
                                </select>
                            </div>
                            <p></p>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <label class="sr-only" for="acreage">Acreage</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <div class="input-group-addon">Acreage</div>
                                <select name="acreage" id="acreage" class="form-control select2-generic" autocomplete="off">
                                    <option value="" >Any</option>
	                                <?php $acreageArray = array(
                                        '.5' => '1/2 or more acres',
                                        '1' => '1 or more acres',
                                        '2' => '2 or more acres',
                                        '5' => '5 or more acres',
                                        '10' => '10 or more acres',
                                        '20' => '20 or more acres',
                                        '30' => '30 or more acres',
                                        '40' => '40 or more acres',
                                        '50' => '50 or more acres'
                                    );

                                    foreach($acreageArray as $k => $v){
		                                echo '<option value="' . $k . '" '. (isset($_GET['acreage']) && $_GET['acreage'] == $k ? 'selected' : '') .' >' . $v . '</option>';
	                                } ?>
                                </select>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6">
                    <div class="radio-box">
                    <div class="row">
                        <label class="sr-only" for="bedrooms">Beds</label>
                        <div class="col-12 col-md-2 label input-group-addon" >Beds</div>
                        <div class="col form-check form-check-inline">
                            <label class="custom-control custom-radio">
                                <input 
                                    type="radio" 
                                    name="bedrooms" 
                                    value="" 
                                    class="custom-control-input" 
                                    <?php echo (!isset($_GET['bedrooms']) || $_GET['bedrooms'] == '' ? 'checked' : ''); ?> 
                                >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Any</span>
                            </label>
                            <?php for($i = 1; $i < 6; $i+=1){
                                echo '<label class="custom-control custom-radio">
                                <input type="radio" name="bedrooms" value="'.$i.'" class="custom-control-input" '. (isset($_GET['bedrooms']) && $_GET['bedrooms'] == $i ? 'checked' : '') .' >
                                <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">'.$i.' +</span>
                              </label>';
                        } ?>
                        </div>
                    </div></div>
                    <div class="radio-box">
                    <div class="row">
                        <label class="sr-only" for="bathrooms">Baths</label>
                        <div class="col-12 col-md-2 label input-group-addon" >Baths</div>
                        <div class="col form-check form-check-inline">
                            <label class="custom-control custom-radio">
                                <input 
                                    type="radio" 
                                    name="bathrooms" 
                                    value="" 
                                    class="custom-control-input" 
                                    <?php echo (!isset($_GET['bathrooms']) || $_GET['bathrooms'] == '' ? 'checked' : ''); ?> 
                                >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Any</span>
                            </label>
                            <?php for($i = 1; $i < 6; $i+=1){
                                echo '<label class="custom-control custom-radio">
                                <input type="radio" name="bathrooms" value="'.$i.'" class="custom-control-input" '. (isset($_GET['bathrooms']) && $_GET['bathrooms'] == $i ? 'checked' : '') .' >
                                <span class="custom-control-indicator"></span>
                              <span class="custom-control-description">'.$i.' +</span>
                              </label>';
                            } ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="radio-box status">
                        <div class="row">
                            <?php $status = (isset($_GET['status']) ? $_GET['status'] : array()); ?>
                            <label class="sr-only" for="bathrooms">Status</label>
                            <div class="col-12 col-md-2 label input-group-addon" >Status</div>
                            <div class="col form-check form-check-inline">
                                <label class="custom-control custom-checkbox">
                                    <input 
                                        type="checkbox" 
                                        class="custom-control-input"
                                        <?php echo (in_array('active',$status) ? 'checked' : ''); ?> 
                                        name="status[]" 
                                        value="Active">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Active</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input 
                                        type="checkbox" 
                                        class="custom-control-input" 
                                        <?php echo (in_array('Active Under Contract',$status) ? 'checked' : ''); ?> 
                                        name="status[]" 
                                        value="Active Under Contract">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Under Contract - Taking Backups</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input 
                                        type="checkbox" 
                                        class="custom-control-input" 
                                        <?php echo (in_array('Sold',$status) ? 'checked' : ''); ?> name="status[]" 
                                        value="Sold">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Sold</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input 
                                        type="checkbox" 
                                        class="custom-control-input" 
                                        <?php echo (in_array('Pending',$status) ? 'checked' : ''); ?> 
                                        name="status[]" 
                                        value="Pending">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Pending</span>
                                </label>
                                <?php ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="radio-box features">
                        <div class="row">
                            <label class="sr-only" for="bathrooms">Features</label>
                            <div class="col-12 col-md-2 label input-group-addon" >Features</div>
                            <div class="col form-check form-check-inline">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?php echo (isset($_GET['waterfront']) ? 'checked' : ''); ?> name="waterfront" value="1" >
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Waterfront</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?php echo (isset($_GET['pool']) ? 'checked' : ''); ?> name="pool" value="1">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Pool</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <input type="hidden" name="sortBy" value="date_modified">
        <input type="hidden" name="orderBy" value="DESC">
    </form>
</div>

<script type="text/javascript">
    function toggler(menuVar){
        $('#'+menuVar).toggle();
    }
</script>
