<script src="{{ url('public/build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ url('public/build/libs/simplebar/simplebar.min.js') }}"></script>

<script src="{{ url('public/build/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ url('public/build/libs/feather-icons/feather.min.js') }}"></script>

<script src="{{ url('public/build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

<script src="{{ url('public/js/plugin.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.2.0-beta-deprecated/noty.js" integrity="sha512-xasj/6R0KhGYwX2VqrtS6d/eiOv38n7DnA0uVSqr9qhCZLrc+IA56OSsgZmjPRIu0cYVlC8LrLpuRQkgJgxBjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.2.0-beta-deprecated/noty.min.js" integrity="sha512-69TrhfgH/cMfR+2r0M6RuTdNFpL4So8vyAW4BRvmEwzCKR12FiA70LIOBAoQn5jG0iAOJNkPVDmAKlMinCP5EA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js"></script>

<script src="{{ url('public/js/dms.min.js')}}"></script>

<script type="text/javascript">

@if ($success = Session::get('success'))

    dms_app.notifyWithtEle("{{$success}}",'success');

@endif

@if ($warning = Session::get('error'))

    dms_app.notifyWithtEle("{{$warning}}",'error');

@endif

</script>

@yield('script')

@yield('script-bottom')

