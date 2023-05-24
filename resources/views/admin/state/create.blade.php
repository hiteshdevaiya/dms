@extends('layouts.master')
@section('title') @lang('translation.states') @endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} State</h4>
            </div>

            @if(isset($data) && !empty($data->id))
                @php $id = $data->id; @endphp
            @else
                @php $id = 0;@endphp
            @endif
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="{{url($actionURL.'/action',$view).'/'.$id ?? 0}}" autocomplete="off" id="stateform">
            @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Select Country<span class="error">*</span></label>
                                {!! Form::select('country_id',$country ?? '',$data->country_id ?? '',['class'=>'form-control','id'=>'country_id','placeholder'=>'Select Country']) !!}
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div>
                                <label for="title"
                                    class="form-label">Title<span class="error">*</span></label>
                                <input type="text" id="title" name="title"
                                    class="form-control" placeholder="Enter state name"
                                    value="{{$data->title ?? ''}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <a href="{{route('states')}}" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} State</button>
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
