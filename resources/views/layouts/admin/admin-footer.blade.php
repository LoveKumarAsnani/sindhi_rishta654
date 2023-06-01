 <div class="rightbar-overlay"></div>

 <!-- JAVASCRIPT -->
 <script src="{{ asset('/assets/libs/jquery/jquery.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/metismenu/metisMenu.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>

 <!-- apexcharts -->
 <script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

 <!-- dashboard init -->
 <script src="{{ asset('/assets/js/pages/dashboard.init.js') }}"></script>

 <!-- App js -->
 <script src="{{ asset('/assets/js/app.js') }}"></script>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 {{-- ==================================================== --}}
 <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
 <script src="{{ asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
 <script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>
 <script>
     @if(Session::has('Success'))
  		toastr.success("{{ Session::get('Success') }}");
     @endif
 </script>
 <script>
     @if(Session::has('Error'))
  		toastr.error("{{ Session::get('Error') }}");
     @endif
 </script>
 {{-- <script>
        $('#change-password').on('submit',function(event){
        event.preventDefault();
        var Id = $('#data_id').val();
        var current_password = $('#current-password').val();
        var password = $('#password').val();
        var password_confirm = $('#password-confirm').val();
        $('#current_passwordError').text('');
        $('#passwordError').text('');
        $('#password_confirmError').text('');
        $.ajax({
            url: "{{ url('update-password') }}" + "/" + Id,
            type:"POST",
            data:{
                "current_password": current_password,
                "password": password,
                "password_confirmation": password_confirm,
                "_token": "{{ csrf_token() }}",
            },
            success:function(response){
                console.log(response);
                toastr.success('Password Changed Successfully');
                $('#current_passwordError').text('');
                $('#passwordError').text('');
                $('#password_confirmError').text('');
                if(response.isSuccess == false){
                    $('#current_passwordError').text(response.Message);
                }else if(response.isSuccess == true){
                    setTimeout(function () {
                        window.location.href = "{{ route('admin.dashboard') }}";
                    }, 1000);
                }
            },
            error: function(response) {
                console.log(response);
                var loadedError = JSON.parse(response.responseText);
                console.log(loadedError);
                $('#current_passwordError').text(loadedError.errors.current_password);
                $('#passwordError').text(loadedError.errors.password);
                $('#password_confirmError').text(loadedError.errors.password_confirmation);
            }
        });
    });
 </script> --}}
 @yield('scripts')

 </body>

 </html>
