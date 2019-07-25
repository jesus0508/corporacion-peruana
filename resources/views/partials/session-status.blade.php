<script>
toastr.options.positionClass = 'toast-bottom-right';
@if(session('status'))
  var type = "{{ session('alert-type') }}";
  switch(type){
    case 'info':
        toastr.info("{{ session('status') }}");
        break;
    case 'warning':
        toastr.warning("{{ session('status') }}");
        break;
    case 'success':
        toastr.success("{{ session('status') }}");
        break;
    case 'error':
        toastr.error("{{ session('status') }}");
        break;
  }
@endif
</script>