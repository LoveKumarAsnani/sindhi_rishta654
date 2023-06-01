@extends('layouts.admin.admin-layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="float-right">
                                <div class="row">
                                    <label>Select Candidate Attempts</label>
                                    <div class="col-2">

                                        <select name="changeAttemptType" onchange="handleSelectChange(event)" id="changeAttemptType"
                                            class="form-control paid" required>
                                            <option value="">Select All</option>
                                            <option value="0">All Company</option>
                                            <option value="1">Without Company</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <br>
                            <table id="datatble" class="table table-bordered yajra-datatable">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Phone Number</th>
                                        {{-- <th>Age</th> --}}
                                        <th>Profile Filled By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


            <!-- sample modal content -->
            <div id="viewModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myModalLabel">View
                                {{ ucwords(str_replace('_', ' ', request()->segment(2))) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>

                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'id')) }}</th>
                                            <td id="id" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'name')) }}</th>
                                            <td id="name" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'email')) }}</th>
                                            <td id="email" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'gender')) }}</th>
                                            <td id="gender" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'ethnicity')) }}</th>
                                            <td id="ethnicity" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'age')) }}</th>
                                            <td id="age" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'occupation')) }}</th>
                                            <td id="occupation" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'city')) }}</th>
                                            <td id="city" align="center"></td>
                                        </tr>
                                        <tr>
                                            <th>{{ ucwords(str_replace('_', ' ', 'company_name')) }}</th>
                                            <td id="company_name" align="center"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



            <!-- Delete content -->
            <div id="confirmModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h4 align="center" style="margin: 0;">Are you sure you want to delete this ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="ok_delete" name="ok_delete" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
@endsection
@section('scripts')
    {{-- ===================================================== --}}
    <script type="text/javascript">
        $(function() {

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $(document, this).on('change', '.user-status', function() {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: `{{ route('admin.users.status-change') }}`,
                    type: "post",
                    data: {
                        "id": $(this).data('id'),
                        "status": $(this).val(),
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#datatble').DataTable().destroy();
                        loadData();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus, errorThrown);
                    }
                });
            });
            loadData();

            // View Records
            $(document, this).on('click', '.view', function() {
                let id = $(this).attr('id');

                let url = ''
                $.ajax({
                    url: url.replace(':id', id),
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        document.getElementById('id').innerText = data.id;
                        document.getElementById('name').innerText = data.name;
                        document.getElementById('email').innerText = data.email;
                        document.getElementById('ethnicity').innerText = data
                            .ethnicity;
                        document.getElementById('age').innerText = data
                            .ethnicity;
                        document.getElementById('gender').innerText = data
                            .ethnicity;
                        document.getElementById('occupation').innerText = data
                            .ethnicity;
                        document.getElementById('city').innerText = data
                            .ethnicity;
                        document.getElementById('company_name').innerText = data
                            .company.company_name;
                        // document.getElementById('brand_logo').innerHTML = `<img alt="{{ asset('') }}${data.brand_logo}" src="{{ asset('') }}${data.brand_logo}" />`;
                        $("#viewModal").modal('show');
                    }
                })
            })



        })

        function loadData() {
            var source = `{{ route('admin.users.index') }}`;

            var table = $('.yajra-datatable').DataTable({
                dom: "Blfrtip",
                buttons: [{
                    extend: "copy",
                    className: "btn-sm"
                }, {
                    extend: "csv",
                    className: "btn-sm"
                }, {
                    extend: "excel",
                    className: "btn-sm"
                }, {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                }, {
                    extend: "colvis",
                    className: "btn-sm"
                }],
                processing: true,
                serverSide: true,
                responsive: true,
                retrieve: true,
                ajax: source,
                columns: [


                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name',
                        render: function(data, type, row) {
                            return row.first_name + " " + row.last_name;
                        }
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'gender',
                        name: 'gender',
                        render: function(data, type, row) {
                            if (row.gender == "1") {
                                return "Male";
                            } else if (row.gender == "2") {
                                return "Female";
                            }
                            return 'Other';
                        }
                    },

                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'profile_fill_by',
                        name: 'profile_fill_by'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }

                    // {
                    //     data: 'age',
                    //     name: 'age'
                    // },

                ]
            });
        }

        //  function handleSelectChange(event) {
        //     var selectElement = event.target;
        //     var value = selectElement.value;
        //     $('#datatble').DataTable().destroy();
        //     loadData(value);
        // }
    </script>
@endsection
