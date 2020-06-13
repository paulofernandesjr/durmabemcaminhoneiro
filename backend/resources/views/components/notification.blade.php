@section('scripts')
<script>
    $.gritter.add({
        title: 'Sucesso',
        text: @JSON($message),
        class_name: 'color success',
        time: 2000
    });
</script>
@endsection
