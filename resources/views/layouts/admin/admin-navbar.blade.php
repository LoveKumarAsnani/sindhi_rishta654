            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="#" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('/assets/images/logo.svg') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('/assets/images/logo-dark.png') }}" alt=""
                                        height="17">
                                </span>
                            </a>

                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt=""
                                        height="70">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                            id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- App Search-->

                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-none d-lg-inline-block ms-1">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                data-toggle="fullscreen">
                                <i class="bx bx-fullscreen"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user"
                                    src="{{ asset('/assets/images/users/profile.png') }}" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ auth()->user()->name }}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
                                <a class="dropdown-item d-block" href="#" data-bs-toggle="modal"
               data-bs-target=".change-password"><i
                    class="bx bx-reset font-size-16 align-middle me-1"></i> <span
                    key="t-settings">Change Password</span></a>
                                <a class="dropdown-item text-danger"  href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"><i
                                        class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                                        key="t-logout"> {{ __('Logout') }}</span></a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                            </div>
                        </div>

                        {{-- <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <i class="bx bx-cog bx-spin"></i>
                            </button>
                        </div> --}}

                    </div>
                </div>
            </header>

            <!--  Change-Password example -->
<div class="modal fade change-password" tabindex="-1" role="dialog"
aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
       <div class="modal-header">
           <h5 class="modal-title" id="myLargeModalLabel">Change Password</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="Close"></button>
       </div>
       <div class="modal-body">
           <form method="POST" id="change-password">
               @csrf
               <input type="hidden" value="{{ Auth::user()->id }}" id="data_id">
               <div class="mb-3">
                   <label for="current_password">Current Password</label>
                   <input id="current-password" type="password"
                          class="form-control @error('current_password') is-invalid @enderror"
                          name="current_password" autocomplete="current_password"
                          placeholder="Enter Current Password" value="{{ old('current_password') }}">
                   <div class="text-danger" id="current_passwordError" data-ajax-feedback="current_password"></div>
               </div>

               <div class="mb-3">
                   <label for="newpassword">New Password</label>
                   <input id="password" type="password"
                          class="form-control @error('password') is-invalid @enderror" name="password"
                          autocomplete="new_password" placeholder="Enter New Password">
                   <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
               </div>

               <div class="mb-3">
                   <label for="userpassword">Confirm Password</label>
                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                          autocomplete="new_password" placeholder="Enter New Confirm password">
                   <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm"></div>
               </div>

               <div class="mt-3 d-grid">
                   <button class="btn btn-primary waves-effect waves-light UpdatePassword"
                           data-id="{{ Auth::user()->id }}"
                           type="submit">Update Password
                   </button>
               </div>
           </form>
       </div>
   </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
