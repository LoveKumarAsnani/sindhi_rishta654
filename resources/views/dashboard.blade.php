@extends('layouts.admin.admin-layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {{-- <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">

            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body border rounded  border-light">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Registered User</p>
                                        <h4 class="mb-0">{{$users}}</h4>
                                    </div>

                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body border rounded  border-light">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Unverified Users</p>
                                        <h4 class="mb-0">{{$unverifiedUsers}}</h4>
                                    </div>

                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body border rounded  border-light">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Verified Users</p>
                                        <h4 class="mb-0">{{$verifiedUsers}}</h4>
                                    </div>

                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mini-stats-wid">
                            <div class="card-body border rounded  border-light">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Blocked Users</p>
                                        <h4 class="mb-0">{{$blockedUsers}}</h4>
                                    </div>

                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                </div>


            </div>
        </div>

    </div>
@endsection
