@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.devotee')
@endsection
@section('css')
    <link rel="stylesheet" href="{{url('public/backend/css/intlTelInput.css')}}" />
@endsection
@section('content')
<style>
    .element {
    display: inline-flex;
    align-items: center;
}

#passport_file,#pan_card_file,#aadhar_card_file {
    display: none;
}
    </style>
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
    <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="{{url($actionURL.'/action',$view).'/'.$id ?? 0}}" autocomplete="off" id="frontdevoteeform">
            @csrf
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
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                    @endif
                                @else
                                @if(isset($id) && !empty($id))
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                @else
                                    <img class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{ url('public/build/images/users/user-dummy-img.png') }}" alt="user-profile-image">
                                @endif

                                @endif
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" name="cover_image" class="profile-img-file-input">
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                                @if(isset($id) && !empty($id))
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-delete">
                                        <label class="profile-photo-delete avatar-xs">
                                            <span class="avatar-title-delete rounded-circle bg-light text-body">
                                                <i class=" ri-close-circle-line"></i>
                                            </span>
                                        </label>
                                    </div>
                                @else
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-delete" style="display: none;">
                                        <label class="profile-photo-delete avatar-xs">
                                            <span class="avatar-title-delete rounded-circle bg-light text-body">
                                                <i class=" ri-close-circle-line"></i>
                                            </span>
                                        </label>
                                    </div>
                                @endif
                            </div>

                            <h6>Upload Profile Image</h6>
                            <h6>(Less than 5mb)</h6>
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
                                                <input type="text" id="surname" name="surname" class="form-control" placeholder="Enter Surname" value="{{$data->surname ?? ''}}" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name<span class="error">*</span></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter First Name" value="{{$data->first_name ?? ''}}" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="last_name" class="form-label">Last Name (Husband / Father)<span class="error">*</span></label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter Last Name" value="{{$data->last_name ?? ''}}" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email<span class="error">*</span></label>
                                                <input type="text" id="email" name="email" class="form-control" placeholder="Enter Email Address" value="{{$data->email ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                               <label for="datepicker-range" class="form-label">Date Of Birth<span class="error">*</span></label>
                                               @if(isset($data->dob) && !empty($data->dob))
                                               @php $dob = date('d-m-Y', strtotime($data->dob)); @endphp
                                               @endif
                                                <input type="text" name="dob" value="{{$dob ?? ''}}" class="form-control flatpickr-input" id="dob" data-provider="flatpickr" data-range="true" placeholder="Select Date Of Birth">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender<span class="error">*</span></label>
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
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile
                                                    Number<span class="error">*</span></label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="mobile_no"
                                                    placeholder="Enter your phone number" name="mobile_no" value="{{$data->mobile_no ?? ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="con_code" id="con_code" value="">
                                        <input type="hidden" name="con_flag" id="con_flag" value="">
                                        <!--end col-->
                                        <input type="hidden" id="edit_type" value="{{(isset($data) && !empty($data)) ? 'edit' : 'add'}}">
                                        <input type="hidden" id="devotee_hidden_id" value="{{$data->id ?? ''}}">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="whatsapp_no" class="form-label">WhatsApp Number<span class="error">*</span></label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="whatsapp_no"
                                                    placeholder="Enter your whatsApp number" name="whatsapp_no" value="{{$data->whatsapp_no ?? ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="whatsapp_con_code" id="whatsapp_con_code" value="">
                                        <input type="hidden" name="whatsapp_con_flag" id="whatsapp_con_flag" value="">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no_2" class="form-label">Mobile
                                                    Number 2<span class="error">*</span></label>
                                                <div>
                                                <input type="text" class="form-control onlyNumerics" id="mobile_no_2"
                                                    placeholder="Enter your phone number" name="mobile_no_2" value="{{$data->mobile_no_2 ?? ''}}">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="con_2_code" id="con_2_code" value="">
                                        <input type="hidden" name="con_2_flag" id="con_2_flag" value="">

                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address<span class="error">*</span></label>
                                                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Address" value="{{$data->address ?? ''}}" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="area" class="form-label">Area/Village<span class="error">*</span></label>
                                                <input type="text" id="area" name="area" class="form-control" placeholder="Enter Area/Village" value="{{$data->area ?? ''}}" />
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="country_id" class="form-label">Select Country<span class="error">*</span></label>
                                                {!! Form::select('country_id',$country ?? '',$data->country_id ?? '',['class'=>'form-control','id'=>'country_id','placeholder'=>'Select Country']) !!}
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="state_id" class="form-label">Select State<span class="error">*</span></label>
                                                {!! Form::select('state_id',$state ?? [],$data->state_id ?? '',['class'=>'form-control','id'=>'state_id','placeholder'=>'Select State']) !!}
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="city_id" class="form-label">Select City<span class="error">*</span></label>
                                                {!! Form::select('city_id',$city ?? [],$data->city_id ?? '',['class'=>'form-control','id'=>'city_id','placeholder'=>'Select City']) !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="native_place" class="form-label">Native Place<span class="error">*</span></label>
                                                <input type="text" id="native_place" name="native_place" class="form-control" placeholder="Enter native place" value="{{$data->native_place ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="marital_status" class="form-label">Marital Status<span class="error">*</span></label>
                                                <div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input marital_status" type="radio" name="marital_status" value="1" {{(isset($data) && ($data->marital_status == '1')) ? 'checked' : ''}}>
                                                            <label class="form-check-label">
                                                                Single
                                                            </label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input marital_status" type="radio" name="marital_status" value="2" {{(isset($data) && ($data->marital_status  == '2')) ? 'checked' : ''}}>
                                                            <label class="form-check-label">
                                                                Married
                                                            </label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 marriage_date_div d-none">
                                            <div class="mb-3">
                                               <label for="datepicker-range" class="form-label">Marriage date<span class="error">*</span></label>
                                               @if(isset($data->marriage_date) && !empty($data->marriage_date))
                                               @php $marriage_date = date('d-m-Y', strtotime($data->marriage_date)); @endphp
                                               @endif
                                                <input type="text" name="marriage_date" value="{{$marriage_date ?? ''}}" class="form-control flatpickr-input" id="marriage_date" data-provider="flatpickr" data-range="true" placeholder="Select Marriage Date">
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-primary changeTab" data-tab="occupationDetails">Save & Next</button>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                            </div>
                            <div class="tab-pane" id="occupationDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="occupatoin_type" class="form-label">Ocuupation Type<span class="error">*</span></label>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input occupatoin_type" type="radio" name="occupatoin_type" value="1" {{(isset($data->occupation) && ($data->occupation->type == '1')) ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Business
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input occupatoin_type" type="radio" name="occupatoin_type" value="2" {{(isset($data->occupation) && ($data->occupation->type  == '2')) ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Service
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input occupatoin_type" type="radio" name="occupatoin_type" value="3" {{(isset($data->occupation) && ($data->occupation->type  == '3')) ? 'checked' : ''}}>
                                                    <label class="form-check-label">
                                                        Other
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 industry_div">
                                        <div class="mb-3">
                                            <label for="industry_id" class="form-label">Select Industry<span class="error">*</span></label>
                                            {!! Form::select('industry_id',$industry ?? [],$data->occupation->industry_type ?? '',['class'=>'form-control','id'=>'industry_id','placeholder'=>'Select Industry']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title<span class="error">*</span></label>
                                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter title" value="{{$data->occupation->title ?? ''}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_country_id" class="form-label">Select Country<span class="error">*</span></label>
                                            {!! Form::select('od_country_id',$country ?? '',$data->occupation->country_id ?? '',['class'=>'form-control','id'=>'od_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_state_id" class="form-label">Select State<span class="error">*</span></label>
                                            {!! Form::select('od_state_id',$state ?? [],$data->occupation->state_id ?? '',['class'=>'form-control','id'=>'od_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="od_city_id" class="form-label">Select City<span class="error">*</span></label>
                                            {!! Form::select('od_city_id',$city ?? [],$data->occupation->city_id ?? '',['class'=>'form-control','id'=>'od_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light changeTab back" data-tab="personalDetails">Back</button>
                                            <button type="button" class="btn btn-primary changeTab" data-tab="addressDetails">Save & Next</button>
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
                                            <label for="pa_address" class="form-label">Address<span class="error">*</span></label>
                                            <input type="text" id="pa_address" name="pa_address" class="form-control" placeholder="Enter Address" value="{{$data->permanentAddress->address ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_pincode" class="form-label">Pincode<span class="error">*</span></label>
                                            <input type="text" id="pa_pincode" name="pa_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->permanentAddress->pincode ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_area" class="form-labelpa_">Area/Village<span class="error">*</span></label>
                                            <input type="text" id="pa_area" name="pa_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->permanentAddress->area ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_country_id" class="form-label">Select Country<span class="error">*</span></label>
                                            {!! Form::select('pa_country_id',$country ?? '',$data->permanentAddress->country_id ?? '',['class'=>'form-control','id'=>'pa_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_state_id" class="form-label">Select State<span class="error">*</span></label>
                                            {!! Form::select('pa_state_id',$state ?? [],$data->permanentAddress->state_id ?? '',['class'=>'form-control','id'=>'pa_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="pa_city_id" class="form-label">Select City<span class="error">*</span></label>
                                            {!! Form::select('pa_city_id',$city ?? [],$data->permanentAddress->city_id ?? '',['class'=>'form-control','id'=>'pa_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-header align-items-center d-flex mb-2  custom-border-top mt-4">
                                        <h4 class="card-title mb-0 flex-grow-1 text-dark ">Communication Address</h4>
                                        <div class="flex-shrink-0">
                                            <div class="card-header border-0 align-items-center d-flex">
                                                <div class="col-md-auto ms-auto">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="text-muted">Same as: </span>
                                                        <select class="form-control mb-0 fillAddress" data-field="ca" name="same_as_address" data-choices data-choices-search-false id="choices-single-default">
                                                            <option value="" disabled selected>Please select address</option>
                                                            @foreach($address_types as $key=>$val)
                                                                @if($key != 2)
                                                                    <option value="{{$key}}">{{$val}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_address" class="form-label">Address<span class="error">*</span></label>
                                            <input type="text" id="ca_address" name="ca_address" class="form-control" placeholder="Enter Address" value="{{$data->communicationAddress->address ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_pincode" class="form-label">Pincode<span class="error">*</span></label>
                                            <input type="text" id="ca_pincode" name="ca_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->communicationAddress->pincode ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_area" class="form-labelca_">Area/Village<span class="error">*</span></label>
                                            <input type="text" id="ca_area" name="ca_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->communicationAddress->area ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_country_id" class="form-label">Select Country<span class="error">*</span></label>
                                            {!! Form::select('ca_country_id',$country ?? '',$data->communicationAddress->country_id ?? '',['class'=>'form-control','id'=>'ca_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_state_id" class="form-label">Select State<span class="error">*</span></label>
                                            {!! Form::select('ca_state_id',$state ?? [],$data->communicationAddress->state_id ?? '',['class'=>'form-control','id'=>'ca_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ca_city_id" class="form-label">Select City<span class="error">*</span></label>
                                            {!! Form::select('ca_city_id',$city ?? [],$data->communicationAddress->city_id ?? '',['class'=>'form-control','id'=>'ca_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card-header align-items-center d-flex mb-2 custom-border-top mt-4">
                                        <h4 class="card-title mb-0 flex-grow-1 text-dark ">Magazine Address</h4>
                                        <div class="flex-shrink-0">
                                            <div class="col-md-auto ms-auto">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="text-muted">Same as: </span>
                                                    <select class="form-control mb-0 fillAddress" data-field="ma" data-choices data-choices-search-false name="same_as_address1" id="choices-single-default">
                                                        <option value="" disabled selected>Please select address</option>
                                                        @foreach($address_types as $key=>$val)
                                                            @if($key != 3)
                                                                <option value="{{$key}}">{{$val}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_address" class="form-label">Address<span class="error">*</span></label>
                                            <input type="text" id="ma_address" name="ma_address" class="form-control" placeholder="Enter Address" value="{{$data->magazineAddress->address ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_pincode" class="form-label">Pincode<span class="error">*</span></label>
                                            <input type="text" id="ma_pincode" name="ma_pincode" class="form-control" placeholder="Enter pincode" value="{{$data->magazineAddress->pincode ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_area" class="form-labelma_">Area/Village<span class="error">*</span></label>
                                            <input type="text" id="ma_area" name="ma_area" class="form-control" placeholder="Enter Area/Village" value="{{$data->magazineAddress->area ?? ''}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_country_id" class="form-label">Select Country<span class="error">*</span></label>
                                            {!! Form::select('ma_country_id',$country ?? '',$data->magazineAddress->country_id ?? '',['class'=>'form-control','id'=>'ma_country_id','placeholder'=>'Select Country']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_state_id" class="form-label">Select State<span class="error">*</span></label>
                                            {!! Form::select('ma_state_id',$state ?? [],$data->magazineAddress->state_id ?? '',['class'=>'form-control','id'=>'ma_state_id','placeholder'=>'Select State']) !!}
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_city_id" class="form-label">Select City<span class="error">*</span></label>
                                            {!! Form::select('ma_city_id',$city ?? [],$data->magazineAddress->city_id ?? '',['class'=>'form-control','id'=>'ma_city_id','placeholder'=>'Select City']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light changeTab back" data-tab="occupationDetails">Back</button>
                                            <button type="button" class="btn btn-primary changeTab" data-tab="relationDetails">Save & Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="relationDetails" role="tabpanel">
                                @if(isset($data->relationships) && count($data->relationships))
                                    @foreach ($data->relationships as $relationshipone)
                                        <div class="row">
                                            <input type="hidden" name="oldRelationIds[]" value="{{ $relationshipone->id }}" />
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_first_name" class="form-label">First Name</label>
                                                    <input type="text" id="rd_first_name" name="rd_first_name[]" class="form-control" placeholder="Enter First Name" value="{{$relationshipone->first_name ?? ''}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_middle_name" class="form-label">Middle Name</label>
                                                    <input type="text" id="rd_middle_name" name="rd_middle_name[]" class="form-control" placeholder="Enter Middle Name" value="{{$relationshipone->middle_name ?? ''}}" />
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_last_name" class="form-label">Last Name</label>
                                                    <input type="text" id="rd_last_name" name="rd_last_name[]" class="form-control" placeholder="Enter Last Name" value="{{$relationshipone->last_name ?? ''}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_mobile" class="form-label">Mobile</label>
                                                    <input type="text" id="rd_mobile" name="rd_mobile[]" class="form-control" placeholder="Enter Mobile" value="{{$relationshipone->mobile ?? ''}}" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="rd_relationshipone_id" class="form-label">Select Relationship</label>
                                                    {!! Form::select('rd_relationship_id[]',$relationship ?? [],$relationshipone->relation ?? '',['class'=>'form-control','id'=>'rd_relationship_id','placeholder'=>'Select Relationship']) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-4" style="margin:auto;">
                                                <button type="button" class="btn btn-danger removeRelation">Delete</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row rd_end">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <button type="button" class="btn btn-secondary addNewRd">Add New</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light changeTab back" data-tab="addressDetails">Back</button>
                                            <button type="button" class="btn btn-primary changeTab" data-tab="documentDetails">Save & Next</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="documentDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-4 col-lg-4 aadhar_div">
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
                                                        <a href="javascript:void(0)">
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-success text-success rounded-circle fs-4">
                                                                      <div class="element">
                                                                            <i class="ri-upload-cloud-2-line" id="aadhar_card"></i>
                                                                            <input type="file" name="aadhar_card" id="aadhar_card_file">
                                                                      </div>
                                                                </span>
                                                            </div>
                                                        </a>
                                                        @if(isset($data->aadhar_card) && $data->aadhar_card != null && $data->aadhar_card != "")
                                                            <a href="{{ url('public/uploads/devotee_documents') . '/' . $data->aadhar_card }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>

                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="deleteDocument('is_adharcard')" >
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-4">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4 pan_div">
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
                                                        <a href="javascript:void(0)">
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-success text-success rounded-circle fs-4">
                                                                      <div class="element">
                                                                            <i class="ri-upload-cloud-2-line" id="pan_card"></i>
                                                                            <input type="file" name="pan_card" id="pan_card_file">
                                                                      </div>
                                                                </span>
                                                            </div>
                                                        </a>

                                                        @if(isset($data->pan_card) && $data->pan_card != null && $data->pan_card != "")
                                                            <a href="{{url('public/uploads/devotee_documents') . '/' . $data->pan_card }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="deleteDocument('is_pancard')">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-4">
                                                                    <i class="ri-delete-bin-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-lg-4 passport_div">
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
                                                        <a href="javascript:void(0)">
                                                            <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-success text-success rounded-circle fs-4">
                                                                      <div class="element">
                                                                            <i class="ri-upload-cloud-2-line" id="passport"></i>
                                                                            <input type="file" name="passport" id="passport_file">
                                                                      </div>
                                                                </span>
                                                            </div>
                                                        </a>

                                                        @if(isset($data->passport) && $data->passport != null && $data->passport != "")
                                                            <a href="{{ url('public/uploads/devotee_documents') . '/' . $data->passport }}" target="_blank">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-primary text-primary rounded-circle fs-4">
                                                                    <i class="ri-download-2-line"></i>
                                                                </span>
                                                                </div>
                                                            </a>

                                                            <a role="menuitem" tabindex="-1" href="javascript:void(0)" onclick="deleteDocument('is_passport')">
                                                                <div class="avatar-sm flex-shrink-0">
                                                                <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-4">
                                                                    <i class="ri-delete-bin-line"></i>
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
                                            <button class="btn btn-light changeTab back" data-tab="relationDetails">Back</button>
                                            <button type="submit" class="btn btn-primary">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} Devotee</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </form>

    <div id="deletemodal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this document ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger deleteConfirm">Delete</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="blankrelation" class="d-none">
        <div class="row">
            <input type="hidden" name="oldRelationIds[]" value="" />
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="rd_first_name" class="form-label">First Name</label>
                    <input type="text" id="rd_first_name" name="rd_first_name[]" class="form-control" placeholder="Enter First Name" value="" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="rd_middle_name" class="form-label">Middle Name</label>
                    <input type="text" id="rd_middle_name" name="rd_middle_name[]" class="form-control" placeholder="Enter Middle Name" value="" />
                </div>
            </div>
            <!--end col-->
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="rd_last_name" class="form-label">Last Name</label>
                    <input type="text" id="rd_last_name" name="rd_last_name[]" class="form-control" placeholder="Enter Last Name" value="" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="rd_mobile" class="form-label">Mobile</label>
                    <input type="text" id="rd_mobile" name="rd_mobile[]" class="form-control" placeholder="Enter Mobile" value="" />
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-3">
                    <label for="rd_relationship_id" class="form-label">Select Relationship</label>
                    {!! Form::select('rd_relationship_id[]',$relationship ?? [],$data->relationship_id ?? '',['class'=>'form-control','id'=>'rd_relationship_id','placeholder'=>'Select Relationship']) !!}
                </div>
            </div>
            <div class="col-lg-4" style="margin:auto;">
                <button type="button" class="btn btn-danger removeRelation">Delete</button>
            </div>
        </div>
    </div>
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
        $("#marriage_date").flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y",
        });

        $(document).on("change",".marital_status",function() {
            var val = $("input[type=radio][name=marital_status]:checked").val();
            if (val == '2') {
                $(".marriage_date_div").removeClass("d-none");
            }else{
                $(".marriage_date_div").addClass("d-none");
            }
        });

        $(document).on("change",".occupatoin_type",function() {
            var val = $("input[type=radio][name=occupatoin_type]:checked").val();

            if (val == '1' || val == '2') {
                $(".industry_div").removeClass("d-none");
            }else{
                $(".industry_div").addClass("d-none");
            }
        });

        $(document).on("click",".addNewRd",function() {
            var html = $("#blankrelation .row").clone();
            $(html).insertBefore( "#relationDetails .rd_end" );
        });

        $(document).on("click",".removeRelation",function() {
            $(this).closest('.row').remove();
        });

        setTimeout(function() {
            $(".marital_status").trigger("change");
            $(".occupatoin_type").trigger("change");
            var row = $("#relationDetails .row").length;
            if(row == 1){
                $(".addNewRd").trigger("click");
            }
        }, 500);

        $(document).on("click",".changeTab",function() {
            var checkclass = $(this).hasClass('back');
            if(checkclass == false){
                var check = $("#frontdevoteeform").valid();
            }else{
                var check = true;
            }

            $('.nav-tabs-custom li a').removeClass('disabled');
            if(check == true){
                var tab = $(this).attr('data-tab');
                $('.nav-tabs-custom a[href="#' + tab + '"]').tab('show');
            }
            // $('.nav-tabs-custom li a').not('.active').addClass('disabled');
        });

        $(function () {
            // $('.nav-tabs-custom li a').not('.active').addClass('disabled');
            $("#aadhar_card").click(function () {
                $("#aadhar_card_file").trigger('click');
            });
            $("#pan_card").click(function () {
                $("#pan_card_file").trigger('click');
            });
            $("#passport").click(function () {
                $("#passport_file").trigger('click');
            });
        });

        $(document).on("change",".fillAddress",function() {
            var val = $(this).val();
            var getField = (val == 1) ? "pa_" : (val == 2) ? "ca_" : "ma_";
            var setField = $(this).attr('data-field');
            var div = $(this).closest('.row');
            div.find("#"+setField+"_address").val($("#"+getField+"address").val());
            div.find("#"+setField+"_pincode").val($("#"+getField+"pincode").val());
            div.find("#"+setField+"_area").val($("#"+getField+"area").val());
            div.find("#"+setField+"_country_id").val($("#"+getField+"country_id").val());
            var country_id = $("#"+getField+"country_id option:selected").val();
            var state_id = $("#"+getField+"state_id option:selected").val();
            var city_id = $("#"+getField+"city_id option:selected").val();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: dms_app.baseURL() + '/copyotheraddress',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    country_id: country_id,
                    state_id: state_id,
                    city_id: city_id,
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {

                    div.find("#"+setField+"_state_id").html(data.state);
                    div.find("#"+setField+"_city_id").html(data.city);

                }
            });

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

    $(document).on("change","#od_country_id",function() {
        country_id = this.value;
        changecountry(country_id,"od_");
    });

    $(document).on("change","#pa_country_id",function() {
        country_id = this.value;
        changecountry(country_id,"pa_");
    });

    $(document).on("change","#ca_country_id",function() {
        country_id = this.value;
        changecountry(country_id,"ca_");
    });

    $(document).on("change","#ma_country_id",function() {
        country_id = this.value;
        changecountry(country_id,"ma_");
    });

    $(document).on("change","#state_id",function() {
        state_id = this.value;
        country_id = $('#country_id').val();
        changestate(country_id,state_id);
    });

    $(document).on("change","#od_state_id",function() {
        state_id = this.value;
        country_id = $('#od_country_id').val();
        changestate(country_id,state_id,"od_");
    });

    $(document).on("change","#pa_state_id",function() {
        state_id = this.value;
        country_id = $('#pa_country_id').val();
        changestate(country_id,state_id,"pa_");
    });

    $(document).on("change","#ca_state_id",function() {
        state_id = this.value;
        country_id = $('#ca_country_id').val();
        changestate(country_id,state_id,"ca_");
    });

    $(document).on("change","#ma_state_id",function() {
        state_id = this.value;
        country_id = $('#ma_country_id').val();
        changestate(country_id,state_id,"ma_");
    });

    function changecountry(country_id,prefix="") {
        $("#"+prefix+"city_id").html('<option value="">Select City</option>');
        $("#"+prefix+"state_id").html('<option value="">Select State</option>');
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
                        $("#"+prefix+"state_id").html(data);
                    }
                }
            });
        } else {
            $("#"+prefix+"city_id").html('<option value="">Select City</option>');
            $("#"+prefix+"state_id").html('<option value="">Select State</option>');
        }
    }


    function changestate(country_id,state_id,prefix="") {
        $("#"+prefix+"city_id").html('<option value="">Select City</option>');
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
                        $("#"+prefix+"city_id").html(data);
                    }
                }
            });
        } else {
            $("#"+prefix+"city_id").html('<option value="">Select City</option>');
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

    $(document).on('click','.profile-photo-delete',function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: "{{route('devotee.delete_devotee_image')}}",
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#devotee_hidden_id').val(),
                },
                dataType: 'JSON',
                /* remind that 'data' is the response of the AjaxController */
                success: function(data) {
                }
            });
    });
    $(document).on('focus','#whatsapp_no',function(){
        $(this).val($("#mobile_no").val());
        let phoneInputField1 = document.querySelector("#whatsapp_no");
        let phoneInput1 = window.intlTelInput(phoneInputField1, {
            initialCountry: phoneInput.s.iso2,
            hiddenInput:'full',
            formatOnDisplay:false,
            utilsScript:"{{ url('public/backend/js/utils.js')}}",
            autoPlaceholder: "ON",
        });
    });

    function deleteDocument(type){
        $(".deleteConfirm").attr('data-delete', type);
        $('#deletemodal').modal('show');
    }

    $(document).on('click','.deleteConfirm',function(){
        var del = $(this).attr('data-delete');
        $('form').append('<input type="hidden" name="'+del+'" id="'+del+'" value="1" />');
        $('#deletemodal').modal('hide');

        var hideDiv = (del == "is_adharcard") ? "aadhar_div" : (del == "is_pancard") ? "pan_div" : "passport_div";
        $("."+hideDiv).find(".d-flex.gap-1").find('a').not(':first').addClass('d-none');
    });

    </script>
@endsection
