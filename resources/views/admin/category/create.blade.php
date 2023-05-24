@extends('layouts.master')
@section('title') Countries @endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} Category</h4>
            </div>

            @if(isset($data) && !empty($data->id))
                @php $id = $data->id; @endphp
            @else
                @php $id = 0;@endphp
            @endif
            <form class="tablelist-form" method="POST" enctype="multipart/form-data" action="{{url($actionURL.'/action',$view).'/'.$id ?? 0}}" autocomplete="off" id="categoryform">
            @csrf
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="name"
                                    class="form-label">Name<span class="error">*</span></label>
                                <input type="text" id="name" name="name"
                                    class="form-control" placeholder="Enter category name"
                                    value="{{$data->name ?? ''}}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                            <a href="{{route('countries')}}" class="btn btn-light">Close</a>
                        <button type="submit" class="btn btn-success"
                            id="add-btn">{{(isset($data) && !empty($data->id)) ? 'Update' : 'Add'}} Category</button>
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
