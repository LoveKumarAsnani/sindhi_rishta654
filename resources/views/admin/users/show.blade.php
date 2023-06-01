@extends('layouts.admin.admin-layout')
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="h2">Personal Information</p>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100 ">Name</label>
                                    <input class="form-label w-100 p-2" disabled
                                        value="{{ $user->first_name }} {{ $user->last_name }}" />

                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Nick Name</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->nick_name)) text-danger @endif"
                                        disabled value="{{ $user->nick_name ?? '' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Email</label>
                                    <input class="form-label w-100 p-2" disabled value="{{ $user->email ?? '' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Username</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->user_name)) text-danger @endif"
                                        disabled value="{{ $user->user_name ?? '' }}" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Phone Number</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->phone_number)) text-danger @endif"
                                        disabled value="{{ $user->phone_number }}" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Gender</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->gender)) text-danger @endif"
                                        disabled value="@if ($user->gender == '1') Male @else Female @endif" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Email Verified</label>
                                    <input class="form-label w-100 p-2" disabled
                                        value="@if ($user->is_email_verified == '1') Verified @else Unverified @endif" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">User Status</label>
                                    <input class="form-label w-100 p-2" disabled
                                        value="@if ($user->status == '0') Unverified @elseif ($user->status == '1') Verified @else Blocked @endif" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Surname</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->profile->surname)) text-danger @endif"
                                        disabled value="{{ $user->profile->surname ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Caste</label>
                                    <input class="form-label w-100 p-2 @if (!isset($user->profile->caste)) text-danger @endif"
                                        disabled value="{{ $user->profile->caste ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Community</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->community)) text-danger @endif"
                                        disabled value="{{ $user->profile->community ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Religion</label>
                                    <input class="form-label w-100 p-2"
                                        @if (isset($user->profile->religion)) text-danger @endif disabled
                                        value="{{ $user->profile->religion ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Date of Birth</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->date_of_birth)) text-danger @endif"
                                        disabled value="{{ $user->profile->date_of_birth ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Martial Status</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->martial_status)) text-danger @endif"
                                        disabled value="{{ $user->profile->martial_status ?? 'Not Given' }}" />
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Mother Tongue</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->mother_tongue)) text-danger @endif"
                                        disabled value="{{ $user->profile->mother_tongue ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Physical Status</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->physical_status)) text-danger @endif"
                                        disabled value="{{ $user->profile->physical_status ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Alcholic</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->alcoholic)) text-danger @endif"
                                        disabled
                                        value="@if ($user->profile->alcoholic == '0') No @elseif ($user->profile->alcoholic == '1') Yes @endif" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Vegetarian</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->vegetarian)) text-danger @endif"
                                        disabled
                                        value="@if ($user->profile->vegetarian == '0') No @elseif ($user->profile->vegetarian == '1') Yes @endif" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Height</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->height)) text-danger @endif"
                                        disabled value="{{ $user->profile->height ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Weight</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->weight)) text-danger @endif"
                                        disabled value="{{ $user->profile->weight ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Bio</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->bio)) text-danger @endif"
                                        disabled value="{{ $user->profile->bio ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <p class="h2">Location Information</p>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">State</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->state)) text-danger @endif"
                                        disabled value="{{ $user->profile->state ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Country</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->country)) text-danger @endif"
                                        disabled value="{{ $user->profile->country ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">City</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->city)) text-danger @endif"
                                        disabled value="{{ $user->profile->city ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Home Town</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->home_town)) text-danger @endif"
                                        disabled value="{{ $user->profile->home_town ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <p class="h2">Family Information</p>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Father Name</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->father_name)) text-danger @endif"
                                        disabled value="{{ $user->profile->father_name ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Father Occupation</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->father_occupation)) text-danger @endif"
                                        disabled value="{{ $user->profile->father_occupation ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Grand Father Name</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->grand_father_name)) text-danger @endif"
                                        disabled value="{{ $user->profile->grand_father_name ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Mother Name</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->mother_name)) text-danger @endif"
                                        disabled value="{{ $user->profile->mother_name ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Mother From</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->mother_from)) text-danger @endif"
                                        disabled value="{{ $user->profile->mother_from ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Brothers</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->brothers)) text-danger @endif"
                                        disabled value="{{ $user->profile->brothers ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Sisters</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->sisters)) text-danger @endif"
                                        disabled value="{{ $user->profile->sisters ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Brothers Married</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->brothers_married)) text-danger @endif"
                                        disabled value="{{ $user->profile->brothers_married ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Sisters Married</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->sisters_married)) text-danger @endif"
                                        disabled value="{{ $user->profile->sisters_married ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <p class="h2">Education and Professional Information</p>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Highest Education</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->highest_education)) text-danger @endif"
                                        disabled value="{{ $user->profile->highest_education ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Degree</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->degree)) text-danger @endif"
                                        disabled value="{{ $user->profile->degree ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Occupation</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->occupation)) text-danger @endif"
                                        disabled value="{{ $user->profile->occupation ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Job Type</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->job_type)) text-danger @endif"
                                        disabled value="{{ $user->profile->job_type ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Salary</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->salary)) text-danger @endif"
                                        disabled value="{{ $user->profile->salary ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Currency</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->currency)) text-danger @endif"
                                        disabled value="{{ $user->profile->currency ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <p class="h2">General Information</p>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Skin Color</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->skin_color)) text-danger @endif"
                                        disabled value="{{ $user->profile->skin_color ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Guardian Phone Number</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->guardian_phone_number)) text-danger @endif"
                                        disabled value="{{ $user->profile->guardian_phone_number ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Blood Group</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->blood_group)) text-danger @endif"
                                        disabled value="{{ $user->profile->blood_group ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">TIme to Call</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->time_to_call)) text-danger @endif"
                                        disabled value="{{ $user->profile->time_to_call ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Father Alive</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->father_alive)) text-danger @endif"
                                        disabled value="{{ $user->profile->father_alive ?? 'Not Given' }}" />
                                </div>
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Mother Alive</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->mother_alive)) text-danger @endif"
                                        disabled value="{{ $user->profile->mother_alive ?? 'Not Given' }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label w-100">Horoscope</label>
                                    <input
                                        class="form-label w-100 p-2 @if (!isset($user->profile->horoscope)) text-danger @endif"
                                        disabled value="{{ $user->profile->horoscope ?? 'Not Given' }}" />
                                </div>

                            </div>

                            <div class="mb-3 ">
                                @forelse ($user->pictures as $picture)
                                    <img src="{{ public_path('pictures/') }}/{{ $picture->image_name }}">
                                @empty
                                    <div class="text-danger">
                                        No Image Found
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection
