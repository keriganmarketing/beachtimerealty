<?php

?>
<div class="search-bar-container">
    <div class="search-control"></div>
    <form class="form-inline" method="get" id="mainsearch" >
        <div class="search-bar">
            <div class="container-fluid">
            <div class="row">
                <input type="hidden" name="qs" value="true" >
                <div class="col-md-6">
                    <div class="input-container">
                        <select class="form-control form-control-lg select2-omni-field" name="omniField" >
                            <option value="">City, area, subdivision or zip</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="input-container">
                        <select class="form-control form-control-lg select2-property-type" name="propertyType" >
                            <option value="">Property type</option>
                            <option value="Single Family Home">Single Family Home</option>
                            <option value="Condo / Townhome">Condo / Townhome</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Lots / Land">Lots / Land</option>
                            <option value="Multi-Family Home">Multi-Family Home</option>
                            <option value="Rental">Rental</option>
                            <option value="Manufactured">Manufactured</option>
                            <option value="Farms / Agricultural">Farms / Agricultural</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col text-right">
                    <div class="input-container">
                    <div class="button-group">
                        <button type="button" class="btn btn-default btn-lg dropdown-toggle btn-rounded" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggler('advanced-menu');">Advanced</button>
                        <button type="submit" class="btn btn-primary btn-lg btn-rounded" >Search</button>
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
                            <select class="form-control form-control-lg select2-price-min" name="minPrice" >
                                <option value="">Min price</option>
                                <?php for($i = 0; $i <= 1000000; $i+=100000){
                                    echo '<option value="' . $i . '">$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                                <?php for($i = 2000000; $i <= 5000000; $i+=1000000){
                                    echo '<option value="' . $i . '">$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                            </select>
                        </div>
                        <p></p>
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <label class="sr-only" for="PRICE_MAX">Max Price</label>
                        <div class="input-group mb-2 mb-sm-0">
                            <div class="input-group-addon">Max Price</div>
                            <select class="form-control form-control-lg select2-price-max" name="maxPrice">
                                <option value="">Max price</option>
                                <?php for($i = 100000; $i <= 1000000; $i+=100000){
                                    echo '<option value="' . $i . '">$' . number_format( $i, 0, ".", ",") . '</option>';
                                } ?>
                                <?php for($i = 2000000; $i <= 5000000; $i+=1000000){
                                    echo '<option value="' . $i . '">$' . number_format( $i, 0, ".", ",") . '</option>';
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
                                <select name="sq_ft" id="sq_ft" class="form-control select2-generic" >
                                    <option value="" >Any</option>
	                                <?php for($i = 800; $i < 10000; $i+=200){
		                                echo '<option value="' . $i . '">' . number_format( $i, 0, ".", ",") . '</option>';
	                                } ?>
                                </select>
                            </div>
                            <p></p>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <label class="sr-only" for="acreage">Acreage</label>
                            <div class="input-group mb-2 mb-sm-0">
                                <div class="input-group-addon">Acreage</div>
                                <select name="acreage" id="acreage" class="form-control select2-generic" >
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
		                                echo '<option value="' . $k . '">' . $v . '</option>';
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
                                <input type="radio" name="bedrooms" value="" class="custom-control-input" >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Any</span>
                            </label>
                            <?php for($i = 1; $i < 6; $i+=1){
                                echo '<label class="custom-control custom-radio">
                                <input type="radio" name="bedrooms" value="'.$i.'" class="custom-control-input" >
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
                                <input type="radio" name="bathrooms" value="" class="custom-control-input" >
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description">Any</span>
                            </label>
                            <?php for($i = 1; $i < 6; $i+=1){
                                echo '<label class="custom-control custom-radio">
                                <input type="radio" name="bathrooms" value="'.$i.'" class="custom-control-input" >
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
                                    <input type="checkbox" class="custom-control-input" <?php echo (in_array('active',$status) ? 'checked' : ''); ?> name="status[]" value="active">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Active</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?php echo (in_array('sold',$status) ? 'checked' : ''); ?> name="status[]" value="sold">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Sold</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?php echo (in_array('pending',$status) ? 'checked' : ''); ?> name="status[]" value="pending">
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
        <input type="hidden" name="orderBy" value="ASC">
    </form>
</div>

<script type="text/javascript">
    function toggler(menuVar){
        $('#'+menuVar).toggle();
    }
</script>
