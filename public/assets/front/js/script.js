//your javascript goes here
var currentTab = 0;
let finalGold = 0;
let finalBlue = 0;
let finalGreen = 0;
let finalOrange = 0;
let finalResult = 0;
document.addEventListener("DOMContentLoaded", function(event) {


    showTab(currentTab);

});

function showTab(n) {
    console.log(n);
    
        var input = 'https://dev.myprojectstaging.net/php/essential-colors/public/candidate-test/test/submit';

        var fields = input.split('candidate-test/');
        
        console.log(fields[0]+fields[1]);
    
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == (x.length - 1)) {
        // document.getElementById("nextBtn").innerHTML = "Submit";
        $("#nextBtn").css('display', 'none');
        $("#all-steps").css('display', 'none');
        var candidateAttempt = document.getElementById('attemptId').value;
        $.ajax({
            url: fields[0]+fields[1],
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "candidate_attempt": candidateAttempt,
                "orange": finalOrange,
                "gold": finalGold,
                "blue": finalBlue,
                "green": finalGreen,
                "max_result": finalResult,
            },
            dataType: 'JSON',
            success: function(result) {
                toastr.success(result);
            },
            error: function(error) {
                toastr.error(error);
            }
        });

    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";
    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    // x[n].className += " active";
    // alert(x.length);
}
/* Company Code Field */
$('#cmpny_checkbox').on('change', function() {
    if ($(this).is(':checked')) {
        $('#cmpnyCode').addClass('d-flex');
        $('#cmpnyCode').removeClass('d-none');
        $('#cmpnyCode').prop('required', true);
    } else {
        $('#cmpnyCode').addClass('d-none');
        $('#cmpnyCode').removeClass('d-flex');
        $('#cmpnyCode').removeAttr('required');
    }
});

