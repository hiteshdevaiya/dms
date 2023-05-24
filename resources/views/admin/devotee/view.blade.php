@extends('layouts.master')
@section('title')
    @lang('translation.devotee')
@endsection
@section('css')
    <link rel="stylesheet" href="{{url('public/backend/css/intlTelInput.css')}}" />
@endsection
@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
            <img src="{{ url('public/images/cover_image.png') }}" class="profile-wid-img" alt="">

        </div>
    </div>
     @if(isset($data) && !empty($data->id))
        @php $id = $data->id; @endphp
    @else
        @php $id = 0;@endphp
    @endif


        <div class="row">
            <div class="col-xxl-3">
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">

                                @if (isset($data->image) && !empty($data->image))
                                    @if (file_exists(public_path('/uploads/devotee_profile') . '/' . $data->image))
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ url('public/uploads/devotee_profile') . '/' . $data->image }}" alt="user-profile-image">
                                    @else
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-update-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                    @endif
                                @else
                                @if(isset($id) && !empty($id))
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-update-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                @else
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                @endif

                                @endif
                            </div>

                            <h6>Profile Image</h6>
                        </div>

                    </div>

                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#occupationDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Occupation Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addressDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Address Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#relationDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Relationship Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#documentDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Document Details
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="surname" class="form-label">Surname<span class="error">*</span></label>
                                                <input type="text" id="surname" name="surname" class="form-control" placeholder="Enter Surname" value="{{$data->surname ?? ''}}"  readonly>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name<span class="error">*</span></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" value="{{$data->first_name ?? ''}}" readonly/>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name (Husband / Father)<span class="error">*</span></label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{$data->last_name ?? ''}}" readonly/>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">email</label>
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{$data->email ?? ''}}" readonly/>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        @if(isset($data->dob) && !empty($data->dob))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                               <label for="datepicker-range" class="form-label">Date Of Birth</label>
                                               @if(isset($data->dob) && !empty($data->dob))
                                               @php $dob = date('d-m-Y', strtotime($data->dob)); @endphp
                                               @endif
                                                <input type="text" name="dob" value="{{$dob ?? ''}}" class="form-control flatpickr-input" id="dob" data-provider="flatpickr" data-range="true" placeholder="Select Date Of Birth" disabled>
                                            </div>
                                        </div>
                                        @endif
                                        @if(isset($data->gender) && !empty($data->gender))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" value="male" {{(isset($data) && ($data->gender == 'male')) ? 'checked' : ''}}>
                                                            <label class="form-check-label">
                                                                Male
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" value="female" {{(isset($data) && ($data->gender == 'female')) ? 'checked' : ''}}>
                                                            <label class="form-check-label">
                                                                Female
                                                            </label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile
                                                    Number<span class="error">*</span></label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="mobile_no"
                                                    placeholder="Enter your phone number" name="mobile_no" value="{{$data->mobile_no ?? ''}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="con_code" id="con_code" value="">
                                        <input type="hidden" name="con_flag" id="con_flag" value="">
                                        <!--end col-->
                                        @if(isset($data->whatsapp_no) && !empty($data->whatsapp_no))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="whatsapp_no" class="form-label">WhatsApp Number</label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="whatsapp_no"
                                                    placeholder="Enter your whatsApp number" name="whatsapp_no" value="{{$data->whatsapp_no ?? ''}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <input type="hidden" name="whatsapp_con_code" id="whatsapp_con_code" value="">
                                        <input type="hidden" name="whatsapp_con_flag" id="whatsapp_con_flag" value="">

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no_2" class="form-label">Mobile
                                                    Number 2</label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="mobile_no_2"
                                                    placeholder="Enter your phone number" name="mobile_no_2" value="{{$data->mobile_no_2 ?? ''}}" readonly >
                                                </div>
                                            </div>
                                        </div>

                                        <!--end col-->
                                        @if(isset($data->address) && !empty($data->address))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address" value="{{$data->address ?? ''}}" readonly/>
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        @if(isset($data->area) && !empty($data->area))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="area" class="form-label">Area/Village</label>
                                                <input type="text" id="area" name="area" class="form-control" placeholder="Enter Area/Village" value="{{$data->area ?? ''}}" readonly/>
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        @if(isset($data->country_id) && !empty($data->country_id))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Select Country</label>
                                                {!! Form::select('country_id',$country ?? '',$data->country_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'country_id','placeholder'=>'Select Country']) !!}
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        @if(isset($data->state_id) && !empty($data->state_id))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="state_id" class="form-label">Select State</label>
                                                {!! Form::select('state_id',$state ?? [],$data->state_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'state_id','placeholder'=>'Select State']) !!}
                                            </div>
                                        </div>
                                        @endif
                                        <!--end col-->
                                        @if(isset($data->city_id) && !empty($data->city_id))
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="city_id" class="form-label">Select City</label>
                                                {!! Form::select('city_id',$city ?? [],$data->city_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'city_id','placeholder'=>'Select City']) !!}
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="native_place" class="form-label">Native Place</label>
                                                <input type="text" id="native_place" name="native_place" class="form-control" placeholder="Enter native place" value="{{$data->native_place ?? ''}}" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="marital_status" class="form-label">Marital Status</label>
                                                <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input marital_status" type="radio" name="marital_status" value="1" {{(isset($data) && ($data->marital_status == '1')) ? 'checked' : ''}} @disabled(true)>
                                                            <label class="form-check-label">
                                                                Single
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input marital_status" type="radio" name="marital_status" value="2" {{(isset($data) && ($data->marital_status  == '2')) ? 'checked' : ''}} @disabled(true)>
                                                            <label class="form-check-label">
                                                                Married
                                                            </label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 marriage_date_div {{ isset($data) && $data->marital_status  == '2' ? '' : 'd-none' }}">
                                            <div class="mb-3">
                                               <label for="datepicker-range" class="form-label">Marriage date</label>
                                               @if(isset($data->marriage_date) && !empty($data->marriage_date))
                                               @php $marriage_date = date('d-m-Y', strtotime($data->marriage_date)); @endphp
                                               @endif
                                                <input type="text" name="marriage_date" value="{{$marriage_date ?? ''}}" class="form-control flatpickr-input" id="marriage_date" data-provider="flatpickr" data-range="true" placeholder="Select Marriage Date" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{route('devotee')}}" class="btn btn-soft-success">Close</a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                            </div>
                            <!--end tab-pane-->

                            <div class="tab-pane" id="occupationDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="occupatoin_type" class="form-label">Ocuupation Type</label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="occupatoin_type" value="1" {{(isset($data->occupation) && ($data->occupation->type == '1')) ? 'checked' : ''}} @disabled(true)>
                                                    <label class="form-check-label">
                                                        Business
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="occupatoin_type" value="2" {{(isset($data->occupation) && ($data->occupation->type  == '2')) ? 'checked' : ''}} @disabled(true)>
                                                    <label class="form-check-label">
                                                        Service
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="occupatoin_type" value="3" {{(isset($data->occupation) && ($data->occupation->type  == '3')) ? 'checked' : ''}} @disabled(true)>
                                                    <label class="form-check-label">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="industry_id" class="form-label">Select Industry</label>
                                            {!! Form::select('industry_id',$industry ?? [],$data->occupation->industry_type ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'industry_id','placeholder'=>'Select Industry']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="{{$data->occupation->title ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_country_id" class="form-label">Select Country</label>
                                            {!! Form::select('od_country_id',$country ?? '',$data->occupation->country_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'od_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_state_id" class="form-label">Select State</label>
                                            {!! Form::select('od_state_id',$state ?? [],$data->occupation->state_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'od_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_city_id" class="form-label">Select City</label>
                                            {!! Form::select('od_city_id',$city ?? [],$data->occupation->city_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'od_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('devotee')}}" class="btn btn-soft-success">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="addressDetails" role="tabpanel">
                                <div class="row">
                                    <div class="card-header align-items-center d-flex mb-2">
                                        <h4 class="card-title mb-0 flex-grow-1 text-dark ">Permanent Address</h4>
                                    </div><!-- end card header -->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_address" class="form-label">Address</label>
                                            <input type="text" id="pa_address" name="pa_address" class="form-control" placeholder="Enter Address" value="{{$data->permanentAddress->address ?? ''}}"  readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_pincode" class="form-label">Pincode</label>
                                            <input type="text" id="pa_pincode" name="pa_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->permanentAddress->pincode ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_area" class="form-labelpa_">Area/Village</label>
                                            <input type="text" id="pa_area" name="pa_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->permanentAddress->area ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_country_id" class="form-label">Select Country</label>
                                            {!! Form::select('pa_country_id',$country ?? '',$data->permanentAddress->country_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'pa_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_state_id" class="form-label">Select State</label>
                                            {!! Form::select('pa_state_id',$state ?? [],$data->permanentAddress->state_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'pa_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_city_id" class="form-label">Select City</label>
                                            {!! Form::select('pa_city_id',$city ?? [],$data->permanentAddress->city_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'pa_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-header align-items-center d-flex mb-2  custom-border-top mt-4">
                                        <h4 class="card-title mb-0 flex-grow-1 text-dark ">Communication Address</h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_address" class="form-label">Address</label>
                                            <input type="text" id="ca_address" name="ca_address" class="form-control" placeholder="Enter Address" value="{{$data->communicationAddress->address ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_pincode" class="form-label">Pincode</label>
                                            <input type="text" id="ca_pincode" name="ca_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->communicationAddress->pincode ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_area" class="form-labelca_">Area/Village</label>
                                            <input type="text" id="ca_area" name="ca_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->communicationAddress->area ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_country_id" class="form-label">Select Country</label>
                                            {!! Form::select('ca_country_id',$country ?? '',$data->communicationAddress->country_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ca_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_state_id" class="form-label">Select State</label>
                                            {!! Form::select('ca_state_id',$state ?? [],$data->communicationAddress->state_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ca_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_city_id" class="form-label">Select City</label>
                                            {!! Form::select('ca_city_id',$city ?? [],$data->communicationAddress->city_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ca_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-header align-items-center d-flex mb-2 custom-border-top mt-4">
                                        <h4 class="card-title mb-0 flex-grow-1 text-dark ">Magazine Address</h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_address" class="form-label">Address</label>
                                            <input type="text" id="ma_address" name="ma_address" class="form-control" placeholder="Enter Address" value="{{$data->magazineAddress->address ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_pincode" class="form-label">Pincode</label>
                                            <input type="text" id="ma_pincode" name="ma_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->magazineAddress->pincode ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_area" class="form-labelma_">Area/Village</label>
                                            <input type="text" id="ma_area" name="ma_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->magazineAddress->area ?? ''}}" readonly />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_country_id" class="form-label">Select Country</label>
                                            {!! Form::select('ma_country_id',$country ?? '',$data->magazineAddress->country_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ma_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_state_id" class="form-label">Select State</label>
                                            {!! Form::select('ma_state_id',$state ?? [],$data->magazineAddress->state_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ma_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_city_id" class="form-label">Select City</label>
                                            {!! Form::select('ma_city_id',$city ?? [],$data->magazineAddress->city_id ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'ma_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('devotee')}}" class="btn btn-soft-success">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="relationDetails" role="tabpanel">
                                @if(isset($data->relationships) && count($data->relationships))
                                    @foreach ($data->relationships as $relationshipone)
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_first_name" class="form-label">First Name</label>
                                                    <input type="text" id="rd_first_name" name="rd_first_name[]" class="form-control" placeholder="Enter First Name" value="{{$relationshipone->first_name ?? ''}}" readonly />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_middle_name" class="form-label">Middle Name</label>
                                                    <input type="text" id="rd_middle_name" name="rd_middle_name[]" class="form-control" placeholder="Enter Middle Name" value="{{$relationshipone->middle_name ?? ''}}" readonly />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_last_name" class="form-label">Last Name</label>
                                                    <input type="text" id="rd_last_name" name="rd_last_name[]" class="form-control" placeholder="Enter Last Name" value="{{$relationshipone->last_name ?? ''}}" readonly />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_mobile" class="form-label">Mobile</label>
                                                    <input type="text" id="rd_mobile" name="rd_mobile[]" class="form-control" placeholder="Enter Mobile" value="{{$relationshipone->mobile ?? ''}}" readonly />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_relationship_id" class="form-label">Select Relationship</label>
                                                    {!! Form::select('rd_relationship_id[]',$relationship ?? [],$relationshipone->relation ?? '',['class'=>'form-control select-disable-white','disabled'=>'disabled','id'=>'rd_relationship_id','placeholder'=>'Select Relationship']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('devotee')}}" class="btn btn-soft-success">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="documentDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-4">
                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-file-ppt-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1">
                                                        <div class="text-body text-truncate d-block">Aadhar Card</div>
                                                    </h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        @if(isset($data->aadhar_card) && $data->aadhar_card != null && $data->aadhar_card != "")
                                                            <a href="{{ url('public/uploads/devotee_documents') . '/' . $data->aadhar_card }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4">
                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-file-ppt-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1">
                                                        <div class="text-body text-truncate d-block">Pan Card</div>
                                                    </h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        @if(isset($data->pan_card) && $data->pan_card != null && $data->pan_card != "")
                                                            <a href="{{url('public/uploads/devotee_documents') . '/' . $data->pan_card }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4">
                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div class="avatar-title bg-light text-secondary rounded fs-24">
                                                            <i class="ri-file-ppt-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1">
                                                        <div class="text-body text-truncate d-block">Passport ID</div>
                                                    </h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        @if(isset($data->passport) && $data->passport != null && $data->passport != "")
                                                            <a href="{{ url('public/uploads/devotee_documents') . '/' . $data->passport }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('devotee')}}" class="btn btn-soft-success">Close</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection
@section('script')
    <script src="{{ url('public/build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ url('/public/build/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ url('public/backend/js/intlTelInput.min.js')}}"></script>
    <script type="text/javascript">
        $("#dob").flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y",
        });
    let phoneInputField = document.querySelector("#mobile_no");
    let phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "in",
        hiddenInput:'full',
        formatOnDisplay:false,
        utilsScript:"{{ url('public/backend/js/utils.js')}}",
        autoPlaceholder: "ON",
    });

    @if( isset($data['country_flag']) && !empty($data['country_flag']) )
    phoneInput.setCountry("{{ $data['country_flag'] }}");
    @endif

    //for whatsapp no
    let phoneInputField1 = document.querySelector("#whatsapp_no");
    let phoneInput1 = window.intlTelInput(phoneInputField1, {
        initialCountry: "in",
        hiddenInput:'full',
        formatOnDisplay:false,
        utilsScript:"{{ url('public/backend/js/utils.js')}}",
        autoPlaceholder: "ON",
    });

    @if( isset($data['wh_country_flag']) && !empty($data['wh_country_flag']) )
    phoneInput1.setCountry("{{ $data['wh_country_flag'] }}");
    @endif

    let phoneInputField2 = document.querySelector("#mobile_no_2");
    let phoneInput2 = window.intlTelInput(phoneInputField2, {
        initialCountry: "in",
        hiddenInput:'full',
        formatOnDisplay:false,
        utilsScript:"{{ url('public/backend/js/utils.js')}}",
        autoPlaceholder: "ON",
    });

    @if( isset($data['country_2_flag']) && !empty($data['country_2_flag']) )
    phoneInput2.setCountry("{{ $data['country_2_flag'] }}");
    @endif

    $(document).on("change","#country_id",function() {
        country_id = this.value;
        changecountry(country_id);
    });


    $(document).on("change","#state_id",function() {
        state_id = this.value;
        country_id = $('#country_id').val();
        changestate(country_id,state_id);
    });

    function changecountry(country_id) {
        $("#city_id").html('<option value="">Select City</option>');
        $("#state_id").html('<option value="">Select State</option>');
        // Here we can get the value of selected item
        if (country_id != '') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: dms_app.baseURL() + '/getstate',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    country_id: country_id,
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    if (data != '') {
                        $("#state_id").html(data);
                    }
                }
            });
        } else {
            $("#city_id").html('<option value="">Select City</option>');
            $("#state_id").html('<option value="">Select State</option>');
        }
    }


    function changestate(country_id,state_id) {
        $("#city_id").html('<option value="">Select City</option>');
        // Here we can get the value of selected item
        if (country_id != '' && state_id != '') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: dms_app.baseURL() + '/getcity',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    country_id: country_id,
                    state_id: state_id,
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                    if (data != '') {
                        $("#city_id").html(data);
                    }
                }
            });
        } else {
            $("#city_id").html('<option value="">Select City</option>');
        }
    }

    $(document).on('click','.avatar-title-delete',function(){
        var default_image = "{{ url('public/build/images/users/user-dummy-img.png') }}";
        var $el = $('#profile-img-file-input');
        $('.user-profile-image').attr("src",default_image);
        $el.wrap('<form>').closest('form').get(0).reset();
      $el.unwrap();
    });

    $(document).on('click','#profile-img-file-input',function(){
            $('.profile-photo-delete').show();
    });

    </script>
@endsection
