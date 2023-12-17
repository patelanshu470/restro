<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
@if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
@endif
@if(Session::has('status'))
    toastr.success("{{ Session::get('status') }}");
@endif
@if(Session::has('info'))
toastr.info("{{ Session::get('info') }}");
@endif
@if(Session::has('warning'))
toastr.warning("{{ Session::get('warning') }}");
@endif
@if(Session::has('error'))
toastr.error("{{ Session::get('error') }}");
@endif
</script>