/* Validations */
$('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);

$('#nextBtn').click(function() {
    $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

$(document.body).on('change', '.row1 .rowOrange, .row1 .rowGold, .row1 .rowBlue, .row1 .rowGreen', function() {
    if ($('.row1 .rowOrange').val() !== '' && $('.row1 .rowGold').val() !== '' && $('.row1 .rowBlue').val() !== '' && $('.row1 .rowGreen').val() !== '' && $('.row1 .rowOrange').val() !== $('.row1 .rowGold').val() && $('.row1 .rowOrange').val() !== $('.row1 .rowBlue').val() && $('.row1 .rowOrange').val() !== $('.row1 .rowGreen').val() &&
        $('.row1 .rowGold').val() !== $('.row1 .rowOrange').val() && $('.row1 .rowGold').val() !== $('.row1 .rowBlue').val() && $('.row1 .rowGold').val() !== $('.row1 .rowGreen').val() &&
        $('.row1 .rowBlue').val() !== $('.row1 .rowOrange').val() && $('.row1 .rowBlue').val() !== $('.row1 .rowGold').val() && $('.row1 .rowBlue').val() !== $('.row1 .rowGreen').val() &&
        $('.row1 .rowGreen').val() !== $('.row1 .rowOrange').val() && $('.row1 .rowGreen').val() !== $('.row1 .rowGold').val() && $('.row1 .rowGreen').val() !== $('.row1 .rowBlue').val()) {
        $('#nextBtn').removeAttr('style disabled');
    } else {
        $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    }

});

$(document.body).on('change', '.row2 .rowOrange, .row2 .rowGold, .row2 .rowBlue, .row2 .rowGreen', function() {
    if ($('.row2 .rowOrange').val() !== '' && $('.row2 .rowGold').val() !== '' && $('.row2 .rowBlue').val() !== '' && $('.row2 .rowGreen').val() !== '' && $('.row2 .rowOrange').val() !== $('.row2 .rowGold').val() && $('.row2 .rowOrange').val() !== $('.row2 .rowBlue').val() && $('.row2 .rowOrange').val() !== $('.row2 .rowGreen').val() &&
        $('.row2 .rowGold').val() !== $('.row2 .rowOrange').val() && $('.row2 .rowGold').val() !== $('.row2 .rowBlue').val() && $('.row2 .rowGold').val() !== $('.row2 .rowGreen').val() &&
        $('.row2 .rowBlue').val() !== $('.row2 .rowOrange').val() && $('.row2 .rowBlue').val() !== $('.row2 .rowGold').val() && $('.row2 .rowBlue').val() !== $('.row2 .rowGreen').val() &&
        $('.row2 .rowGreen').val() !== $('.row2 .rowOrange').val() && $('.row2 .rowGreen').val() !== $('.row2 .rowGold').val() && $('.row2 .rowGreen').val() !== $('.row2 .rowBlue').val()) {
        $('#nextBtn').removeAttr('style disabled');
    } else {
        $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    }
});

$(document.body).on('change', '.row3 .rowOrange, .row3 .rowGold, .row3 .rowBlue, .row3 .rowGreen', function() {
    if ($('.row3 .rowOrange').val() !== '' && $('.row3 .rowGold').val() !== '' && $('.row3 .rowBlue').val() !== '' && $('.row3 .rowGreen').val() !== '' && $('.row3 .rowOrange').val() !== $('.row3 .rowGold').val() && $('.row3 .rowOrange').val() !== $('.row3 .rowBlue').val() && $('.row3 .rowOrange').val() !== $('.row3 .rowGreen').val() &&
        $('.row3 .rowGold').val() !== $('.row3 .rowOrange').val() && $('.row3 .rowGold').val() !== $('.row3 .rowBlue').val() && $('.row3 .rowGold').val() !== $('.row3 .rowGreen').val() &&
        $('.row3 .rowBlue').val() !== $('.row3 .rowOrange').val() && $('.row3 .rowBlue').val() !== $('.row3 .rowGold').val() && $('.row3 .rowBlue').val() !== $('.row3 .rowGreen').val() &&
        $('.row3 .rowGreen').val() !== $('.row3 .rowOrange').val() && $('.row3 .rowGreen').val() !== $('.row3 .rowGold').val() && $('.row3 .rowGreen').val() !== $('.row3 .rowBlue').val()) {
        $('#nextBtn').removeAttr('style disabled');
    } else {
        $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    }
});

$(document.body).on('change', '.row4 .rowOrange, .row4 .rowGold, .row4 .rowBlue, .row4 .rowGreen', function() {
    if ($('.row4 .rowOrange').val() !== '' && $('.row4 .rowGold').val() !== '' && $('.row4 .rowBlue').val() !== '' && $('.row4 .rowGreen').val() !== '' && $('.row4 .rowOrange').val() !== $('.row4 .rowGold').val() && $('.row4 .rowOrange').val() !== $('.row4 .rowBlue').val() && $('.row4 .rowOrange').val() !== $('.row4 .rowGreen').val() &&
        $('.row4 .rowGold').val() !== $('.row4 .rowOrange').val() && $('.row4 .rowGold').val() !== $('.row4 .rowBlue').val() && $('.row4 .rowGold').val() !== $('.row4 .rowGreen').val() &&
        $('.row4 .rowBlue').val() !== $('.row4 .rowOrange').val() && $('.row4 .rowBlue').val() !== $('.row4 .rowGold').val() && $('.row4 .rowBlue').val() !== $('.row4 .rowGreen').val() &&
        $('.row4 .rowGreen').val() !== $('.row4 .rowOrange').val() && $('.row4 .rowGreen').val() !== $('.row4 .rowGold').val() && $('.row4 .rowGreen').val() !== $('.row4 .rowBlue').val()) {
        $('#nextBtn').removeAttr('style disabled');
    } else {
        $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    }
});

$(document.body).on('change', '.row5 .rowOrange, .row5 .rowGold, .row5 .rowBlue, .row5 .rowGreen', function() {
    finalCheck = false;
    if ($('.row5 .rowOrange').val() !== '' && $('.row5 .rowGold').val() !== '' && $('.row5 .rowBlue').val() !== '' && $('.row5 .rowGreen').val() !== '' && $('.row5 .rowOrange').val() !== $('.row5 .rowGold').val() && $('.row5 .rowOrange').val() !== $('.row5 .rowBlue').val() && $('.row5 .rowOrange').val() !== $('.row5 .rowGreen').val() &&
        $('.row5 .rowGold').val() !== $('.row5 .rowOrange').val() && $('.row5 .rowGold').val() !== $('.row5 .rowBlue').val() && $('.row5 .rowGold').val() !== $('.row5 .rowGreen').val() &&
        $('.row5 .rowBlue').val() !== $('.row5 .rowOrange').val() && $('.row5 .rowBlue').val() !== $('.row5 .rowGold').val() && $('.row5 .rowBlue').val() !== $('.row5 .rowGreen').val() &&
        $('.row5 .rowGreen').val() !== $('.row5 .rowOrange').val() && $('.row5 .rowGreen').val() !== $('.row5 .rowGold').val() && $('.row5 .rowGreen').val() !== $('.row5 .rowBlue').val()) {
        $('#nextBtn').removeAttr('style disabled');
    } else {
        $('#nextBtn').css({ 'opacity': '0.5', 'cursor': 'no-drop' }).prop('disabled', true);
    }

});


/* Calculations */
$('body').on('change', function() {
    var rowOrange1 = $('.row1 .rowOrange').val();
    var rowGold1 = $('.row1 .rowGold').val();
    var rowBlue1 = $('.row1 .rowBlue').val();
    var rowGreen1 = $('.row1 .rowGreen').val();

    var rowOrange2 = $('.row2 .rowOrange').val();
    var rowGold2 = $('.row2 .rowGold').val();
    var rowBlue2 = $('.row2 .rowBlue').val();
    var rowGreen2 = $('.row2 .rowGreen').val();

    var rowOrange3 = $('.row3 .rowOrange').val();
    var rowGold3 = $('.row3 .rowGold').val();
    var rowBlue3 = $('.row3 .rowBlue').val();
    var rowGreen3 = $('.row3 .rowGreen').val();

    var rowOrange4 = $('.row4 .rowOrange').val();
    var rowGold4 = $('.row4 .rowGold').val();
    var rowBlue4 = $('.row4 .rowBlue').val();
    var rowGreen4 = $('.row4 .rowGreen').val();

    var rowOrange5 = $('.row5 .rowOrange').val();
    var rowGold5 = $('.row5 .rowGold').val();
    var rowBlue5 = $('.row5 .rowBlue').val();
    var rowGreen5 = $('.row5 .rowGreen').val();


    var calcGold = Number(rowGold1) + Number(rowGold2) + Number(rowGold3) + Number(rowGold4) + Number(rowGold5);
    var calcBlue = Number(rowBlue1) + Number(rowBlue2) + Number(rowBlue3) + Number(rowBlue4) + Number(rowBlue5);
    var calcGreen = Number(rowGreen1) + Number(rowGreen2) + Number(rowGreen3) + Number(rowGreen4) + Number(rowGreen5);
    var calcOrange = Number(rowOrange1) + Number(rowOrange2) + Number(rowOrange3) + Number(rowOrange4) + Number(rowOrange5);
    finalGold = calcGold;
    finalBlue = calcBlue;
    finalGreen = calcGreen;
    finalOrange = calcOrange;

    $('#pills-gold-tab').text('Gold - ' + calcGold);
    $('#pills-blue-tab').text('Blue - ' + calcBlue);
    $('#pills-green-tab').text('Green - ' + calcGreen);
    $('#pills-orange-tab').text('Orange - ' + calcOrange);

    // Primary Value

    if (calcGold >= calcBlue && calcGold >= calcGreen && calcGold >= calcOrange) {
        var primary = 'Gold';
        finalResult = primary;
    }

    if (calcBlue >= calcGold && calcBlue >= calcGreen && calcBlue >= calcOrange) {
        var primary = 'Blue';
        finalResult = primary;
    }

    if (calcGreen >= calcGold && calcGreen >= calcBlue && calcGreen >= calcOrange) {
        var primary = 'Green';
        finalResult = primary;
    }

    if (calcOrange >= calcGold && calcOrange >= calcBlue && calcOrange >= calcGreen) {
        var primary = 'Orange';
        finalResult = primary;
    }
    // console.log('final resul' + finalResult);
    // console.log('primary result' + primary);
    finalResult = primary;
});