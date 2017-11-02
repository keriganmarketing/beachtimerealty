import Chart from 'chart.js';

function calc(payment,taxespaid,insurancepaid,hoadues,pmi) {
    $(function() {

        console.log("Payment: "+payment+"%");
        console.log("Taxes: "+taxespaid+"%");
        console.log("Insurance: "+insurancepaid+"%");
        console.log("HOA: "+hoadues+"%");
        console.log("PMI: "+pmi+"%");

        var data = [{
            value: Math.round(payment),
            label: "P&I",
            color: "#1D68AA"
        }]

        if(taxespaid != ''){
            data.push({
                value: Math.round(taxespaid),
                label: "Taxes",
                color: "#3987C9"
            });
        }
        if(insurancepaid != ''){
            data.push({
                value: Math.round(insurancepaid),
                label: "Insurance",
                color: "#AACBE9"
            });
        }
        if(hoadues != ''){
            data.push({
                value: Math.round(hoadues),
                label: "HOA",
                color: "#777777"
            });

        }
        if(pmi != ''){
            data.push({
                value: Math.round(pmi),
                label: "PMI",
                color: "#999999"
            });
        }

        tooltipDefaults = {
            background: 'rgba(0,0,0,0.6)',
            fontFamily : "'Arial'",
            fontStyle : "normal",
            fontColor: 'white',
            fontSize: '12px',
            display: 'block',
            padding: {
                top: 10,
                right: 10,
                bottom: 10,
                left: 10
            },
            offset: {
                left: 30,
                top: 0
            },
            border: {
                width: 0,
                color: '#000'
            }
        };

        var options = {
            animation: true,
            segmentShowStroke : false,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 0,
            percentageInnerCutout : 80,
            animation : true,
            animationSteps : 100,
            animationEasing : "easeOutQuart",
            animateRotate : true,
            animateScale : false,
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],
            onAnimationComplete : null,
            tooltipTitleFontStyle: "bold",
            scaleFontStyle: "bold",
            responsive: false,
            tooltipTemplate: "<%if (label){%> <%=label%>: <%}%><%= value %>%",
            tooltipCornerRadius: 0,
            tooltipFillColor: "rgba(66,188,123,0.9)",
            responsive : true,
            tooltipXOffset: 0,
            tooltipCaretSize: 10
        };


        //Get the context of the canvas element we want to select
        var c = $('#mortCal');
        var ct = c.get(0).getContext('2d');
        var ctx = document.getElementById("mortCal").getContext("2d");
        /*************************************************************************/
        myNewChart = new Chart(ct).Doughnut(data, options);
    });

    $(function() {
        //console.log('it works');
        var P = document.mortcalc.balance.value;
        var DP = document.mortcalc.downpayment.value;
        $("#downpaypercent").val(Math.round((DP/P)*100)+"%");
    });
}

$(function() {
    console.log( "ready!" );
    mortCal();
});

function updatePercent() {
    var P = document.mortcalc.balance.value;
    var DP = document.mortcalc.downpayment.value;
    $("#downpaypercent").val(Math.round((DP/P)*100)+"%");
}
function updatePayment() {
    if(isNaN(document.mortcalc.downpaypercent.value)){
        var R = document.mortcalc.downpaypercent.value.substring(0, document.mortcalc.downpaypercent.value.length - 1);
    }else{
        R = document.mortcalc.downpaypercent.value;
    }
    var P = document.mortcalc.balance.value;
    $("#downpayment").val(Math.round((R/100)*P));
}

