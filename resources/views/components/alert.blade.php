@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/izitoast/dist/css/iziToast.min.css') }}">
@endpush

{{-- Flash Message --}}
@if ($message = Session::get('failed'))
<div class="alert alert-danger alert-dismissible shake" style="margin-bottom: -6px; margin:0 5px" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>
    <strong>{{ $message }}</strong> {{ session('error') }}
</div>
@endif


@push('scripts')
    <script src="{{ asset('assets/vendors/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script>
        $(document).ready( function() {
            if("{!! \Session::has('success') !!}") {
                iziToast.success({
                    title: 'Hello, ' + "{!! auth()->user()->name !!}",
                    message: "{!! \Session::get('success') !!}",
                    position: 'topRight'
                });
            } else if("{!! \Session::has('error') !!}") {
                iziToast.error({
                    title: 'Hello, ' + "{!! auth()->user()->name !!}",
                    message: "{!! \Session::get('error') !!}",
                    position: 'topRight'
                });
            } else {
                return null;
            }

            $('#loading').hide();

        });
    </script>
@endpush
