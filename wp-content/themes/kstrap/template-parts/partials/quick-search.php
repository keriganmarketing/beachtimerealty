<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<div class="quick-search-container">
    <div class="search-control"></div>
    <div class="container">
        <form action="/properties/" method="get" >
            <input type="hidden" name="qs" value="true">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group omni-field-container">
                        <select class="form-control form-control-lg select2-omni-field" name="omniField" >
                            <option value="">City, area, subdivision or zip</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
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
            </div>
            <div class="row">
                <div class="col-6 col-md-5">
                    <div class="form-group">
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
                </div>
                <div class="col-6 col-md-5">
                    <div class="form-group">
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
                </div>
                <div class="col col-md-2">
                    <button type="submit" class="btn btn-primary btn-rounded btn-block" >Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
