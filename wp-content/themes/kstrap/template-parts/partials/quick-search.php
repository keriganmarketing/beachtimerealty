<?php
/**
 * @package KMA
 * @subpackage kstrap
 * @since 1.0
 * @version 1.2
 */
?>
<div class="quick-search-container">
    <div class="container">
        <form action="/test-search-results" method="get">
            <div class="form-group">
                <input type="hidden" name="qs" value="true">
                <select class="form-control form-control-lg select2" name="omniField" placeholder="City, area, subdivision or zip" >
                    <option value="something">Something</option>
                    <option value="something2">Something else</option>
                </select>
            </div>
            <div class="row">
                <div class="col-6 col-md-5">
                    <div class="form-group">
                        <select class="form-control form-control-lg select2" name="propertyType" placeholder="Property type" >
                            <option value="something">Something</option>
                            <option value="something2">Something else</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-md-5">
                    <div class="form-group">
                        <select class="form-control form-control-lg select2" name="priceRange" placeholder="Price range" >
                            <option value="something">$10,000 > $100,000</option>
                            <option value="something2">$100,000 > $200,000</option>
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
