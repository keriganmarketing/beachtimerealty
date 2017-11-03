<div id="mortgage-calculator" style="width:100%;">
    <form name="mortcalc" id="calcform" >
        <h3 class="text-center mt-4 mb-4">Mortgage Calculator</h3>
        <div class="row align-items-center">
            <div class="col-md-3 col-lg-4 mort-cal-left">
                <div class="form-group row no-gutters">
                    <label class="col-lg-6" for="homeprice">Home Price</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-sm" name="balance" id="balance" value="<?php echo $listingInfo->price; ?>" >
                    </div>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-lg-6" for="downpayment">Down payment</label>
                    <div class="col-7 col-lg-4">
                        <input type="text" class="form-control form-control-sm" name="down_payment" id="downpayment" value="<?php echo $listingInfo->price * .2; ?>" onChange="updatePercent();" >
                    </div>
                    <div class="col-5 col-lg-2">
                        <input type="text" class="form-control form-control-sm" name="down-pay_percent" id="downpaypercent" onChange="updatePayment();mortCal();" value="" >
                    </div>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-lg-6" for="interestrate">Interest rate</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-sm" name="rate" id="rate" value="4.064" >
                    </div>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-lg-6" for="loanterm">Loan term</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-sm" name="term" id="term" value="360" placeholder="360 months" >
                    </div>
                </div>

            </div>

            <div class="col-md-3 col-lg-4 mort-cal-right">
                <div class="form-group ">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="include_taxes" id="includetaxes" checked="checked" onClick="mortCal();" >
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Include taxes</span>
                    </label>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-lg-8 col-xl-6" for="proptaxes">Property taxes</label>
                    <div class="col-lg-4 col-xl-6">
                        <input type="text" class="form-control form-control-sm" name="prop_taxes" id="proptaxes" value="1.2" >
                    </div>
                </div>
                <div class="form-group row no-gutters">
                    <label class="col-lg-8 col-xl-6" for="homeinsurance">Home insurance</label>
                    <div class="col-lg-4 col-xl-6">
                        <input type="text" class="form-control form-control-sm" name="home_insurance" id="homeinsurance" value="800">
                    </div>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="include_pmi" id="includepmi" checked="checked" onClick="mortCal();" >
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">Include PMI</span>
                    </label>
                </div>
                <div class="form-group row no-gutters">
                    <label for="hoadues" class="col-lg-6"> HOA dues</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control form-control-sm" name="hoa_dues" id="hoadues" value="0" >
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center mort-cal-center">
                <div class="chart-container" style="height:100%; width:100%;">
                    <canvas id="mortCal" ></canvas>
                </div>
                <div id="payment">
                    <span class="payment-label">Mo. Payment</span>
                    <span id="mon_payment">$<span id="payment_num">0</span></span>
                </div>
                <div id="labels">
                    <div id="left">
                        <div id="hoa"></div>
                        <div id="tax"></div>
                    </div>
                    <div id="right">
                        <div id="pi"></div>
                        <div id="ins"></div>
                        <div id="pmi"></div>
                    </div>
                </div>
                <div id="cal-button"><span class="calculate" onClick="mortCal();">Calculate</span></div>
                <input type="submit" onClick="mortCal();this.preventDefault();" style="visibility:hidden;"  >
            </div>

        </div>
    </form>
</div>