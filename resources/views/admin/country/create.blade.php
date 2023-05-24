@extends('layouts.master')
@section('title') @lang('translation.countries') @endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} Country</h4>
            </div>

            @if(isset($data) && !empty($data->id))
                @php $id = $data->id; @endphp
            @else
                @php $id = 0;@endphp
            @endif
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="{{url($actionURL.'/action',$view).'/'.$id ?? 0}}" autocomplete="off" id="countryform">
            @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="country_code"
                                    class="form-label">Country Code<span class="error">*</span></label>
                                <input type="text" id="country_code" name="country_code"
                                    class="form-control" placeholder="Enter country code +91"
                                    value="{{$data->country_code ?? ''}}" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="title"
                                    class="form-label">Title<span class="error">*</span></label>
                                <input type="text" id="title" name="title"
                                    class="form-control" placeholder="Enter country name"
                                    value="{{$data->title ?? ''}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                            <a href="{{route('countries')}}" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} Country</button>
                    </div>
                </div>
            </form>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')

@endsection
