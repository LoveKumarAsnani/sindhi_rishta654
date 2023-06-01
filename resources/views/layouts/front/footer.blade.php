@include('layouts.front.all_js_links')
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function(e) {
        // jQuery('#companyTest').click();
        $('.stripe-button-el').hide();
        //  $('.stripe-button-el').click();
        $('.stripePay').click(function (){
            $(".alert-danger").empty();
            $(".alert-danger").hide(1000);
        });
    });

</script>
@if(Session::has('Status'))
<script>
    toastr.error("{{ Session::get('Status') }}");
</script>
@endif

    <script>

        function codeError(message)
        {
            $(".alert-company-code").empty();
            $(".alert-company-code").hide(1000);
            jQuery('.alert-company-code').show();
            jQuery('.alert-company-code').css('color','red')
            jQuery('.alert-company-code').append('<p>'+message+'</p>');
        }

        $("#candidate_details").submit(function(e) {
        var name = $("input[name=name]").val();
        var email = $("input[name=email]").val();
        var gender = $("select[name=gender]").val();
        var ethnicity = $("select[name=ethnicity]").val();
        var age = $("select[name=age]").val();
        var occupation = $("input[name=occupation]").val();
        var city = $("input[name=city]").val();
        var company_code = 1;
        if($("#cmpny_checkbox").is(":checked")){
             company_code = $("input[name=company_code]").val();
            }

            $.ajax({
            url : "{{ url('submit-details') }}",
            type : 'POST',
            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
            data : {
                "name" : name,
                "email" : email,
                "gender" : gender,
                "ethnicity" : ethnicity,
                "age" : age,
                "occupation" : occupation,
                "city" : city,
                "company_code" : company_code,
            },
            success : function (result) {
                console.log(result);

                if(result.type == 1) // company code not equal 1 means that user have compnay code
                {
                    var candidateId = result.id;
                    let exactUrl =  "<?php echo url('candidate-test/'); ?>";
                    var redirectUrl = exactUrl+"/"+candidateId;
                    window.location.assign(redirectUrl);
                }
                else if(result == 0) // 0 means give error for code do not avaliable
                {
                    var message = "Please Enter Correct Code";
                    toastr.error(message);
                    codeError(message);
                }
                else if(result == 2) // 2 means already test given with this code
                {
                    var message = "You can't reattempt the test with this code.";
                    toastr.error(message);
                    codeError(message);
                }
                else if(result == 3) // 3 means gives error for company code is not active
                {
                    var message = "You Cannot Use This Code, Code is Expire ";
                    toastr.error(message);
                    codeError(message);
                }
                else
                {
                    // for user save on payment
                    $(".alert-company-code").empty(); // for company code error
                    $(".alert-company-code").hide(1000);
                    $(".alert-danger").empty();     // for inputs error
                    $(".alert-danger").hide(1000);
                    $("#stripeForm").attr('action', result);
                    $('.stripe-button-el').click();
                }
            },
            error : function (error) {
                console.log(error);
                var responseData = error.responseJSON.errors;
                toastr.error('Invalid Values');
                for(const data in responseData)
                {
                    jQuery.each(responseData[data], function(key, value){
                                  jQuery('.alert-danger').show();
                                  jQuery('.alert-danger').append('<p>'+value+'</p>');
                                //   toastr.error(value);
                              });
                }
            }
        });
            return false;
        });

    </script>
</body>

</html>
