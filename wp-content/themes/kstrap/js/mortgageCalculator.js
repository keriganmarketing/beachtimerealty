function calc(payment,taxespaid,insurancepaid,hoadues,pmi) {
    $(function() {

        var data = {
            datasets: [{
                data: [
                    Math.round(payment),
                    Math.round(taxespaid),
                    Math.round(insurancepaid),
                    Math.round(hoadues),
                    Math.round(pmi)
                ],
                backgroundColor: [
                    '#EB6623',
                    '#224083',
                    '#7CCDF2',
                    '#FAD557',
                    '#68B945'
                ]
            }],
            labels: [
                'P&I',
                'Taxes',
                'Insurance',
                'HOA',
                'PMI'
            ]
        };

        var options = {
            legend: {
                display: false
            },
            segmentShowStroke : false,
            segmentStrokeColor : "#fff",
            segmentStrokeWidth : 0,
            maintainAspectRatio: true,
            cutoutPercentage : 80,
              animation: {
                  steps: 100,
                  easing: "easeOutQuart",
                  rotate: true,
                  scale: false
              },
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],
            onAnimationComplete : null,
            tooltipTitleFontStyle: "bold",
            scaleFontStyle: "bold",
            responsive: true,
            tooltipTemplate: "<%if (label){%> <%=label%>: <%}%><%= value %>%",
            tooltipCornerRadius: 0,
            tooltipFillColor: "rgba(66,188,123,0.9)",
            tooltipXOffset: 0,
            tooltipCaretSize: 10
        };

        var c = $('#mortCal');
        var ct = c.get(0).getContext('2d');
        var ctx = document.getElementById("mortCal").getContext("2d");
        var MortgageCalculator = new Chart(ctx, {type: 'doughnut', data, options });
    });

    $(function() {
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
        var P = document.mortcalc.balance.value,
            DP = document.mortcalc.downpayment.value,
            T = document.getElementById('includetaxes'),
            IFPMI = document.getElementById('includepmi'),
            PT = document.mortcalc.prop_taxes.value,
            HI = document.mortcalc.home_insurance.value,
            HD = document.mortcalc.hoa_dues.value;

        $("#downpaypercent").val(Math.round((DP/P)*100)+"%");

        var princ = document.mortcalc.balance.value - document.mortcalc.downpayment.value,
            intRate = (document.mortcalc.rate.value/100) / 12,
            months = document.mortcalc.term.value,
            taxespaid = ((PT/100)*P ) / 12,
            insurancepaid = HI / 12,
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
                $("#pmi").html("<span class=\"label\"><strong>PMI:</strong> $" + Math.round(pmi) + "</span>");

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
$('#mortform').submit(function (event) {
    event.preventDefault();
});

