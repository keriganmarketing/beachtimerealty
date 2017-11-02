<div id="mortgage-calculator">
    <form name="mortcalc" id="calcform" >
        <div class="row">
            <div class="col-sm-6">
                <div class="row no-gutters">
                    <label class="col-sm-4" for="homeprice">Home Price</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="balance" id="balance" value="<?php echo $listingInfo->price; ?>" >
                    </div>
                </div>
                <div class="row no-gutters">
                    <label class="col-sm-4" for="downpayment">Down payment</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" name="down_payment" id="downpayment" value="<?php echo $listingInfo->price * .2; ?>" onChange="updatePercent();" >
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control form-control-sm" name="down-pay_percent" id="downpaypercent" onChange="updatePayment();mortCal();" value="" >
                    </div>
                </div>
                <div class="row no-gutters">
                    <label class="col-sm-4" for="interestrate">Interest rate</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="rate" id="rate" value="4.064" >
                    </div>
                </div>
                <div class="row no-gutters">
                    <label class="col-sm-4" for="loanterm">Loan term</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="term" id="term" value="360" placeholder="360 months" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="include_taxes" id="includetaxes" checked="checked" onClick="mortCal();" >
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Include taxes</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters">
                    <label class="col-sm-4" for="proptaxes">Property taxes</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="prop_taxes" id="proptaxes" value="1.2" >
                    </div>
                </div>
                <div class="row no-gutters">
                    <label class="col-sm-4" for="homeinsurance">Home insurance</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="home_insurance" id="homeinsurance" value="800">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-8">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="include_pmi" id="includepmi" checked="checked" onClick="mortCal();" >
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Include PMI</span>
                        </label>
                    </div>
                </div>
                <div class="row no-gutters">
                    <label for="hoadues" class="col-sm-4"> HOA dues</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" name="hoa_dues" id="hoadues" value="0" >
                    </div>
                </div>
            </div>
            <div class="col-sm-6 text-center">
                <h3>Mortgage Calculator</h3>
                <canvas id="mortCal" width="300" height="190"></canvas>
                <div id="payment">
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
<script>



</script>