function mortCal() {
    $(function() {
        //console.log('it works');
        var P = document.mortcalc.balance.value,
            DP = document.mortcalc.downpayment.value,
            T = document.getElementById('includetaxes'),
            IFPMI = document.getElementById('includepmi'),
            PT = document.mortcalc.prop_taxes.value,
            HI = document.mortcalc.home_insurance.value,
            HD = document.mortcalc.hoa_dues.value;

        $("#downpaypercent").val(Math.round((DP/P)*100)+"%");

        price = document.mortcalc.balance.value - document.mortcalc.downpayment.value;
        intRate = (document.mortcalc.rate.value/100) / 12;
        months = document.mortcalc.term.value;
        taxespaid = ((PT/100)*P ) / 12;
        insurancepaid = HI / 12;
        hoadues = HD / 1;

        if((DP/P) >= .2){
            pmi = 0;
        }else{
            pmi = Math.floor(princ * 0.0005);
        }

        var pi = Math.floor((princ*intRate)/(1-Math.pow(1+intRate,-months)));
        var payment = pi;

        if(T.checked){
            if(IFPMI.checked){
                var total = payment+taxespaid+insurancepaid+hoadues+pmi;
                $("#payment_num").html(Math.round(total));
                $("#pi").html("<span class=\"label\"><strong>P&I:</strong> $" + Math.round(payment) + "</span>");
                $("#tax").html("<span class=\"label\"><strong>Taxes:</strong> $" + Math.round(taxespaid) + "</span>");
                $("#ins").html("<span class=\"label\"><strong>Insurance:</strong> $" + Math.round(insurancepaid) + "</span>");
                $("#hoa").html("<span class=\"label\"><strong>HOA:</strong> $" + Math.round(hoadues) + "</span>");
                if(pmi > 0){
                    $("#pmi").html("<span class=\"label\"><strong>PMI:</strong> $" + Math.round(pmi) + "</span>");
                }else{
                    $("#pmi").html("<span class=\"label blank\">&nbsp;</span>");
                }

                var payment = (payment/total)*100;
                var taxespaid = (taxespaid/total)*100;
                var insurancepaid = (insurancepaid/total)*100;
                var hoadues = (hoadues/total)*100;
                var pmi = (pmi/total)*100;

            }else{
                var pmi = 0;
                var total = payment+taxespaid+insurancepaid+hoadues+pmi;
                $("#payment_num").html(Math.round(total));
                $("#pi").html("<span class=\"label\"><strong>P&I:</strong> $" + Math.round(payment) + "</span>");
                $("#tax").html("<span class=\"label\"><strong>Taxes:</strong> $" + Math.round(taxespaid) + "</span>");
                $("#ins").html("<span class=\"label\"><strong>Insurance:</strong> $" + Math.round(insurancepaid) + "</span>");
                $("#hoa").html("<span class=\"label\"><strong>HOA:</strong> $" + Math.round(hoadues) + "</span>");
                $("#pmi").html("<span class=\"label blank\">&nbsp;</span>");

                var payment = (payment/total)*100;
                var taxespaid = (taxespaid/total)*100;
                var insurancepaid = (insurancepaid/total)*100;
                var hoadues = (hoadues/total)*100;

            }
        }else{
            if(IFPMI.checked){
                var insurancepaid = 0;
                var taxespaid = 0;
                var total = payment+taxespaid+insurancepaid+hoadues+pmi;
                $("#payment_num").html(Math.round(total+pmi));
                $("#pi").html("<span class=\"label\"><strong>P&I:</strong> $" + Math.round(payment) + "</span>");
                $("#tax").html("<span class=\"label blank\">&nbsp;</span>");
                $("#ins").html("<span class=\"label blank\">&nbsp;</span>");
                $("#hoa").html("<span class=\"label\"><strong>HOA:</strong> $" + Math.round(hoadues) + "</span>");
                if(pmi > 0){
                    $("#pmi").html("<span class=\"label\"><strong>PMI:</strong> $" + Math.round(pmi) + "</span>");
                }else{
                    $("#pmi").html("<span class=\"label blank\">&nbsp;</span>");
                }

                var payment =  (payment/total)*100;
                var hoadues =  (hoadues/total)*100;
                var pmi = (pmi/total)*100;

                //calc(payment,null,null,hoadues);
            }else{
                var taxespaid = 0;
                var insurancepaid = 0;
                var pmi = 0;
                var total = payment+taxespaid+insurancepaid+hoadues+pmi;
                $("#payment_num").html(Math.round(payment));
                $("#pi").html("<span class=\"label blank\">&nbsp;</span>");
                $("#tax").html("<span class=\"label blank\">&nbsp;</span>");
                $("#ins").html("<span class=\"label blank\">&nbsp;</span>");
                $("#hoa").html("<span class=\"label\"><strong>HOA:</strong> $" + Math.round(hoadues) + "</span>");
                $("#pmi").html("<span class=\"label blank\">&nbsp;</span>");

                var payment = (payment/total)*100;
                var hoadues = (hoadues/total)*100;

            }
        }
        calc(payment,taxespaid,insurancepaid,hoadues,pmi);

        /*console.log("Payment: "+payment+"%");
        console.log("Taxes: "+taxespaid+"%");
        console.log("Insurance: "+insurancepaid+"%");
        console.log("HOA: "+hoadues+"%");
        console.log("PMI: "+pmi+"%");*/

    });
};

window.submitable = false;
$('#calcform').submit(function(event){
    event.preventDefault();
});